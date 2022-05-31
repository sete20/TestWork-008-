<?php
namespace App\Repositories\Interfaces;

use App\Http\Requests\Api\Auth\LoginRequest;

interface LoginInterface
{
public function login($data);
public function logout();

}
