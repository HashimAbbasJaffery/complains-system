<?php

namespace App\Http\Controllers;

use App\Models\Complain;
use App\Models\ComplainType;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComplainTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword = request()->keyword;
        $from = request()->from;
        $to = request()->to;
        $types = ComplainType::withCount("complains")
                                ->latest()
                                ->when($from ?? false, function($query) use ($from, $to) {
                                    $query->whereDate("created_at", ">=", $from)->whereDate("created_at", "<=", $to);
                                })
                                ->when($keyword ?? false, function($query) use ($keyword) {
                                    $query->whereLike("type", "%$keyword%");
                                })
                                ->paginate(8)
                                ->withQueryString();
        return Inertia::render("Type/Index", [
            "types" => $types
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
        ComplainType::create([
            "type" => $request->type
        ]);
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
    public function update(Request $request, ComplainType $type)
    {
        $type->update([
            "type" => $request->type
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplainType $type)
    {
        $type->delete();
    }
}
