<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MapController extends Controller
{
    public function showMap(Request $request) {
    $type = $request->get('type');
    $lat = $request->get('lat');
    $lng = $request->get('lng');
    $zoom = $request->get('zoom', 12);
    $coordinates = $request->get('coordinates');
    $action = $request->get('action'); // 'fitBounds'
    $name = $request->get('name');

    return view('map', compact('type', 'lat', 'lng', 'zoom', 'coordinates', 'action', 'name'));
}
}
