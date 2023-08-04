<?php

namespace App\Http\Controllers;
use App\Services\RegistrationService;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    protected $registrationService;
    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }


    public function assignCustomerPackage(Request $request){
      return  $this->registrationService->assignCustomerPackage($request);
    }
}
