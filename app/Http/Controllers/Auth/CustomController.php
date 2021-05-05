<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomController extends Controller
{
    public function adualt()
    {
        return view('customAuth.index');
    }
}
