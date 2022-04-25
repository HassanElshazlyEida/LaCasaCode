<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\DataTables\CenterDatatable;
use App\Http\Controllers\Controller;
use App\Models\Center;

class CenterController extends Controller
{
    public function index(CenterDatatable $center){
        return $center->render("centers.index");
    }
    public function show($user_id){
        if (auth()->user()->id != $user_id) {
            return back()->withErrors(['not_allow_profile' => __('You are not allowed to enter.')]);
        }
        return view("centers.show",['center'=>auth()->user()->center]);
    }
}
