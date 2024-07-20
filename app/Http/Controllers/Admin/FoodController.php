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
        try {
            // Validasi input dari request, termasuk validasi untuk file gambar dan data nutrition
            $validatedData = $request->validate([
                'brand' => 'nullable|string',
                'food_name' => 'required|string',
                'food_type' => 'required|string',
                'size' => 'required|numeric',
                'barcode_number' => 'nullable',
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
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

            // Pisahkan data yang terkait dengan tabel Food dan NutritionFact
            $foodData = $validatedData;
            unset($foodData['per_serving'], $foodData['kalori'], $foodData['lemak_total'], $foodData['lemak_jenuh'], $foodData['protein'], $foodData['karbohidrat_total'], $foodData['gula'], $foodData['garam'], $foodData['serat'], $foodData['vit_a'], $foodData['vit_d'], $foodData['vit_e'], $foodData['vit_k'], $foodData['vit_b1'], $foodData['vit_b2'], $foodData['vit_b3'], $foodData['vit_b5'], $foodData['vit_b6'], $foodData['folat'], $foodData['vit_b12'], $foodData['biotin'], $foodData['kolin'], $foodData['vit_c'], $foodData['kalsium'], $foodData['fosfor'], $foodData['magnesium'], $foodData['natrium'], $foodData['kalium'], $foodData['mangan'], $foodData['tembaga'], $foodData['kromium'], $foodData['besi'], $foodData['iodium'], $foodData['seng'], $foodData['selenium'], $foodData['fluor']);

            // Membuat data baru Food
            $food = Food::create($foodData);

            // Data nutrition fact dihubungkan dengan food_id
            $nutritionFactData = $validatedData;
            $nutritionFactData['food_id'] = $food->id;

            // Buat data nutrition fact
            $nutritionFact = NutritionFact::create($nutritionFactData);

            // Mengembalikan response
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Food and nutrition fact created successfully',
                    'food' => $food,
                    'nutrition_fact' => $nutritionFact
                ], 201);
            } else {
                return redirect()->route('foods')->with('create_success', 'Food and nutrition fact created successfully.');
            }
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Failed to create food and nutrition fact',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                return redirect()->route('add-food-form')->with('create_failed', 'Failed to create food and nutrition fact.');
            }
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
    public function update(Request $request, $id)
    {
        try {
            // Validasi input dari request, termasuk validasi untuk file gambar dan data nutrition
            $validatedData = $request->validate([
                'brand' => 'nullable|string',
                'food_name' => 'required|string',
                'food_type' => 'required|string',
                'size' => 'required|numeric',
                'barcode_number' => 'nullable',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi untuk file gambar
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

            // Temukan food yang akan diupdate
            $food = Food::findOrFail($id);
            $nutritionFact = NutritionFact::where('food_id', $id)->firstOrFail();

            // Jika ada file gambar yang diunggah
            if ($request->hasFile('picture')) {
                $photo = $request->file('picture');

                // Hapus gambar lama jika ada
                if ($food->picture) {
                    Storage::delete(str_replace('/storage/', 'public/', $food->picture));
                }

                // Simpan foto ke dalam penyimpanan dengan nama file yang unik
                $path = Storage::putFile('public/food', $photo);

                // Dapatkan URL lengkap untuk gambar yang disimpan
                $url = Storage::url($path);

                // Simpan URL gambar ke dalam data yang akan disimpan
                $validatedData['picture'] = $url;
            } else {
                // Pertahankan URL gambar lama jika tidak ada file gambar baru
                $validatedData['picture'] = $food->picture;
            }

            // Pisahkan data yang terkait dengan tabel Food dan NutritionFact
            $foodData = $validatedData;
            unset($foodData['per_serving'], $foodData['kalori'], $foodData['lemak_total'], $foodData['lemak_jenuh'], $foodData['protein'], $foodData['karbohidrat_total'], $foodData['gula'], $foodData['garam'], $foodData['serat'], $foodData['vit_a'], $foodData['vit_d'], $foodData['vit_e'], $foodData['vit_k'], $foodData['vit_b1'], $foodData['vit_b2'], $foodData['vit_b3'], $foodData['vit_b5'], $foodData['vit_b6'], $foodData['folat'], $foodData['vit_b12'], $foodData['biotin'], $foodData['kolin'], $foodData['vit_c'], $foodData['kalsium'], $foodData['fosfor'], $foodData['magnesium'], $foodData['natrium'], $foodData['kalium'], $foodData['mangan'], $foodData['tembaga'], $foodData['kromium'], $foodData['besi'], $foodData['iodium'], $foodData['seng'], $foodData['selenium'], $foodData['fluor']);

            // Update data Food
            $food->update($foodData);

            // Data nutrition fact dihubungkan dengan food_id
            $nutritionFactData = $validatedData;
            $nutritionFactData['food_id'] = $food->id;

            // Update data NutritionFact
            $nutritionFact->update($nutritionFactData);

            // Mengembalikan response
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Food and nutrition fact updated successfully',
                    'food' => $food,
                    'nutrition_fact' => $nutritionFact
                ], 200);
            } else {
                return redirect()->route('foods')->with('update_success', 'Food and nutrition fact updated successfully.');
            }
        } catch (\Exception $e) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Failed to update food and nutrition fact',
                    'error' => $e->getMessage()
                ], 500);
            } else {
                return redirect()->route('edit-food-form', $id)->with('update_failed', 'Failed to update food and nutrition fact.');
            }
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $food = food::findOrFail($id);

            $food->delete();

            return redirect()->route('foods')->with('delete_success', 'food deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('foods')->with('delete_failed', 'Failed to delete food.');
        }
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
