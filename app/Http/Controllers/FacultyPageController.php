<?php

namespace App\Http\Controllers;

use App\Models\Faculty;

class FacultyPageController extends Controller
{
    public function index()
    {
        $faculties = Faculty::where('is_active', true)
            ->with(['activePrograms' => function ($query) {
                $query->orderBy('level')->orderBy('name');
            }])
            ->orderBy('name')
            ->get();

        return view('faculties', compact('faculties'));
    }
}