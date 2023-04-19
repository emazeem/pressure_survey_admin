<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use CommonTrait;

    public function login(Request $request)
    {
        $validators = Validator($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validators->fails()) {
            return $this->sendError($validators->messages()->first(), null);
        }
        $user = User::where('email', $request->email)->first();
        if ($user) {
            if ($user->roles->slug == 'ambassador') {
                if (Hash::check($request->password, $user->password)) {
                    $data['user'] = ['id' => $user->id];
                    $data['token'] = $user->createToken('auth-token')->plainTextToken;
                    return $this->sendSuccess("Login successful", $data);
                } else {
                    return $this->sendError("These credentials do not match our records.", null);
                }
            }
            return $this->sendError("These credentials do not match our records.", null);
        } else {
            return $this->sendError("These credentials do not match our records.", null);
        }
    }
    public function notification_test()
    {
        $response = a_notification(5, 'Notification test', ['url' => 'post', 'data' => 10]);
        dd($response);
    }

    public function attemptLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $user = User::where('email', $credentials['email'])->first();

        if (!$user) {
            return false;
        }

        if (!in_array($user->roles->id, [1, 2])) {
            return false;
        }

        return Auth::attempt($credentials);
    }

}
