<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ZoneController extends Controller
{
    public function map(Request $request)
    {
        $zone_id=$request->input('id');
        return view('zone.map',compact('zone_id'));
    }

}
