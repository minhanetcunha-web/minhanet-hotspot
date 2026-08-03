<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PortalAdminController extends Controller
{
    public function index()
    {
        return view('admin.portais.index');
    }
}
