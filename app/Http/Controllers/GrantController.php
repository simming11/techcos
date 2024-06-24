<?php

namespace App\Http\Controllers;

use App\Models\Grant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GrantController extends Controller
{
    public function index()
    {
        $grants = Grant::all();
        return response()->json($grants);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $grant = Grant::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return response()->json($grant, 201);
    }

    public function show($id)
    {
        $grant = Grant::findOrFail($id);
        return response()->json($grant);
    }

    public function update(Request $request, $id)
    {
        $grant = Grant::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image
            if ($grant->image) {
                Storage::disk('public')->delete($grant->image);
            }
            // Store new image
            $grant->image = $request->file('image')->store('images', 'public');
        }

        $grant->title = $request->title;
        $grant->description = $request->description;
        $grant->save();

        return response()->json($grant);
    }

    public function destroy($id)
    {
        $grant = Grant::findOrFail($id);
        // Delete image
        if ($grant->image) {
            Storage::disk('public')->delete($grant->image);
        }
        $grant->delete();

        return response()->json(null, 204);
    }
}
