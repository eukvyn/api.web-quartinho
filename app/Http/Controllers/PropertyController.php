<?php

namespace App\Http\Controllers;

use App\Models\Property;
use App\Models\PropertyImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter');

        $properties = Property::withCount('comments')
            ->withAvg('comments', 'rating')
            ->with('images', 'amenities')
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
            ->withAvg('comments', 'rating')->with('images', 'amenities')
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
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        $property = new Property();
        $property->fill($request->all());
        $property->user_id = Auth::id();
        $property->save();

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities);
        }

        return response()->json($property->load('images', 'amenities'), 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'images' => 'nullable|array',
            'images.*' => 'image|max:2048',
            'images_to_delete' => 'nullable|array',
            'images_to_delete.*' => 'integer',
            'amenities' => 'nullable|array',
            'amenities.*' => 'exists:amenities,id',
        ]);

        $property = Property::findOrFail($id);

        if ($property->user_id !== Auth::id()) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $property->update($request->except(['images', 'images_to_delete', 'amenities']));

        if ($request->has('images_to_delete')) {
            PropertyImage::whereIn('id', $request->images_to_delete)->delete();
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('property_images', 'public');
                $property->images()->create(['image_path' => $path]);
            }
        }

        if ($request->has('amenities')) {
            $property->amenities()->sync($request->amenities);
        }

        return response()->json($property->load('images', 'amenities'));
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
