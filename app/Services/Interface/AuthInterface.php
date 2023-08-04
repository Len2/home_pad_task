<?php

namespace App\Services\Interface;

interface AuthInterface
{
    public function login( $request): object;
    public function register( $request): object;
}
