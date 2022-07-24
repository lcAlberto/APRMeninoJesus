<?php

namespace App\Http\Controllers\Api\v1\Root;

use App\Http\Actions\Root\OrganizationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Root\OrganizationRequest;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    private $action = null;

    public function __construct()
    {
        $this->action = new OrganizationAction();
    }

    public function index(Organization $organization)
    {
        return $organization->all();
    }

    public function create()
    {
        //
    }

    public function store(OrganizationRequest $request)
    {
        try {
            $data = $request->all();
            $organization = $this->action->createOrganization($data);
            return [
                'status' => '200',
                'data' => $organization
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function show(Organization $model, $id)
    {
        return $model->findOrFail($id);
    }

    public function edit(OrganizationRequest $request, $id)
    {
        //
    }

    public function update(OrganizationRequest $request, $id)
    {
        try {
            $data = $request->all();
            $organization = $this->action->editOrganization($data, $id);
            return [
                'status' => '200',
                'data' => $organization
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function destroy($id)
    {
        try {
            $organizations = $this->action->deleteOrganization($id);
            return [
                'status' => '200',
                'data' => $organizations
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
