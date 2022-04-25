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
    public function show(){
        if (!auth()->user()->center) {
            return redirect()->route("home")->with(['not_allow' => __("You haven't assign to medical center yet.")]);
        }
        return view("centers.show",['center'=>auth()->user()->center]);
    }
}
