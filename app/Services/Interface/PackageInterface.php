<?php

namespace App\Services\Interface;

interface PackageInterface
{
    public function getPackages();
    public function findPackageById($id);
    public function createPackage($request);
    public function increasesCount($id):bool;
}
