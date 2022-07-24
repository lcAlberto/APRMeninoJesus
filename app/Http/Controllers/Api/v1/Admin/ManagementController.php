<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Actions\Admin\ManagementAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ManagementRequest;
use App\Models\Management;
use Illuminate\Http\Request;

class ManagementController extends Controller
{
    private $action = null;

    public function __construct()
    {
        $this->action = new ManagementAction();
    }

    public function index()
    {
        return Management::all();
    }

    public function create()
    {
        //
    }

    public function store(ManagementRequest $request)
    {
        try {
            $data = $request->validated();
            $partner = $this->action->createManagement($data);
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

    public function show($id)
    {
        return Management::findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(ManagementRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $partner = $this->action->editManagement($data, $id);
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
            $partner = $this->action->deleteManagement($id);
            return [
                'status' => '200',
                'data' => $partner
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
