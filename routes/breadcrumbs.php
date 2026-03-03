<?php

use App\Models\Program;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('home'));
});

// Faculties
Breadcrumbs::for('faculties.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Faculties', route('faculties.index'));
});

// Program detail: Home / Faculties / Computer Science / B.Sc Computer Science
Breadcrumbs::for('programs.public.show', function (BreadcrumbTrail $trail, Program $program) {
    $trail->parent('faculties.index');
    $trail->push($program->faculty->name, route('faculties.index') . '#faculty-' . $program->faculty_id);
    $trail->push($program->name);
});