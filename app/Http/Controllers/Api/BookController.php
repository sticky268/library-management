<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BookController extends Controller
{
    public function index()
    {
        return response()->json(
            Book::with('bookType', 'authors')->get()
        );
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'BookTitle' => 'required|string|max:255',
            'BookTypeID' => [
                'required',
                'integer',
                Rule::exists('tblBookType', 'BookTypeID')
            ],
            'PublishDate' => 'nullable|date',
            'NumOfPages' => 'nullable|integer|min:0',
            'NumOfCopies' => 'nullable|integer|min:0',
            'Edition' => 'nullable|string|max:255',
            'Publisher' => 'nullable|string|max:255',
            'BookSource' => 'nullable|string|max:255',
            'Remark' => 'nullable|string',
        ]);

        $book = Book::create($data);

        return response()->json([
            'message' => 'Book created successfully',
            'data' => $book
        ], 201);
    }

    public function show($book)
    {
        return response()->json(
            Book::with('bookType', 'authors')
                ->findOrFail($book)
        );
    }

    public function update(Request $request, $book)
    {
        $record = Book::findOrFail($book);

        $data = $request->validate([
            'BookTitle' => 'sometimes|required|string|max:255',
            'BookTypeID' => [
                'sometimes',
                'required',
                'integer',
                Rule::exists('tblBookType', 'BookTypeID')
            ],
            'PublishDate' => 'nullable|date',
            'NumOfPages' => 'nullable|integer|min:0',
            'NumOfCopies' => 'nullable|integer|min:0',
            'Edition' => 'nullable|string|max:255',
            'Publisher' => 'nullable|string|max:255',
            'BookSource' => 'nullable|string|max:255',
            'Remark' => 'nullable|string',
        ]);

        $record->update($data);

        return response()->json([
            'message' => 'Book updated successfully',
            'data' => $record
        ]);
    }

    public function destroy($book)
    {
        $record = Book::findOrFail($book);
        $record->delete();

        return response()->json([
            'message' => 'Book deleted successfully'
        ]);
    }
}