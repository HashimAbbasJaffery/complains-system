<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Complain;

class ComplainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complains = Complain::with("type")->paginate(1)->withQueryString();
        return Inertia::render("Complain/Index", [
            "complains" => $complains
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Complain $complain)
    {
        $complain->load("type");
        return Inertia::render("Complain/Single", [
            "complain" => $complain
        ]);
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
    public function update(Request $request, string $id)
    {
        //
    }

    public function highlight(Complain $complain) {
        $complain->update([
            "highlighted" => !$complain->highlighted
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complain $complain)
    {
        $complain->delete();
    }
}
