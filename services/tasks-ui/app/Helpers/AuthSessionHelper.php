<?php
namespace App\Helpers;

use App\Models\User;
use Illuminate\Http\Request;

class AuthSessionHelper 
{
    
    static private $_singleton;
    private $raw, $user = false;
    
    private function __construct(?string $token, ?\stdClass $user)
    {
        $this->raw = ['token' => $token, 'user' => $user];
    }
    
    static function getCurrent(): AuthSessionHelper 
    {
        if( !self::$_singleton ){
            if( session('_token')){
                self::$_singleton = new AuthSessionHelper( session('_token'), session('_user'));
            } else {
                self::$_singleton = new AuthSessionHelper( null, null);
            }
        }
        return self::$_singleton;
    }
    
    static function buildNew(\stdClass $token, \stdClass $user)
    {
        $tokenVal = $token->value ?? null; 
        session(['_token' => $tokenVal,'_user' => $user]);
        self::$_singleton = new AuthSessionHelper($tokenVal, $user);
        return self::$_singleton;
    }
    
    function getRaw(): array 
    {
        return $this->raw;
    }

    function isLoggedIn(): bool 
    {
        return !empty($this->raw['token']) && !empty($this->raw['user']);
    }
                
    function getTokenValue(): ?string
    {
        return $this->raw['token'];
    }

    function getUser(): ?User
    {
        if( $this->user === false ){
            $this->user = ($model = $this->raw['user']) ? User::buildFromApiModel($model) : null;
        }
        return $this->user;
    }

    static function logout(Request $request): void 
    {
        $request->session()->flush();
        self::$_singleton = null;
    }
}