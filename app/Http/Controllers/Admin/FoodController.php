<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Models\NutritionFact;
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

    public function storeNutriFact(Request $request)
    {
         // Validasi input
         $validatedData = $request->validate([
            'food_id' => 'required|exists:foods,id',
            'per_serving' => 'nullable|integer',
            'kalori' => 'nullable|integer',
            'lemak_total' => 'nullable|integer',
            'lemak_jenuh' => 'nullable|integer',
            'protein' => 'nullable|integer',
            'karbohidrat_total' => 'nullable|integer',
            'gula' => 'nullable|integer',
            'garam' => 'nullable|integer',
            'serat' => 'nullable|integer',
            'vit_a' => 'nullable|integer',
            'vit_d' => 'nullable|integer',
            'vit_e' => 'nullable|integer',
            'vit_k' => 'nullable|integer',
            'vit_b1' => 'nullable|integer',
            'vit_b2' => 'nullable|integer',
            'vit_b3' => 'nullable|integer',
            'vit_b5' => 'nullable|integer',
            'vit_b6' => 'nullable|integer',
            'folat' => 'nullable|integer',
            'vit_b12' => 'nullable|integer',
            'biotin' => 'nullable|integer',
            'kolin' => 'nullable|integer',
            'vit_c' => 'nullable|integer',
            'kalsium' => 'nullable|integer',
            'fosfor' => 'nullable|integer',
            'magnesium' => 'nullable|integer',
            'natrium' => 'nullable|integer',
            'kalium' => 'nullable|integer',
            'mangan' => 'nullable|integer',
            'tembaga' => 'nullable|integer',
            'kromium' => 'nullable|integer',
            'besi' => 'nullable|integer',
            'iodium' => 'nullable|integer',
            'seng' => 'nullable|integer',
            'selenium' => 'nullable|integer',
            'fluor' => 'nullable|integer',
        ]);

        // Buat data baru
        $nutritionFact = NutritionFact::create($validatedData);

        return response()->json([
            'message' => 'Nutrition fact created successfully',
            'data' => $nutritionFact
        ], 201); // Status code 201 untuk created
    }
}
