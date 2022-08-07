<?php
/**
 * Created by PhpStorm.
 * User: lucka
 * Date: 23/07/22
 * Time: 23:49
 */

namespace App\Http\Actions\Admin;

use Illuminate\Auth\Events\Registered;
use App\Enums\UserRolesEnum;
use App\Models\Organization;
use App\Models\Partner;
use App\Models\User;
use Carbon\Carbon;

class PartnerAction
{
    protected $model = null;
    protected $organization = null;
    protected $user = null;

    public function __construct()
    {
        $this->model = new Partner();
        $this->organization = new Organization();
        $this->user = new User();
    }

    protected function getClass()
    {
        return Partner::class;
    }

    public function prepareData($data)
    {
        $data['cpf'] = in_array('cpf', $data)
            ? preg_replace("/[^0-9]/", "", data_get($data, 'cpf')) : null;
        $data['rg'] = in_array('rg', $data) ?
            preg_replace("/[^0-9]/", "", data_get($data, 'rg')) : null;
        $data['phone'] = in_array('phone', $data)
            ? preg_replace("/[^0-9]/", "", data_get($data, 'phone')) : null;
        $data['born_date'] = in_array('born_date', $data) ?
            Carbon::createFromFormat('Y-m-d', data_get($data, 'born_date')) : null;
        $data['nis'] = in_array('nis', $data) ?
            preg_replace("/[^0-9]/", "", data_get($data, 'nis')) : null;
        $data['postal_code'] = in_array('postal_code', $data) ?
            preg_replace("/[^0-9]/", "", data_get($data, 'postal_code')) : null;
        return $data;
    }

    public function createPartner($data)
    {
        $partner = $this->prepareData($data);
        $partner = Partner::create($partner);
        event(new Registered($partner));
        $partner->assignRole(UserRolesEnum::ADMIN);
        dd($partner);
        return $partner;

    }

    public function editPartner($data, $id)
    {
        $partner = $this->model->findOrFail($id);
        $verifiedData = $this->prepareData($data);
        $partner->update($verifiedData);
        $partner->syncRoles(UserRolesEnum::PARTNER);
        return $partner;
    }

    public function deletePartner($id)
    {
        Partner::destroy($id);
        return $this->model->all();
    }
}
