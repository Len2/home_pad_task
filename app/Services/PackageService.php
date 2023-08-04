<?php

namespace App\Services;
use App\Models\Package;
use App\Models\Registration;
use App\Services\Interface\PackageInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class PackageService implements PackageInterface
{

    public function getPackages()
    {
        return DB::table('packages')->select()->get();
    }

    public function findPackageById($id)
    {
        return DB::table('packages')->where('id',$id)->first();
    }


    public function increasesCount($id):bool{
       $package = Package::find($id);
       if ($package && $package->limit > $package->nr_assign_customer){
           $package->nr_assign_customer = $package->nr_assign_customer + 1;
           $package->save();
           return true;
       }
       return false;
    }
    public function createPackage($request)
    {
        if (Auth::user()->role_name != 'sales'){
            return response()->json([
                'errors' => "You don't have permission to create package",
            ], 403);
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:packages',
            'limit'=>'required|numeric|min:3|max:8'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
            ], 422);
        }

        return Package::create($request->all());

    }
}
