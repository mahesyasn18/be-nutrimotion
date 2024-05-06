<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Food;
use App\Service\ResponseAPIService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserFoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

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
}
