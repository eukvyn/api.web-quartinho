<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Request $request, $propertyId)
    {
        $filter = $request->query('filter');

        $comments = Comment::where('property_id', $propertyId)
            ->with('user')
            ->when($filter === 'most_recent', function ($query) {
                return $query->orderBy('created_at', 'desc');
            })
            ->when($filter === 'least_recent', function ($query) {
                return $query->orderBy('created_at', 'asc');
            })
            ->when($filter === 'highest_rating', function ($query) {
                return $query->orderBy('rating', 'desc');
            })
            ->when($filter === 'lowest_rating', function ($query) {
                return $query->orderBy('rating', 'asc');
            })
            ->get();

        return response()->json($comments);
    }

    public function store(Request $request, $propertyId)
    {
        $request->validate([
            'text' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $property = Property::findOrFail($propertyId);
        if ($property->user_id == Auth::id()) {
            return response()->json(['message' => 'Você não pode comentar seu próprio imóvel'], 403);
        }

        $comment = Comment::create([
            'property_id' => $propertyId,
            'user_id' => Auth::id(),
            'text' => $request->text,
            'rating' => $request->rating,
        ]);

        return response()->json($comment, 201);
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);

        if ($comment->user_id != Auth::id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $comment->delete();

        return response()->json(['message' => 'Comentário deletado com sucesso']);
    }
}
