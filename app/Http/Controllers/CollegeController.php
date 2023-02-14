<?php

namespace App\Http\Controllers;

use App\Models\College;

class CollegeController extends Controller
{
    public function __invoke()
    {
        $lastFiveYears = collect(range(date('Y') - 4, date('Y')));

        $application_status = 1;
        $college_id = 1;
        $program_id = 1;

        $college = College::where('college_id', $college_id)->with('programs')->first();
        if ($college === null) {
            return response()->json(['message' => 'College not found'], 404);
        }

        $program = $college->programs->where('program_id', $program_id)->first();
        if ($program === null) {
            return response()->json(['message' => 'Program not found'], 404);
        }

        $applicationsPerYear = $program->applications()
            ->where('status', $application_status)
            ->where('acad_year', '>=', date('Y') - 4)
            ->selectRaw('acad_year, count(*) as count')
            ->groupBy('acad_year')
            ->get();

        $college = $lastFiveYears->map(function ($year) use ($applicationsPerYear) {
            $application = $applicationsPerYear?->firstWhere('acad_year', $year);
            return [
                'year' => $year,
                'count' => $application ? $application->count : 0,
            ];
        });

        return response()->json($college);

    }
}
