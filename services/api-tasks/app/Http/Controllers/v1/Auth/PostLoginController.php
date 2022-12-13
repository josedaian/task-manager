<?php

namespace App\Http\Controllers\v1\Auth;

use App\Exceptions\UnauthorizedException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\v1\TokenResource;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

final class PostLoginController extends Controller 
{
    public function __invoke(LoginRequest $request)
    {
        if (!Auth::attempt($request->only('email', 'password')))
        {
            throw new UnauthorizedException();
        }

        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken($request->email, ['*'], Carbon::now()->addHours(8));
        return $this->successResponse(new TokenResource($token));
    }
}