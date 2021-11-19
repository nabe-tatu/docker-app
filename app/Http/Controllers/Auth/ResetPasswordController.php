<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    public function render()
    {
        if (! request()->hasValidSignature()) {
            return redirect('login');
        }

        return view('app');
    }
}
