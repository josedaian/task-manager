<?php

namespace App\Http\Controllers;

use App\Helpers\AuthSessionHelper;
use Illuminate\Http\Request;

class AuthController extends Controller 
{
    public function login(Request $request)
    {
        return $this->dispatchRequest($request, function() use($request){
            if($request->isMethod('POST')){
                $params = [
                    'email' => $request->get('email', null),
                    'password' => $request->get('pass', null),
                ];
    
                $loginTask = $this->apiClient->authLogin($params);
                if(!$loginTask->isSuccess()){
                    session()->flash('alert', ['type' => 'error', 'text' => $loginTask->getResultMessage()]);
                    return back()->withInput();
                }

                $authData = $loginTask->getResultData();
                AuthSessionHelper::buildNew($authData->token, $authData->user);
                return redirect()->route('tasks.index');

            }
            return view('auth.login');
        });
    }

    public function signUp(Request $request)
    {
        $data = [
            "name" => $request->name,
            "password" => $request->pass,
            "email" => $request->email,
        ];

        $signUpTask = $this->apiClient->authSignUp($data);

        if(!$signUpTask->isSuccess()){
            return redirect()->route('auth.login')->with('alert', ['type' => 'error', 'text' => $signUpTask->getResultMessage(), 'autoDismiss' => 5]);
        }else{
            return redirect()->route('auth.login')->with('alert', ['type' => 'success', 'text' => 'Success! New record in the house', 'autoDismiss' => 5]);
        }
    }

    function logout(Request $request)
    {
        return $this->dispatchRequest($request, function() use($request){
            AuthSessionHelper::logout($request);
            return redirect()->route('auth.login');
        });

    }
}