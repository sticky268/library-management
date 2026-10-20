<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookType;
use Illuminate\Http\Request;

class BookTypeController extends Controller
{
    public function index()
    {
        return response()->json(BookType::all());
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'BookTypeName' => 'required|string|max:255',
        ]);

        $bookType = BookType::create($data);

        return response()->json([
            'message' => 'Book type created successfully',
            'data' => $bookType
        ], 201);
    }

    public function show($book_type)
    {
        return response()->json(
            BookType::findOrFail($book_type)
        );
    }

    public function update(Request $request, $book_type)
    {
        $record = BookType::findOrFail($book_type);

        $data = $request->validate([
            'BookTypeName' => 'required|string|max:255',
        ]);

        $record->update($data);

        return response()->json([
            'message' => 'Book type updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($book_type)
    {
        $record = BookType::findOrFail($book_type);
        $record->delete();

        return response()->json([
            'message' => 'Book type deleted successfully'
        ]);
    }
}