<?php

namespace App\Http\Controllers;

use App\Models\PointsModel;
use Illuminate\Http\Request;

use function PHPSTORM_META\map;

class PointsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->points = new PointsModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Map',
        ];

        return view('map', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validate request
        $request->validate(
            [
                'name' => 'required|unique:points,name',
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:50',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Geometry point is required',
            ]
        );


        // Create images directory if not exsist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
            'user_id' => auth()->user()->id
        ];

        // Create data
        if (!$this->points->create($data)) {
            return redirect()->route('map')->with('error', 'Point failed to add');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Point has been added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'title' => 'Edit Point',
            'id' => $id,
        ];

        return view('edit-point', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($id,$request->all());

        // Validate request
        $request->validate(
            [
                'name' => 'required|unique:points,name,' . $id,
                'description' => 'required',
                'geom_point' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:50',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_point.required' => 'Geometry point is required',
            ]
        );


        // Create images directory if not exsist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get ald image file name
        $old_image = $this->points->find($id)->images;

        // Get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_point." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);

            // Delete old image file
            if ($old_image != null) {
                if (file_exists('./storage/images/' . $old_image)) {
                    unlink('./storage/images/' . $old_image);
                }
            }
        } else {
            $name_image = $old_image;
        }

        $data = [
            'geom' => $request->geom_point,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
        ];

        // Create data
        if (!$this->points->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Point failed to update');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Point has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $point = $this->points->find($id);
        $imagefile = $point->images;

        // Hapus image file jika ada
        if ($imagefile != null) {
            $path = './storage/images/' . $imagefile;
            if (file_exists($path)) {
                unlink($path);
            }
        }

        // Hapus record di database
        if (!$this->points->destroy($id)) {
            return redirect()->route('map')->with('error', 'Point failed to delete');
        }

        return redirect()->route('map')->with('success', 'Point has been deleted');
    }
}
