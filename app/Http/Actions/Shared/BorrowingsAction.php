<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 23/07/22
 * Time: 23:49
 */

namespace App\Http\Actions\Shared;

use App\Models\Borrowing;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;

class BorrowingsAction
{
    protected $model = null;
    protected $organization = null;
    protected $user = null;

    public function __construct()
    {
        $this->model = new Borrowing();
        $this->organization = new Organization();
        $this->user = new User();
    }

    protected function getClass()
    {
        return Borrowing::class;
    }

    private function prepareData($data)
    {
        $data['start_date'] = Carbon::createFromFormat('Y-m-d', data_get($data, 'start_date'));
        $data['end_date'] = Carbon::createFromFormat('Y-m-d', data_get($data, 'end_date'));
        $data['description'] = in_array('description', $data) ? data_get($data, 'description') : null;
        $data['patrimony_id'] = preg_replace("/[^0-9]/", "", data_get($data, 'patrimony_id'));
        $data['user_id'] = auth()->user()->id;
        $data['organization_id'] = auth()->user()->organization_id;

        return $data;
    }

    public function createBorrowing($data)
    {
        $borrowing = $this->prepareData($data);
        return $this->model->create($borrowing);
    }

    public function editBorrowing($data, $id)
    {
        $borrowing = $this->model->findOrFail($id);
        $borrowingData = $this->prepareData($data);
        $borrowing->update($borrowingData);
        return $borrowing;
    }

    public function deleteBorrowing($id)
    {
        Borrowing::destroy($id);
        return $this->model->all();
    }
}
