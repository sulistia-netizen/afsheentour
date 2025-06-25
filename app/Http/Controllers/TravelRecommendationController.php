<?php

namespace App\Http\Controllers;

use App\Helpers\GeneticAlgorithmHelper;
use App\Models\Activity;
use App\Models\Destination;
use Illuminate\Http\Request;

class TravelRecommendationController extends Controller
{
    public function showForm()
    {
        $activities = Activity::all();
        $destinations = Destination::all();
        return view('travel.recommendation', compact('activities', 'destinations'));
    }

    public function recommend(Request $request)
    {
        // Validasi input
        $request->validate([
            'min_budget' => 'required|numeric',
            'max_budget' => 'required|numeric|gte:min_budget',
            'min_duration' => 'required|integer',
            'max_duration' => 'required|integer|gte:min_duration',
            'activities' => 'nullable|array',
        ]);

        // Ambil input pengguna
        $minBudget = $request->input('min_budget');
        $maxBudget = $request->input('max_budget');
        $minDuration = $request->input('min_duration');
        $maxDuration = $request->input('max_duration');
        $selectedActivities = $request->input('activities', []);

        // Jalankan algoritma genetika menggunakan helper
        try {
            $gaHelper = new GeneticAlgorithmHelper(
                $minBudget,
                $maxBudget,
                $minDuration,
                $maxDuration,
                $selectedActivities
            );
            $bestPackage = $gaHelper->run();
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        // Tampilkan hasil rekomendasi
        return view('travel.result', compact('bestPackage'));
    }
}
