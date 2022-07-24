<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 23/07/22
 * Time: 23:49
 */

namespace App\Http\Actions\Admin;

use App\Models\Management;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;

class ManagementAction
{
    protected $model = null;
    protected $organization = null;
    protected $user = null;

    public function __construct()
    {
        $this->model = new Management();
        $this->organization = new Organization();
        $this->user = new User();
    }

    protected function getClass()
    {
        return Management::class;
    }

    private function prepareData($data)
    {
//        dd($data);
        $data['start_date'] = in_array('start_date', $data) ?
            Carbon::createFromFormat('Y-m-d', data_get($data, 'start_date')) : null;
        $data['end_date'] = in_array('end_date', $data) ?
            Carbon::createFromFormat('Y-m-d', data_get($data, 'end_date')) : null;
        $data['duration'] = in_array('duration', $data) ? data_get($data, 'duration') : null;
        $data['isCurrent'] = in_array('isCurrent', $data) ? data_get($data, 'isCurrent') : null;
        $data['treasurer_id'] = in_array('treasurer_id', $data) ? data_get($data, 'treasurer_id') : null;
        $data['vice_treasurer_id'] = in_array('vice_treasurer_id', $data) ? data_get($data, 'vice_treasurer_id') : null;
        $data['president_id'] = in_array('president_id', $data) ? data_get($data, 'president_id') : null;
        $data['vice_president_id'] = in_array('vice_president_id', $data) ? data_get($data, 'vice_president_id') : null;
        $data['organization_id'] = auth()->user()->organization_id;

        return $data;
    }

    public function createManagement($data)
    {
        $management = $this->prepareData($data);
        return $this->model->create($management);
    }

    public function editManagement($data, $id)
    {
        $organization = $this->model->findOrFail($id);
        $partner = $this->prepareData($data);
        $organization->update($partner);
        return $organization;
    }

    public function deleteManagement($id)
    {
        Management::destroy($id);
        return $this->model->all();
    }
}
