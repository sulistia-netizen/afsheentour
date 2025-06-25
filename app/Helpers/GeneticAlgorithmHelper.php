<?php

namespace App\Helpers;

use App\Models\Activity;
use App\Models\Destination;
use App\Models\TravelPackage;

class GeneticAlgorithmHelper
{
    private $population;
    private $minBudget;
    private $maxBudget;
    private $minDuration;
    private $maxDuration;
    private $selectedActivities;
    private $selectedDestinations;

    const POPULATION_SIZE = 50;
    const GENERATIONS = 100;
    const MUTATION_RATE = 0.1;
    const TOURNAMENT_SIZE = 3;
    const ELITISM = true;

    public function __construct($minBudget, $maxBudget, $minDuration, $maxDuration, $selectedActivities)
    {
        $this->minBudget = $minBudget;
        $this->maxBudget = $maxBudget;
        $this->minDuration = $minDuration;
        $this->maxDuration = $maxDuration;
        $this->selectedActivities = $selectedActivities;
        $this->initializePopulation();
    }

    private function initializePopulation()
    {
        // Ambil semua destinasi yang memenuhi kriteria budget dan durasi
        $this->population = TravelPackage::with('activities', 'destination')
            ->whereBetween('budget', [$this->minBudget, $this->maxBudget])
            ->whereBetween('duration', [$this->minDuration, $this->maxDuration])
            ->inRandomOrder()
            ->limit(self::POPULATION_SIZE)
            ->get();

        // Jika populasi kosong, tambahkan data dummy
        if ($this->population->isEmpty()) {
            $this->population = collect([
                new TravelPackage([
                    'destination_id' => 1,
                    'duration' => 5,
                    'budget' => 7000000,
                    'activities' => Activity::inRandomOrder()->limit(3)->get(),
                ]),
                new TravelPackage([
                    'destination_id' => 2,
                    'duration' => 7,
                    'budget' => 10000000,
                    'activities' => Activity::inRandomOrder()->limit(3)->get(),
                ]),
            ]);
        }
    }

    public function run()
    {
        if ($this->population->count() < 2) {
            throw new \Exception("Population size is too small for crossover.");
        }
        for ($gen = 0; $gen < self::GENERATIONS; $gen++) {
            $this->population = $this->population->sortByDesc(function ($package) {
                return $this->fitness($package);
            });

            $newPopulation = collect();

            if (self::ELITISM) {
                $newPopulation = $newPopulation->merge($this->population->take(2));
            }

            while ($newPopulation->count() < self::POPULATION_SIZE) {
                $parent1 = $this->selection();
                $parent2 = $this->selection();
                $child = $this->crossover($parent1, $parent2);
                $child = $this->mutate($child);
                $newPopulation->push($child);
            }

            $this->population = $newPopulation;
        }

        return $this->population->sortByDesc(function ($package) {
            return $this->fitness($package);
        })->first();
    }

    private function fitness($package)
    {
        $budgetScore = 1 - ($package->budget - $this->minBudget) / ($this->maxBudget - $this->minBudget);
        $durationScore = ($package->duration - $this->minDuration) / ($this->maxDuration - $this->minDuration);

        $activityScore = 0;
        if (!empty($this->selectedActivities)) {
            $matchedActivities = array_intersect(
                $package->activities->pluck('id')->toArray(),
                $this->selectedActivities
            );
            $activityScore = count($matchedActivities) / count($this->selectedActivities);
        }

        $weights = [
            'budget' => 0.6,
            'duration' => 0.3,
            'activities' => 0.1,
        ];

        return ($weights['budget'] * $budgetScore) +
            ($weights['duration'] * $durationScore) +
            ($weights['activities'] * $activityScore);
    }

    private function selection()
    {
        if ($this->population->isEmpty()) {
            throw new \Exception("Population is empty. Cannot perform selection.");
        }

        $tournamentSize = min(self::TOURNAMENT_SIZE, $this->population->count());
        $contestants = $this->population->random($tournamentSize);

        return $contestants->sortByDesc(function ($package) {
            return $this->fitness($package);
        })->first();
    }

    private function crossover($parent1, $parent2)
    {
        // Pastikan kedua parent tidak null
        if (!$parent1 || !$parent2) {
            throw new \Exception("Invalid parents for crossover.");
        }

        $child = new TravelPackage();

        // Crossover destination_id
        $child->destination_id = rand(0, 1) ? $parent1->destination_id : $parent2->destination_id;

        // Crossover duration
        $child->duration = round(($parent1->duration + $parent2->duration) / 2);

        // Crossover budget
        $child->budget = round(($parent1->budget + $parent2->budget) / 2);

        // Crossover activities
        $combinedActivities = $parent1->activities->merge($parent2->activities)
            ->unique('id')
            ->shuffle()
            ->take(rand(2, 4));

        $child->activities = $combinedActivities;

        return $child;
    }

    private function mutate($package)
    {
        if (mt_rand() / mt_getrandmax() < self::MUTATION_RATE) {
            $package->destination_id = Destination::inRandomOrder()->first()->id;
        }

        if (mt_rand() / mt_getrandmax() < self::MUTATION_RATE) {
            $package->duration += rand(-1, 1);
            $package->duration = max($this->minDuration, min($package->duration, $this->maxDuration));
        }

        if (mt_rand() / mt_getrandmax() < self::MUTATION_RATE) {
            $package->budget *= mt_rand(90, 110) / 100;
            $package->budget = max($this->minBudget, min($package->budget, $this->maxBudget));
        }

        if (mt_rand() / mt_getrandmax() < self::MUTATION_RATE && $package->activities->count() > 1) {
            $package->activities->pop();
        }

        if (mt_rand() / mt_getrandmax() < self::MUTATION_RATE && $package->activities->count() < 4) {
            $newActivity = Activity::inRandomOrder()->first();
            if (!$package->activities->contains($newActivity)) {
                $package->activities->push($newActivity);
            }
        }

        return $package;
    }
}
