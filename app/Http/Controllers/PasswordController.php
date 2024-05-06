<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customs\Services\PasswordService;
use App\Http\Requests\ChangePasswordRequest;

class PasswordController extends Controller
{
    public function __construct(private PasswordService $service ){}
    public function changeUserPassword(ChangePasswordRequest $request){
        return $this->service->changePassword($request->validated());

    }
}
