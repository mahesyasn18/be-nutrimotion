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
        try {
            // Validate input from request
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

            // Check if the request expects a JSON response (API)
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Activity created successfully',
                    'data' => $activity
                ], 201);
            }

            // If not, return a view (web request)
            return redirect()->route('activities')->with('create_success', 'Activity created successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Activity creation failed',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('add-activity-form')->with('create_failed', 'Failed to update activity.');
        }
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
        try {
            // Validate input from request
            $validatedData = $request->validate([
                'activity_name' => 'nullable|string',
                'jumlah_kalori_rendah' => 'required|numeric',
                'jumlah_kalori_sedang' => 'required|numeric',
                'jumlah_kalori_tinggi' => 'required|numeric',
            ]);

            // Find the activity by ID
            $activity = Activity::findOrFail($id);

            // If a new photo is uploaded, process the file and update the photo URL
            if ($request->hasFile('photo')) {
                // Delete the old photo if it exists
                if ($activity->photo) {
                    Storage::delete(str_replace('/storage', 'public', $activity->photo));
                }

                $photo = $request->file('photo');
                $path = Storage::putFile('public/activity', $photo);
                $url = Storage::url($path);
                $validatedData['photo'] = $url;
            }

            // Update the activity with validated data
            $activity->update($validatedData);

            // Check if the request expects a JSON response (API)
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Activity updated successfully',
                    'data' => $activity
                ], 200);
            }

            // If not, return a view (web request)
            return redirect()->route('activities')->with('edit_success', 'Activity updated successfully.');
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Activity update failed',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('edit-activity-form', ['id' => $id])->with('edit_failed', 'Failed to update aactivity.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the activity by ID
            $activity = Activity::findOrFail($id);

            // Delete the photo if it exists
            if ($activity->photo) {
                Storage::delete(str_replace('/storage', 'public', $activity->photo));
            }

            // Delete the activity
            $activity->delete();

            // Check if the request expects a JSON response (API)
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Activity deleted successfully'
                ], 200);
            }

            // If not, return a view (web request)
            return redirect()->route('activities')->with('delete_success', 'Activity deleted successfully.');
        } catch (\Exception $e) {
            if (request()->expectsJson()) {
                return response()->json([
                    'message' => 'Activity deletion failed',
                    'error' => $e->getMessage()
                ], 500);
            }

            return redirect()->route('activities')->with('delete_failed', 'Failed to delete activity.');
        }
    }

}
