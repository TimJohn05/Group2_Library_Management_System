<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->get();
        return response()->json($books);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'isbn' => 'nullable|string|max:20|unique:books,isbn',
            'published_year' => 'nullable|integer',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book = Book::create($validated);
        return response()->json($book->load(['author', 'category']), 201);
    }

    public function show(Book $book)
    {
        return response()->json($book->load(['author', 'category']));
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'isbn' => 'nullable|string|max:20|unique:books,isbn,' . $book->id,
            'published_year' => 'nullable|integer',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
        ]);

        $book->update($validated);
        return response()->json($book->load(['author', 'category']));
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully']);
    }

    public function byAuthor($authorId)
    {
        $books = Book::with(['category'])
            ->where('author_id', $authorId)
            ->get();
        return response()->json($books);
    }

    public function byCategory($categoryId)
    {
        $books = Book::with(['author'])
            ->where('category_id', $categoryId)
            ->get();
        return response()->json($books);
    }

    public function analytics()
    {
        $totalBooks = Book::count();
        return response()->json(['total_books' => $totalBooks]);
    }
}
