<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Http\Actions\Admin\PatrimonyAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PatrimonyRequest;
use App\Models\Patrimony;

class PatrimoniesController extends Controller
{
    private $action = null;

    public function __construct()
    {
        $this->action = new PatrimonyAction();
    }

    public function index()
    {
        return Patrimony::all();
    }

    public function create()
    {
        //
    }

    public function store(PatrimonyRequest $request)
    {
        try {
            $data = $request->validated();
            $patrimony = $this->action->createPatrimony($data);
            return [
                'status' => '200',
                'data' => $patrimony
            ];
        } catch (\Exception $error) {
            return response()->json([
                'error' => $error->getMessage(),
                'message:' => 'Internal Server Error'
            ], 500);
        }
    }

    public function show(Patrimony $model, $id)
    {
        return $model->findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(PatrimonyRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $patrimony = $this->action->editPatrimony($data, $id);
            return [
                'status' => '200',
                'data' => $patrimony
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
            $partner = $this->action->deletePatrimony($id);
            return [
                'status' => '200',
                'data' => $partner
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
