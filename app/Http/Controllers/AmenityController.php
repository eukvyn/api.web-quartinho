<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use Illuminate\Http\Response;

class AmenityController extends Controller
{
    public function index()
    {
        $amenities = Amenity::all();
        return response()->json($amenities, Response::HTTP_OK);
    }
}
