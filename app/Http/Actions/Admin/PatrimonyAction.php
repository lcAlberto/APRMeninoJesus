<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 23/07/22
 * Time: 23:49
 */

namespace App\Http\Actions\Admin;

use App\Models\Organization;
use App\Models\Patrimony;
use App\Models\User;
use Carbon\Carbon;

class PatrimonyAction
{
    protected $model = null;
    protected $organization = null;
    protected $user = null;

    public function __construct()
    {
        $this->model = new Patrimony();
        $this->organization = new Organization();
        $this->user = new User();
    }

    protected function getClass()
    {
        return Patrimony::class;
    }

    public function prepareData($data)
    {
        $data['purchased_value'] = preg_replace("/[0-9][.]/", "", data_get($data, 'purchased_value'));
        $data['current_value'] = preg_replace("/[^0-9][.]/", "", data_get($data, 'current_value'));
        $data['acquisition_date'] = Carbon::createFromFormat('Y-m-d', data_get($data, 'acquisition_date'));
        $data['sale_date'] = Carbon::createFromFormat('Y-m-d', data_get($data, 'sale_date'));
        $data['organization_id'] = auth()->user()->organization_id;
        return $data;
    }

    public function createPatrimony($data)
    {
        $patrimony = $this->prepareData($data);
        return $this->model->create($patrimony);
    }

    public function editPatrimony($data, $id)
    {
        $organization = $this->model->findOrFail($id);
        $patrimony = $this->prepareData($data);
        $organization->update($patrimony);
        return $organization;
    }

    public function deletePatrimony($id)
    {
        Patrimony::destroy($id);
        return $this->model->all();
    }
}
