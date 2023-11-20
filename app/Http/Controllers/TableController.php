<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminUser;

class TableController extends Controller
{
    
    public function adminTable()
    {
        $accounts = AdminUser::all();
        return view('adminTable', ['table' => $accounts]);
    }
    }
