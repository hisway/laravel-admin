<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        return $admin->name;
    }
}
