<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $properties = Property::withCount('comments')
            ->withAvg('comments', 'rating')
            ->when($filter === 'highest_price', function ($query) {
                return $query->orderBy('rental_price', 'desc');
            })
            ->when($filter === 'lowest_price', function ($query) {
                return $query->orderBy('rental_price', 'asc');
            })
            ->when($filter === 'most_comments', function ($query) {
                return $query->orderBy('comments_count', 'desc');
            })
            ->when($filter === 'least_comments', function ($query) {
                return $query->orderBy('comments_count', 'asc');
            })
            ->when($filter === 'highest_rating', function ($query) {
                return $query->orderBy('comments_avg_rating', 'desc');
            })
            ->when($filter === 'lowest_rating', function ($query) {
                return $query->orderBy('comments_avg_rating', 'asc');
            })
            ->get();

        return response()->json($properties);
    }


    public function show($id)
    {
        $property = Property::withCount('comments as comments_count')
            ->withAvg('comments', 'rating')
            ->findOrFail($id);

        return response()->json($property);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rental_price' => 'required|numeric',
            'address' => 'required|string|max:255',
        ]);

        $property = new Property();
        $property->fill($request->all());
        $property->user_id = Auth::id();
        $property->save();

        return response()->json($property, 201);
    }

    public function update(Request $request, $id)
    {
        $property = Property::findOrFail($id);

        if ($property->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $property->update($request->all());
        return response()->json($property);
    }

    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        if ($property->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $property->delete();
        return response()->json(['message' => 'Property deleted successfully']);
    }
}
