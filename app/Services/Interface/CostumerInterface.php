<?php

namespace App\Services\Interface;

interface CostumerInterface
{
    public function findCustomerById($id): object|null;
}
