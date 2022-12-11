<?php

namespace App\Http\Controllers\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Http\Resources\v1\UserResource;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

final class PostRegisterController extends Controller 
{
    public function __invoke(RegisterRequest $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return $this->successResponse(new UserResource($user));
    }
}