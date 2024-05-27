<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use App\Models\User;

class GameController extends Controller
{
    public function index()
    {
        $books = Game::all();
        return response()->json(['books' => $books]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category' => 'required|string',
            'type' => 'required|string',
        ]);

        $game = Game::create([
            'name' => $request->name,
            'description' => $request->description,
            'category' => $request->category,
            'type' => $request->type,
        ]);

        return response()->json($game, 201);
    }


    public function show($id)
    {
        $game = Game::findOrFail($id);
        return response()->json(['game' => $game]);
    }

    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'type' => 'required|string|max:255',
        ]);

        $game->update($validated);

        return response()->json(['game' => $game]);
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return response()->json(['message' => 'Game deleted successfully']);
    }

    public function assignCommittee(Request $request, $id)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $game = Game::findOrFail($id);
        $user = User::findOrFail($validated['user_id']);

        if ($user->role !== User::ROLE_COMMITTEE) {
            return response()->json(['message' => 'User is not a committee member'], 400);
        }

        $game->committees()->attach($user);

        return response()->json(['message' => 'Committee member assigned to game']);
    }
}
