<?php

namespace App\Http\Controllers\Api\Auth;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use Illuminate\Support\Str;
use App\Repositories\LoginRepository;
class LoginController extends Controller
{
    public function __construct(LoginRepository $LoginRepository)
    {
        $this->LoginRepository = $LoginRepository;

    }
    public function login(LoginRequest $r)
    {
        return $this->LoginRepository->login($r->all());
    }
    public function logout(LoginRequest $r)
    {
       return $this->LoginRepository->logout();
    }
}
