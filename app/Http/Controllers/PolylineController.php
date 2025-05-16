<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PolylineModel;

class PolylineController extends Controller
{
    public function __construct()
    {
        $this->polyline = new PolylineModel();
    }

    /**
     * Display a listing of the resource.
     */
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
                'name' => 'required|unique:polyline,name',
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:50'
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry polyline is required',
            ]
        );

        // Create images directory if not exsist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
            $image->move('storage/images', $name_image);
        } else {
            $name_image = null;
        }


        $data = [
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
        ];

        // Create data
        if (!$this->polyline->create($data)) {
            return redirect()->route('map')->with('error', 'Polyline failed to add');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polyline has been added');
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
        'title' => 'Edit Polyline',
        'id' => $id,
    ];

    return view('edit-polyline', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate request
        $request->validate(
            [
                'name' => 'required|unique:polyline,name,' . $id,
                'description' => 'required',
                'geom_polyline' => 'required',
                'image' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:50',
            ],
            [
                'name.required' => 'Name is required',
                'name.unique' => 'Name already exists',
                'description.required' => 'Description is required',
                'geom_polyline.required' => 'Geometry polyline is required',
            ]
        );


        // Create images directory if not exsist
        if (!is_dir('storage/images')) {
            mkdir('./storage/images', 0777);
        }

        // Get ald image file name
        $old_image = $this->polyline->find($id)->images;

        // Get image file
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name_image = time() . "_polyline." . strtolower($image->getClientOriginalExtension());
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
            'geom' => $request->geom_polyline,
            'name' => $request->name,
            'description' => $request->description,
            'images' => $name_image,
        ];

        // Create data
        if (!$this->polyline->find($id)->update($data)) {
            return redirect()->route('map')->with('error', 'Polyline failed to update');
        }

        // Redirect to Map
        return redirect()->route('map')->with('success', 'Polyline has been updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $polyline = $this->polyline->find($id);
    $imagefile = $polyline->images;

    // Hapus gambar jika ada
    if ($imagefile != null) {
        $imagePath = './storage/images/' . $imagefile;
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    }

    // Hapus data polyline
    if (!$this->polyline->destroy($id)) {
        return redirect()->route('map')->with('error', 'Polyline failed to delete');
    }

    return redirect()->route('map')->with('success', 'Polyline has been deleted');
}
}
