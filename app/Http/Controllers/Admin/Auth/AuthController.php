<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\Admin\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;


class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    protected $redirectTo = '/admin';
    protected $guard = 'admin';
    protected $loginView = 'admin.auth.login';
    protected $registerView = 'admin.auth.register';
    protected $redirectAfterLogout = '/admin/login';

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:admin_users',
            'password' => 'required|confirmed|min:6',
        ]);

    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

    }

}
