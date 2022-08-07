<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Actions\Shared\BorrowingsAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Shared\BorrowingsRequest;
use App\Models\Borrowing;

class BorrowingsController extends Controller
{
    private $action = null;

    public function __construct()
    {
        $this->action = new BorrowingsAction();
    }

    public function index()
    {
        return Borrowing::all();
    }

    public function create()
    {
        //
    }

    public function store(BorrowingsRequest $request)
    {
        try {
            $data = $request->validated();
            $partner = $this->action->createBorrowing($data);
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
        return Borrowing::findOrFail($id);
    }

    public function edit($id)
    {
        //
    }

    public function update(BorrowingsRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $partner = $this->action->editBorrowing($data, $id);
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
            $partner = $this->action->deleteBorrowing($id);
            return [
                'status' => '200',
                'data' => $partner
            ];
        } catch (\Exception $e) {
            return $e;
        }
    }
}
