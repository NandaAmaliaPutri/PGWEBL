<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use App\Models\PolygonModel;
use Illuminate\Http\Request;
use App\Models\PolylineModel;

class ApiController extends Controller
{
    public function __construct()
    {
        $this->points = new PointsModel();
        $this->polyline = new PolylineModel();
        $this->polygon = new PolygonModel();
    }

    public function points()
    {
        $points = $this->points->gejson_points();
        return response()->json($points);
    }

    public function point($id)
    {
        $points = $this->points->gejson_point($id);
        return response()->json($points);
    }

    public function polyline()
    {
        $polyline = $this->polyline->gejson_polyline();
        return response()->json($polyline, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polylines($id)
    {
        $polyline = $this->polyline->gejson_polylines($id);
        return response()->json($polyline, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygon()
    {
        $polygon = $this->polygon->gejson_polygon();
            return response()->json($polygon, 200, [], JSON_NUMERIC_CHECK);
    }

    public function polygons($id)
    {
        $polygon = $this->polygon->gejson_polygons($id);
            return response()->json($polygon, 200, [], JSON_NUMERIC_CHECK);
    }
}
