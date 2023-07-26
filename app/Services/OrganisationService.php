<?php

declare(strict_types=1);

namespace App\Services;

use App\Organisation;
use App\User;
use App\Events\OrganisationCreated;

/**
 * Class OrganisationService
 * @package App\Services
 */
class OrganisationService
{
    /**
     * @param array $attributes
     *
     * @return Organisation
     */
    public function createOrganisation(string $name, User $user): Organisation
    {
        $organisation = new Organisation();

        $organisation->name = $name;
        $organisation->owner_user_id = $user->id;
        $organisation->trial_end = now()->addDays(30);
        $organisation->subscribed = false;

        if (!$organisation->save()) {
            throw new \DomainException('Error creating an organisation');
        }

        event(new OrganisationCreated($organisation));


        return $organisation;
    }

    public function getList($filter)
    {
        $organisation = new Organisation;

        if($filter == 'subbed') {

            $organisation = $organisation->where('subscribed', true);
        } else if($filter == 'trial') {

            $organisation = $organisation->where('subscribed', false);
        }

        return $organisation
                ->orderByDesc('created_at')
                ->get();

    }
}
