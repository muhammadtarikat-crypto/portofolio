<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;

// Semua endpoint GET (hanya baca) untuk data portofolio
class PortfolioController extends Controller
{
    public function profile()      { return response()->json(['data' => Profile::first()]); }
    public function skills()       { return response()->json(['data' => Skill::orderBy('sort')->get()]); }
    public function projects()     { return response()->json(['data' => Project::orderBy('sort')->get()]); }
    public function experiences()  { return response()->json(['data' => Experience::orderBy('sort')->get()]); }
    public function certificates() { return response()->json(['data' => Certificate::orderBy('sort')->get()]); }
}
