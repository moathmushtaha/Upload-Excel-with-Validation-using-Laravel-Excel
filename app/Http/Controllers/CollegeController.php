<?php

namespace App\Http\Controllers;

use App\Models\College;

class CollegeController extends Controller
{
    public function __invoke()
    {
        $lastFiveYears = collect(range(date('Y') - 4, date('Y')));

        $colleges = College::with('programs')->get();

        $colleges = $colleges->each(function ($college) {
            $college->programs->each(function ($program) {
                $program->applicationsPerYear = $program->applications()
                    ->where('acad_year', '>=', date('Y') - 4)
                    ->selectRaw('acad_year, count(*) as count')
                    ->groupBy('acad_year')
                    ->get();
            });
        })->map(function ($college) use ($lastFiveYears) {
            return [
                'college' => $college->college_name,
                'programs' => $college->programs->map(function ($program) use ($lastFiveYears) {
                    return [
                        'program' => $program->program_name,
                        'applicationsPerYear' => $lastFiveYears->map(function ($year) use ($program) {
                            $application = $program->applicationsPerYear->firstWhere('acad_year', $year);
                            return [
                                'year' => $year,
                                'count' => $application ? $application->count : 0,
                            ];
                        })
                    ];
                }),
            ];
        });

        return response()->json($colleges);
    }
}
