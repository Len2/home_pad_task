<?php

namespace App\Http\Controllers;

use App\Services\PackageService;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PackageController extends Controller
{

    protected $packageService;
    public function __construct(PackageService $packageService)
    {
        $this->packageService = $packageService;
    }

    public function getPackages(): Collection
    {

       return $this->packageService->getPackages();
    }

    public function createPackage(Request $request)
    {
        return $this->packageService->createPackage($request);
    }
}
