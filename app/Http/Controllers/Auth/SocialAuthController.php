<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    // Metodo encargado de la redireccion a proveedor
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Metodo encargado de obtener la información del usuario
    public function handleProviderCallback($provider)
    {
        // Obtenemos los datos del usuario
        $social_user = Socialite::driver($provider)->user();

        $user = User::where($provider . "_id", $provider->getId())
            ->orWhere('email', $provider->getEmail())->first();

        //dd($social_user);
        // Comprobamos si el usuario ya existe
        if ($user) {
            $user[$provider."_id"] = $provider->getId();
            $user->avatar = $provider->getAvatar();
            $user->save();
            return $this->authAndRedirect($user); // Login y redirección
        } else {
            // En caso de que no exista creamos un nuevo usuario con sus datos.
            $user = new User();
            $user[$provider."_id"] = $social_user->getId();
            $user->name = $social_user->getName();
            $user->email = $social_user->getEmail();
            $user->avatar = $social_user->getAvatar();
            $user->password = "";
            $user->save();

            return $this->authAndRedirect($user); // Login y redirección
        }
    }

    // Login y redirección
    public function authAndRedirect($user)
    {
        Auth::login($user);

        return redirect()->to('/home#');
    }
}
