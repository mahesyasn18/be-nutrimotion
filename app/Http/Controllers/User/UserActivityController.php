<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\DailyActivity;
use App\Models\DetailDailyActivity;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;

class UserActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activities = Activity::orderBy("activity_name", "asc")->get();

        $activityData = [];
        foreach ($activities as $activity) {
            $activityData[] = [
                "id" => $activity->id,
                "activity_name" => $activity->activity_name,
                "jumlah_kalori_rendah" => $activity->jumlah_kalori_rendah,
                "photo" => $activity->photo,
                "jumlah_kalori_sedang" => $activity->jumlah_kalori_sedang,
                "jumlah_kalori_tinggi" => $activity->jumlah_kalori_tinggi,
            ];
        }

        return response()->json($activityData);
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
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $activity = Activity::where("activity_name", $request->activity_name)->first();
        return response()->json([
            "id" => $activity->id,
            "activity_name" => $activity->activity_name,
            "jumlah_kalori_rendah" => $activity->jumlah_kalori_rendah,
            "photo" => $activity->photo,
            "jumlah_kalori_sedang" => $activity->jumlah_kalori_sedang,
            "jumlah_kalori_tinggi" => $activity->jumlah_kalori_tinggi,
        ]);
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

    public function userGetGoal(Request $request)
    {
        $user = $request->user();
        $dailyActivity = DailyActivity::where('user_id', $user->id)->whereDate("tanggal", today())->first();
        if ($dailyActivity != null) {
            return response()->json([
                "id" => $dailyActivity->id,
                "user_id" => $dailyActivity->user_id,
                "tanggal" => $dailyActivity->tanggal,
                "kalori" => $dailyActivity->kalori,
                "message" => "Available"
            ]);
        }else{
            return response()->json([
                "message" => "null"
            ]);
        }

    }

    public function allActivity(Request $request)
    {

            $user = $request->user();
            $dailyActivity = DailyActivity::where('user_id', $user->id)->whereDate("tanggal", today())->first();
            if (!$dailyActivity) {
                return response()->json([]);
            }
            $detailDailyActivity = DetailDailyActivity::with("activity")->where('daily_activity_id', $dailyActivity->id)->get();

            $activityData = [];
            if ($detailDailyActivity !=null) {
                foreach ($detailDailyActivity as $activity) {
                    $activityData[] = [
                        "id" => $activity->id,
                        "durasi" => $activity->durasi,
                        "total_kalori" => intval($activity->total_kalori),
                        "waktu" => $activity->waktu,
                        "activity_name" => $activity->activity->activity_name,
                        "photo" => $activity->activity->photo,
                    ];
                }
                return response()->json($activityData);
            }else{
                return response()->json(["message"=>"failed"]);
            }

    }

    public function getCalories(Request $request)
    {
        try {
            $user = $request->user();
            $dailyActivity = DailyActivity::where('user_id', $user->id)
                ->whereDate("tanggal", today())
                ->first();

            if (!$dailyActivity) {
                return response()->json(["total_kalori" => 0]);
            }

            $detailDailyActivity = DetailDailyActivity::with("activity")
                ->where('daily_activity_id', $dailyActivity->id)
                ->get();

            $totalKalori = 0;
            foreach ($detailDailyActivity as $activity) {
                $totalKalori += $activity->total_kalori;
            }

            return response()->json(['total_kalori' => $totalKalori]);
        } catch (\Throwable $th) {
            return response()->json(['total_kalori' => 0]);
        }

    }

    public function storeDetailActivity(Request $request)
    {

        try{
            $validatedData = $request->validate([
                'durasi' => [
                    'required',
                ],
                'waktu' => [
                    'required',
                ],
                'total_kalori' => [
                    'required',
                ]
            ]);
        }catch (ValidationException $e){
            return response()->json([
                'message' => 'store goals failed gagal',
                'errors' => $e,
                'response' => 500
            ], 500);
        }

        $user = $request->user();
        $activity = Activity::where("activity_name", $request->jenis_activity)->first();
        $dailyActivity = DailyActivity::where('user_id', $user->id)->whereDate("tanggal", today())->first();

        $validatedData['activity_id'] = $activity->id;
        $validatedData['daily_activity_id'] = $dailyActivity->id;
        $detailDailyActivity = DetailDailyActivity::create($validatedData);
        return response()->json([
            "id" => $detailDailyActivity->id,
            'daily_activity_id' => $detailDailyActivity->daily_activity_id,
            'activity_id' => $detailDailyActivity->activity_id,
            'durasi' => intval($detailDailyActivity->durasi),
            'total_kalori' => intval($detailDailyActivity->total_kalori),
            'waktu' => $detailDailyActivity->waktu,
            'message' => 'Store Detail Daily Activity berhasil',
            'response' => 200
        ]);
    }

    public function userStoreGoal(Request $request)
    {
        try{
            $validatedData = $request->validate([
                'kalori' => [
                    'required',
                ]
            ]);
        }catch (ValidationException $e){
            return response()->json([
                'message' => 'store goals failed gagal',
                'errors' => $e,
                'response' => 422
            ], 422);
        }
        $validatedData['user_id'] = $request->user()->id;
        $validatedData['tanggal'] = date('Y-m-d', strtotime('now'));
        $goals = DailyActivity::create($validatedData);
        return response()->json([
            'user_id' => $goals->user_id,
            'tanggal' => $goals->tanggal,
            'kalori' => intval($goals->kalori),
            'message' => 'Store goals berhasil',
            'response' => 200
        ]);

    }
}
