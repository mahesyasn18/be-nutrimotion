<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        // Validasi input dari request, termasuk validasi untuk file gambar
        $validatedData = $request->validate([
            'brand' => 'nullable|string',
            'food_name' => 'required|string',
            'food_type' => 'required|string',
            'size' => 'required|numeric',
            'barcode_number' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
        ]);

        // Jika ada file gambar yang diunggah
        if ($request->hasFile('picture')) {
            $photo = $request->file('picture');

            // Simpan foto ke dalam penyimpanan dengan nama file yang unik
            $path = Storage::putFile('public/food', $photo);

            // Dapatkan URL lengkap untuk gambar yang disimpan
            $url = Storage::url($path);


            // Simpan URL gambar ke dalam data yang akan disimpan
            $validatedData['picture'] = $url;
        }

        // Membuat data baru dengan gambar jika ada
        $food = Food::create($validatedData);

        // Mengembalikan response
        return response()->json([
            'message' => 'Food created successfully',
            'data' => $food
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
