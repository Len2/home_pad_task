<?php

namespace App\Services;
use App\Models\Package;
use App\Models\Registration;
use App\Services\Interface\CostumerInterface;
use App\Services\Interface\PackageInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class CustomerService implements CostumerInterface
{

    public function findCustomerById($id): object|null
    {
        return DB::table('users')->where('id',$id)->where('role_name','customer')->first();
    }
}
