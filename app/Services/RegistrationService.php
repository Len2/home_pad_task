<?php

namespace App\Services;
use App\Models\Package;
use App\Models\Registration;
use App\Services\Interface\CostumerInterface;
use App\Services\Interface\PackageInterface;
use App\Services\Interface\RegistrationInterface;


class RegistrationService implements RegistrationInterface
{
   public function assignCustomerPackage($request){

        $packageService = new PackageService();
        $customerService = new CustomerService();

        $package = $packageService->findPackageById($request->package_id);
        $customer = $customerService->findCustomerById($request->customer_id);

        if ($package && $customer){
            if ( $packageService->increasesCount($request->package_id)){
                return Registration::create(['customer_id'=>$request->customer_id, 'package_id'=>$request->package_id]);
            }
            return response()->json([
                'errors' => 'This Package is not available',
            ], 422);
        }

       return response()->json([
           'errors' => 'You cannot assign a customer in package',
       ], 422);
   }

}
