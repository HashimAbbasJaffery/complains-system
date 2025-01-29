<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\Complain;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $keyword = request()->keyword;
        $from = request()->from;
        $to = request()->to;
        $users = User::latest()
                                ->when($from ?? false, function($query) use ($from, $to) {
                                    $query->whereDate("created_at", ">=", $from)->whereDate("created_at", "<=", $to);
                                })
                                ->when($keyword ?? false, function($query) use ($keyword) {
                                    $query->whereLike("name", "%". $keyword ."%");
                                })
                                ->paginate(8)
                                ->withQueryString();
        return Inertia::render("User/Index", [
            "users" => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render("User/Add");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        User::create($request->validated());

        return to_route("admin.users.index");
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
    public function edit(User $user)
    {
        return Inertia::render("User/Update", [
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, User $user)
    {
        $user->update($request->validated());
        return to_route("admin.users.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
    }
}
