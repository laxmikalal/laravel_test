<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Organisation;
use App\Http\Requests\OrganisationRequest;
use App\Services\OrganisationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

/**
 * Class OrganisationController
 * @package App\Http\Controllers
 */
class OrganisationController extends ApiController
{
    /*
     * @param OrganisationRequest $request
     * @param OrganisationService $service
     *
     * @return JsonResponse
     */
    public function store(OrganisationRequest $request, OrganisationService $service)
    {
        $organisation = $service->createOrganisation($request->input('name'), $request->user());

        return $this
            ->transformItem('organisation', $organisation, ['user'])
            ->respond();
    }

    public function listAll(OrganisationService $service)
    {
        $filter = $this->request->input('filter');
        $response = $service->getList($filter); 
        
        return $this->transformCollection('organisations', $response)
                    ->respond();
    }
}
