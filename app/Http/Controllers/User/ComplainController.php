<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComplainRequest;
use App\Models\Complain;
use App\Models\ComplainType;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComplainController extends Controller
{
    public function index() {
        
        $types = ComplainType::all();
        $questions = Question::all();
        return Inertia::render("User/Complain/Index", [
            "types" => $types,
            "questions" => $questions
        ]);
    }
    public function store(ComplainRequest $request) {
        Complain::create($request->validated());
    }
}
