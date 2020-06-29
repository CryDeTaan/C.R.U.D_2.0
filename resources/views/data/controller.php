<?php

namespace App\Http\Controllers;

use App\Entity;
use Illuminate\Http\Request;

class EntityAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(Entity $entity)
    {
        return view('/entities/show',
        compact($entity));
    }
}
