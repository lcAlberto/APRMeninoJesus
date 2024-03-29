<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Enums\UserRolesEnum;
use App\Http\Actions\Admin\PartnerAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    private $action = null;

    public function __construct()
    {
        $this->action = new PartnerAction();
    }

    public function index()
    {
        return Partner::all();
    }

    public function create()
    {
        //
    }

    public function store(PartnerRequest $request)
    {
        try {
            $data = $request->validated();
            $partner = $this->action->createPartner($data);
            if (!$partner->hasRole(UserRolesEnum::PARTNER)) {
                $partner->assignRole(UserRolesEnum::PARTNER);
            }
            return [
                'status' => '200',
                'data' => $partner
            ];
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message:' => 'Internal Server Error'
            ], 500);
        }
    }

    public function show(Partner $model, $id)
    {
        return $model->findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(PartnerRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $partner = $this->action->editPartner($data, $id);
            if (!$partner->hasRole(UserRolesEnum::PARTNER)) {
                $partner->assignRole(UserRolesEnum::PARTNER);
            }
            return [
                'status' => '200',
                'data' => $partner
            ];
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message:' => 'Internal Server Error'
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $partner = $this->action->deletePartner($id);
            return [
                'status' => '200',
                'data' => $partner
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
