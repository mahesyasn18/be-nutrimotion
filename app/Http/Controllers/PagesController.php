<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Food;
use App\Models\NutritionFact;
use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Symfony\Component\HttpFoundation\Request;

class PagesController extends Controller
{
    public function viewDashboard()
    {
        $routePrefix = 'dashboard';
        $userCount = User::count();
        $foodCount = Food::count();
        $activityCount = Activity::count();

        return view('pages/dashboard', compact('userCount', 'foodCount', 'activityCount', 'routePrefix'));
    }

    //Uers
    public function viewUsers()
    {
        $users = User::all();
        return view('pages/users', compact('users'));
    }

    public function viewUserForm()
    {
        return view('pages/add-users');
    }

    public function viewUserUpdateForm(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return view('pages/layouts-error-404-2');
        }
        return view('pages/edit-users', compact('user'));
    }


    //Foods
    public function viewFoods()
    {
        $foods = Food::with('nutritionFact')->get(); // Use get() to retrieve a collection of foods
        $totalNutrition = [];

        // Iterate through each food
        foreach ($foods as $food) {
            $nutritionFact = $food->nutritionFact;

            // Initialize total nutrition for this food
            $foodTotalNutrition = 0;

            // Check if nutritionFact exists and calculate the total for this food
            if ($nutritionFact) {
                foreach ($nutritionFact->toArray() as $key => $value) {
                    // Skip the "food_id" field
                    if ($key === 'food_id') {
                        continue;
                    }

                    // Check if the value is numeric and sum it up
                    if (is_numeric($value)) {
                        $foodTotalNutrition += $value;
                    }
                }
            }

            // Store the total nutrition for this food
            $totalNutrition[$food->id] = $foodTotalNutrition;
        }

        return view('pages.foods', compact('foods', 'totalNutrition'));
    }


    public function viewFoodDetail(Request $request, $id)
    {
        $food = Food::with('nutritionFact')->find($id);

        if (!$food) {
            return view('pages.layouts-error-404-2');
        }

        $nutritionFact = $food->nutritionFact;
        $totalNutrition = 0;

        // List of columns to exclude from the total calculation
        $excludedColumns = ['food_id', 'per_serving', 'lemak_jenuh', 'created_at', 'updated_at'];

        // Check if nutritionFact exists and calculate the total
        if ($nutritionFact) {
            foreach ($nutritionFact->toArray() as $key => $value) {
                // Skip the columns specified in the excluded list
                if (in_array($key, $excludedColumns)) {
                    continue;
                }

                // Check if the value is numeric and sum it up
                if (is_numeric($value)) {
                    $totalNutrition += $value;
                }
            }
        }

        return view('pages.detail-food', compact('food', 'totalNutrition'));
    }


    public function viewFoodForm()
    {
        return view('pages/add-foods');
    }

    public function viewFoodUpdateForm(Request $request, $id)
    {
        // Find the Food with its associated NutritionFact
        $food = Food::with('nutritionFact')->find($id);

        // Check if the food exists
        if (!$food) {
            return view('pages/layouts-error-404-2');
        }

        return view('pages/edit-foods', compact('food'));
    }


    // public function viewNutritions(Request $request)
    // {
    //     $columns = Schema::getColumnListing('nutrition_facts');
    //     $excludeColumns = ['food_id', 'per_serving', 'created_at', 'updated_at'];

    //     // Filter columns
    //     $columns = array_filter($columns, function($column) use ($excludeColumns) {
    //         return !in_array($column, $excludeColumns);
    //     });

    //     $selectedColumn = $request->input('column'); // Use input() instead of query()

    //     // Validate the selected column
    //     if (!in_array($selectedColumn, $columns)) {
    //         $selectedColumn = null; // or set a default column
    //     }

    //     $nutritionsQuery = NutritionFact::with('food');

    //     if ($selectedColumn) {
    //         $nutritionsQuery->whereNotNull($selectedColumn);
    //     }

    //     $nutritions = $nutritionsQuery->get();

    //     return view('pages/nutritions', compact('nutritions', 'columns', 'selectedColumn'));
    // }

    public function viewActivities()
    {
        $activities = Activity::all();
        return view('pages/activities', compact('activities'));
    }

    public function viewActivityForm()
    {
        return view('pages/add-activities');
    }

    public function viewActivityUpdateForm(Request $request, $id)
    {
        $activity = Activity::find($id);

        if (!$activity) {
            return view('pages/layouts-error-404-2');
        }
        return view('pages/edit-activities', compact('activity'));
    }

    public function viewActivityDetail(Request $request, $id)
    {
        // Fetch the activity with related detailDailyActivity and their associated dailyActivity and user
        $activity = Activity::with('detailDailyActivity.dailyActivity.user')->find($id);

        if (!$activity) {
            return view('pages.layouts-error-404-2');
        }

        // Calculate total calories
        $totalCalories = $activity->jumlah_kalori_rendah + $activity->jumlah_kalori_sedang + $activity->jumlah_kalori_tinggi;

        return view('pages.detail-activity', compact('activity', 'totalCalories'));
    }
}
