<?php

namespace App\Http\Controllers;

use App\Models\Program;

class ProgramPageController extends Controller
{
    public function show(Program $program)
    {
        $program->load('faculty');
        return view('program', compact('program'));
    }
}