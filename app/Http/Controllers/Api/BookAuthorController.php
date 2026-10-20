<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BookAuthor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class BookAuthorController extends Controller
{
    public function index()
    {
        return response()->json(
            BookAuthor::with('book', 'author')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'BookID' => [
                'required', 'integer',
                Rule::exists('tblBook', 'BookID')
            ],
            'AuthorID' => [
                'required', 'integer',
                Rule::exists('tblAuthor', 'AuthorID')
            ],
            'AuthorDate' => 'nullable|date',
            'Remark' => 'nullable|string'
        ]);

        $exists = BookAuthor::where('BookID', $data['BookID'])
            ->where('AuthorID', $data['AuthorID'])
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Book-author relationship already exists'
            ], 409);
        }

        $record = BookAuthor::create($data);

        return response()->json([
            'message' => 'Book author created successfully',
            'data' => $record
        ], 201);
    }

    public function show($bookId, $authorId)
    {
        $record = BookAuthor::with('book', 'author')
            ->where('BookID', $bookId)
            ->where('AuthorID', $authorId)
            ->firstOrFail();

        return response()->json($record);
    }

    public function update(Request $request, $bookId, $authorId)
    {
        $data = $request->validate([
            'AuthorDate' => 'nullable|date',
            'Remark' => 'nullable|string'
        ]);

        $query = DB::table('tblBookAuthor')
            ->where('BookID', $bookId)
            ->where('AuthorID', $authorId);

        if (!$query->exists()) {
            abort(404, 'Book-author relationship not found');
        }

        $query->update($data);

        return response()->json([
            'message' => 'Book author updated successfully',
            'data' => BookAuthor::where('BookID', $bookId)
                ->where('AuthorID', $authorId)
                ->first()
        ]);
    }

    public function destroy($bookId, $authorId)
    {
        $query = DB::table('tblBookAuthor')
            ->where('BookID', $bookId)
            ->where('AuthorID', $authorId);

        if (!$query->exists()) {
            abort(404, 'Book-author relationship not found');
        }

        $query->delete();

        return response()->json([
            'message' => 'Book author deleted successfully'
        ]);
    }
}