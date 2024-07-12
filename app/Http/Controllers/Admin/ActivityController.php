<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activity =  Activity::get();
        dd($activity);

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
        $validatedData = $request->validate([
            'activity_name' => 'nullable|string',
            'jumlah_kalori_rendah' => 'required|numeric',
            'jumlah_kalori_sedang' => 'required|numeric',
            'jumlah_kalori_tinggi' => 'required|numeric',
        ]);

        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $path = Storage::putFile('public/activity', $photo);
            $url = Storage::url($path);
            $validatedData['photo'] = $url;
        }

        $activity = Activity::create($validatedData);

        return response()->json([
            'message' => 'Activity created successfully',
            'data' => $activity
        ], 201);
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

}
