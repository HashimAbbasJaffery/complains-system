<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Models\Complain;
use App\Models\ComplainType;
use App\Models\Question;
use Illuminate\Http\Request;
use Inertia\Inertia;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ComplainType $type)
    {
        $questions = $type->questions;
        return Inertia::render("Complain/Question/Questions", [
            "questions" => $questions,
            "id" => $type->id
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(ComplainType $type)
    {
        $id = $type->id;
        return Inertia::render("Complain/Question/Add", [
            "id" => $id
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(QuestionRequest $request, ComplainType $type)
    {   
        $type->questions()->create([...$request->validated(), "answer" => $request->answer]);

        return to_route("admin.questions", [ "type" => $type->id ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(QuestionRequest $request, Question $question)
    {
        $question->update($request->validated());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();
    }
}
