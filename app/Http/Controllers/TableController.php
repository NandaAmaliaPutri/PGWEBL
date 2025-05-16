<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolygonModel;
use App\Models\PolylineModel;
use Illuminate\Http\Request;

class TableController extends Controller
{

public function __construct()
{
    $this->points = new PointsModel();
    $this->polyline = new PolylineModel();
    $this->polygon = new PolygonModel();
}

public function index()
    {
        $data = [
            'title' => 'Table',
            'points' => $this->points->all(),
        ];

        return view('table', $data);
    }
}
