<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class PolygonModel extends Model
{
    protected $table = 'polygon';

    protected $guarded = ['id'];

    public function gejson_polygon()
    {
        $polygons = $this
            ->select(DB::raw('
                polygon.id,
                st_asgeojson(polygon.geom) as geom,
                polygon.name,
                polygon.description,
                polygon.images,
                st_area(polygon.geom, true) as area_m2,
                st_area(polygon.geom, true)/1000000 as area_km2,
                st_area(polygon.geom, true)/10000 as area_hektar,
                polygon.created_at,
                polygon.updated_at,
                users.name as user_created
            '))
            ->leftJoin('users', 'polygon.user_id', '=', 'users.id')
            ->get();


        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m2' => $p->area_m2,
                    'area_km2' => $p->area_km2,
                    'area_hektar' => $p->area_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'images' => $p->images,
                    'user_id' => $p->user_id,
                    'user_created' => $p->user_created,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }

    public function gejson_polygons($id)
    {
        $polygons = $this
            ->select(DB::raw('id, st_asgeojson(geom) as geom, name, description, images,
    st_area(geom, true) as area_m2,
    st_area(geom, true)/1000000 as area_km2,
    st_area(geom, true)/10000 as area_hektar,
    created_at, updated_at'))
            ->where('id', $id)
            ->get();

        $geojson = [
            'type' => 'FeatureCollection',
            'features' => [],
        ];

        foreach ($polygons as $p) {
            $feature = [
                'type' => 'Feature',
                'geometry' => json_decode($p->geom),
                'properties' => [
                    'id' => $p->id,
                    'name' => $p->name,
                    'description' => $p->description,
                    'area_m2' => $p->area_m2,
                    'area_km2' => $p->area_km2,
                    'area_hektar' => $p->area_hektar,
                    'created_at' => $p->created_at,
                    'updated_at' => $p->updated_at,
                    'images' => $p->images,
                ],
            ];

            array_push($geojson['features'], $feature);
        }

        return $geojson;
    }
}
