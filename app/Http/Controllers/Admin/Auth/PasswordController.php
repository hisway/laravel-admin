<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class PasswordController extends Controller
{
    use ResetsPasswords;

    protected $guard = 'admin';
    protected $broker = 'admins';
    protected $resetView = 'admin.auth.passwords.reset';
    protected $linkRequestView = 'admin.auth.passwords.email';
    /**
     * Create a new password controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
}
