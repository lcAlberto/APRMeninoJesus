<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 18/07/22
 * Time: 00:37
 */

namespace App\Http\Actions\Root;

use App\Models\Organization;
use App\Models\User;

class OrganizationAction {

    protected $model = null;
    protected $user = null;

    public function __construct()
    {
        $this->model = new Organization();
        $this->user = new User();
    }

    protected function getClass()
    {
        return Organization::class;
    }

    public function createOrganization($data)
    {
        return $this->model->create($data);
    }

    public function editOrganization($data, $id)
    {
        $organization = $this->model->findOrFail($id);
        $organization->update($data);
        return $organization;
    }

    public function deleteOrganization($id)
    {
        Organization::destroy($id);
        return $this->model->all();
    }
}
