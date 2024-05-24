<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\DailyNutrition;
use App\Models\EatenFood;
use App\Models\Food;
use App\Service\ResponseAPIService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAllFood()
    {
        $foods = Food::with('nutritionFact')->get();
        $foodsJson = $foods->map(function($food) {
            return [
                "id"=> $food->id,
                 "brand" => $food->brand,
                 "food_name" => $food->food_name,
                 "picture" => $food->picture,
                 "food_type"=>$food->food_type,
                 "food_category"=>$food->food_category,
                 "size"=>$food->size,
                 "barcode_number"=>$food->barcode_number,
                     "kalori" =>$food->nutritionFact->kalori,
                     "lemak_total" =>$food->nutritionFact->lemak_total,
                     "lemak_jenuh" =>$food->nutritionFact->lemak_jenuh,
                     "protein" =>$food->nutritionFact->protein,
                     "karbohidrat_total" =>$food->nutritionFact->karbohidrat_total,
                     "gula" =>$food->nutritionFact->gula,
                     "garam" =>$food->nutritionFact->garam,
                     "serat" =>$food->nutritionFact->serat,
                     "vit_a" =>$food->nutritionFact->vit_a,
                     "vit_d" =>$food->nutritionFact->vit_d,
                     "vit_e" =>$food->nutritionFact->vit_e,
                     "vit_k" =>$food->nutritionFact->vit_k,
                     "vit_b1" =>$food->nutritionFact->vit_b1,
                     "vit_b2" =>$food->nutritionFact->vit_b2,
                     "vit_b3" =>$food->nutritionFact->vit_b3,
                     "vit_b5" =>$food->nutritionFact->vit_b5,
                     "vit_b6" =>$food->nutritionFact->vit_b6,
                     "folat" =>$food->nutritionFact->folat,
                     "vit_b12" =>$food->nutritionFact->vit_b12,
                     "biotin" =>$food->nutritionFact->biotin,
                     "kolin" =>$food->nutritionFact->kolin,
                     "vit_c" =>$food->nutritionFact->vit_c,
                     "kalsium" =>$food->nutritionFact->kalsium,
                     "fosfor" =>$food->nutritionFact->fosfor,
                     "magnesium" =>$food->nutritionFact->magnesium,
                     "natrium" =>$food->nutritionFact->natrium,
                     "kalium" =>$food->nutritionFact->kalium,
                     "mangan" =>$food->nutritionFact->mangan,
                     "tembaga" =>$food->nutritionFact->tembaga,
                     "kromium" =>$food->nutritionFact->kromium,
                     "besi" =>$food->nutritionFact->besi,
                     "iodium" =>$food->nutritionFact->iodium,
                     "seng" =>$food->nutritionFact->seng,
                     "selenium" =>$food->nutritionFact->selenium,
                     "fluor" =>$food->nutritionFact->fluor
            ];
        })->toArray();
        return response()->json($foodsJson, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function getUserHistoryFood(Request $request)
    {
        $userId = $request->user()->id;

        // Ambil semua DailyNutrition milik user
        $dailyNutritions = DailyNutrition::where('user_id', $userId)
                            ->with('eatenFood')
                            ->get();

        // Kumpulkan semua makanan yang pernah dimakan user
        $eatenFoods = [];
        foreach ($dailyNutritions as $dailyNutrition) {
            foreach ($dailyNutrition->eatenFood as $eatenFood) {
                $eatenFoods[] = $eatenFood;
            }
        }

    // Hilangkan duplikasi berdasarkan food_name
    $uniqueEatenFoods = collect($eatenFoods)->unique('food_name')->values();

    // Gabungkan data food beserta nutrition facts jika ada
    $historyEatenFood = $uniqueEatenFoods->map(function ($eatenFood) {
        $food = Food::with('nutritionFact')->where('food_name', $eatenFood->food_name)->first();
        if ($food) {
            return [
                "id"=> $food->id,
                 "brand" => $food->brand,
                 "food_name" => $food->food_name,
                 "picture" => $food->picture,
                 "food_type"=>$food->food_type,
                 "food_category"=>$food->food_category,
                 "size"=>$food->size,
                 "barcode_number"=>$food->barcode_number,
                 "eat_time"=>$eatenFood->eat_time,
                 "date_time"=>$eatenFood->created_at,
                     "kalori" =>$food->nutritionFact->kalori,
                     "lemak_total" =>$food->nutritionFact->lemak_total,
                     "lemak_jenuh" =>$food->nutritionFact->lemak_jenuh,
                     "protein" =>$food->nutritionFact->protein,
                     "karbohidrat_total" =>$food->nutritionFact->karbohidrat_total,
                     "gula" =>$food->nutritionFact->gula,
                     "garam" =>$food->nutritionFact->garam,
                     "serat" =>$food->nutritionFact->serat,
                     "vit_a" =>$food->nutritionFact->vit_a,
                     "vit_d" =>$food->nutritionFact->vit_d,
                     "vit_e" =>$food->nutritionFact->vit_e,
                     "vit_k" =>$food->nutritionFact->vit_k,
                     "vit_b1" =>$food->nutritionFact->vit_b1,
                     "vit_b2" =>$food->nutritionFact->vit_b2,
                     "vit_b3" =>$food->nutritionFact->vit_b3,
                     "vit_b5" =>$food->nutritionFact->vit_b5,
                     "vit_b6" =>$food->nutritionFact->vit_b6,
                     "folat" =>$food->nutritionFact->folat,
                     "vit_b12" =>$food->nutritionFact->vit_b12,
                     "biotin" =>$food->nutritionFact->biotin,
                     "kolin" =>$food->nutritionFact->kolin,
                     "vit_c" =>$food->nutritionFact->vit_c,
                     "kalsium" =>$food->nutritionFact->kalsium,
                     "fosfor" =>$food->nutritionFact->fosfor,
                     "magnesium" =>$food->nutritionFact->magnesium,
                     "natrium" =>$food->nutritionFact->natrium,
                     "kalium" =>$food->nutritionFact->kalium,
                     "mangan" =>$food->nutritionFact->mangan,
                     "tembaga" =>$food->nutritionFact->tembaga,
                     "kromium" =>$food->nutritionFact->kromium,
                     "besi" =>$food->nutritionFact->besi,
                     "iodium" =>$food->nutritionFact->iodium,
                     "seng" =>$food->nutritionFact->seng,
                     "selenium" =>$food->nutritionFact->selenium,
                     "fluor" =>$food->nutritionFact->fluor
            ];
        }
    })->filter();

    return response()->json($historyEatenFood->values());
}



    public function getUserDailyNutrition(Request $request)
    {
        try {
            //code...
            $userId = $request->user()->id;
            $dailyNut = DailyNutrition::where('user_id', $userId)->whereDate('tanggal', now()->format('Y-m-d'))->first();
            if (!$dailyNut) {
                return response()->json([
                    'message' => 'Data tidak ditemukan'
                ], 404);
            }
            return response()->json(
                $dailyNut, 200
            );
        } catch (\Throwable $th) {
            return response()->json([
                'error' => 'Terjadi kesalahan pada server',
                'message' => $th->getMessage()
            ], 500);
        }
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

    public function checkfood(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'barcode_number' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }

        $barcodeExists = Food::where('barcode_number', $request->barcode_number)->exists();
        if ($barcodeExists) {
            $data =  Food::where('barcode_number', $request->barcode_number)->first();
            return response()->json([
                'is_barcode_exist' => $barcodeExists,
                'food_name'=> $data->food_name,
                'barcode_number' =>$data->barcode_number,
            ]);
        }else{
            return response()->json([
                'is_barcode_exist' => $barcodeExists,
                'food_name'=> null,
                'barcode_number'=> null

            ]);
        }

    }

    public function show(Request $request){

        $barcode = $request->barcode_number;
         try {
             $food = Food::with('nutritionFact')->where("barcode_number", $barcode)->first();
             return response()->json([
                 "id"=> $food->id,
                 "brand" => $food->brand,
                 "food_name" => $food->food_name,
                 "picture" => $food->picture,
                 "food_type"=>$food->food_type,
                 "food_category"=>$food->food_category,
                 "size"=>$food->size,
                 "barcode_number"=>$food->barcode_number,
                     "kalori" =>$food->nutritionFact->kalori,
                     "lemak_total" =>$food->nutritionFact->lemak_total,
                     "lemak_jenuh" =>$food->nutritionFact->lemak_jenuh,
                     "protein" =>$food->nutritionFact->protein,
                     "karbohidrat_total" =>$food->nutritionFact->karbohidrat_total,
                     "gula" =>$food->nutritionFact->gula,
                     "garam" =>$food->nutritionFact->garam,
                     "serat" =>$food->nutritionFact->serat,
                     "vit_a" =>$food->nutritionFact->vit_a,
                     "vit_d" =>$food->nutritionFact->vit_d,
                     "vit_e" =>$food->nutritionFact->vit_e,
                     "vit_k" =>$food->nutritionFact->vit_k,
                     "vit_b1" =>$food->nutritionFact->vit_b1,
                     "vit_b2" =>$food->nutritionFact->vit_b2,
                     "vit_b3" =>$food->nutritionFact->vit_b3,
                     "vit_b5" =>$food->nutritionFact->vit_b5,
                     "vit_b6" =>$food->nutritionFact->vit_b6,
                     "folat" =>$food->nutritionFact->folat,
                     "vit_b12" =>$food->nutritionFact->vit_b12,
                     "biotin" =>$food->nutritionFact->biotin,
                     "kolin" =>$food->nutritionFact->kolin,
                     "vit_c" =>$food->nutritionFact->vit_c,
                     "kalsium" =>$food->nutritionFact->kalsium,
                     "fosfor" =>$food->nutritionFact->fosfor,
                     "magnesium" =>$food->nutritionFact->magnesium,
                     "natrium" =>$food->nutritionFact->natrium,
                     "kalium" =>$food->nutritionFact->kalium,
                     "mangan" =>$food->nutritionFact->mangan,
                     "tembaga" =>$food->nutritionFact->tembaga,
                     "kromium" =>$food->nutritionFact->kromium,
                     "besi" =>$food->nutritionFact->besi,
                     "iodium" =>$food->nutritionFact->iodium,
                     "seng" =>$food->nutritionFact->seng,
                     "selenium" =>$food->nutritionFact->selenium,
                     "fluor" =>$food->nutritionFact->fluor
             ], 200);
         } catch (ModelNotFoundException $e) {
             return ResponseAPIService::createResponse(404,"Not Found");
         } catch (\Exception $e) {
             return ResponseAPIService::createResponse(500,"Internal Server Error");
         }

     }

     public function storeEatenFood(Request $request)
     {
        $validator = Validator::make($request->all(), [
            'food_name' => 'required|string|max:255',
            'food_type' => 'required|in:berat,kemasan',
            'food_category' => 'required|in:makanan,minuman',
            'size' => 'required|integer',
            'kalori' => 'required|integer',
            'karbohidrat' => 'required|integer',
            'lemak_total' => 'required|integer',
            'protein' => 'required|integer',
            'eat_time' => 'required|date_format:H:i:s'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->first()], 422);
        }
        $eatenFoodData = $validator->validated(); // Ambil data yang tervalidasi

        $userId = $request->user()->id;
        $dailyNut = DailyNutrition::where('user_id', $userId)
                    ->whereDate('tanggal', now()->format('Y-m-d'))
                    ->first();
        
        if (!$dailyNut) {
            return response()->json([
                'error' => 'Daily nutrition data not found for this user and date.',
            ], 404); // Status 404 menunjukkan resource tidak ditemukan
        }
        // menyimpan referensi daily nut id
        $eatenFoodData['daily_nutrition_id'] = $dailyNut->id;
        $eatenFood = EatenFood::create($eatenFoodData);

        return response()->json([
            'message' => 'Eaten Food Successfully Registered!',
            'data' => $eatenFood,
        ], 200);
     }

     public function getUserEatenFood(Request $request)
     {
        $userId = $request->user()->id;
        try {
            $dailyNut = DailyNutrition::where('user_id', $userId)->whereDate('tanggal', now()->format('Y-m-d'))->first();
            $eatenFoodData = EatenFood::where('daily_nutrition_id', $dailyNut->id)->get();
            return response()->json($eatenFoodData,200);    
        } catch (\Throwable $e) {
            return ResponseAPIService::createResponse(500, $e->getMessage());
        }
        
     }

}
