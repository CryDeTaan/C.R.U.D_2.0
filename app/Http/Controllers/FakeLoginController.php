<?php

namespace App\Http\Controllers;

class FakeLoginController extends Controller
{
    public function login($id)
    {
        auth()->loginUsingId($id);
        return back();
   }
}
