<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Pass any necessary data to the view if required
        return view('admin.manageProducts');
    }
}
