<?php

namespace App\Http\Controllers\v1\Auth;

use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Support\Facades\Auth;

final class PostLoginController extends Controller 
{
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'pasword')))
        {
            throw new UnauthorizedException();
        }

        
    }
}