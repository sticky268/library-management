<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AuthorController extends Controller
{
    // GET /api/authors
    public function index()
    {
        return response()->json(Author::all());
    }

    // POST /api/authors
    public function store(Request $request)
    {
        $data = $request->validate([
            'AuthorName' => 'required|string|max:255',
            'Gender' => 'nullable|string|max:20',
            'DOB' => 'nullable|date',
            'POB' => 'nullable|string|max:255',
            'Address' => 'nullable|string',
            'Phone' => 'nullable|string|max:30',
            'Email' => 'nullable|email|max:255',
            'Photo' => 'nullable|string|max:255',
        ]);

        $author = Author::create($data);

        return response()->json([
            'message' => 'Author created successfully',
            'data' => $author
        ], 201);
    }

    // GET /api/authors/{author}
    public function show($author)
    {
        return response()->json(
            Author::findOrFail($author)
        );
    }

    // PUT /api/authors/{author}
    public function update(Request $request, $author)
    {
        $record = Author::findOrFail($author);

        $data = $request->validate([
            'AuthorName' => 'sometimes|required|string|max:255',
            'Gender' => 'nullable|string|max:20',
            'DOB' => 'nullable|date',
            'POB' => 'nullable|string|max:255',
            'Address' => 'nullable|string',
            'Phone' => 'nullable|string|max:30',
            'Email' => 'nullable|email|max:255',
            'Photo' => 'nullable|string|max:255',
        ]);

        $record->update($data);

        return response()->json([
            'message' => 'Author updated successfully',
            'data' => $record
        ]);
    }

    // DELETE /api/authors/{author}
    public function destroy($author)
    {
        $record = Author::findOrFail($author);
        $record->delete();

        return response()->json([
            'message' => 'Author deleted successfully'
        ]);
    }
}