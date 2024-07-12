<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StatusController extends Controller
{
    public function statusActive()
    {
        $users = User::where('status', 1)->paginate(3);
        return view('admin.user.index', compact('users'));
    }

    public function statusInActive()
    {
        $users = User::where('status', 0)->paginate(3);
        return view('admin.user.index', compact('users'));
    }
}
