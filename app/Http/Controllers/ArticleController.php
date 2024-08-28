<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article; // Import the Article model

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Create a new article with the validated data
        $article = Article::create($request->all());

        // Return the newly created article as JSON with a 201 status code
        return response()->json($article, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Find the article by ID or fail with a 404 error
        $article = Article::findOrFail($id);

        // Return the found article as JSON
        return response()->json($article);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Find the article by ID or fail with a 404 error
        $article = Article::findOrFail($id);

        // Update the article with the validated data
        $article->update($request->all());

        // Return the updated article as JSON
        return response()->json($article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Find the article by ID or fail with a 404 error
        $article = Article::findOrFail($id);

        // Delete the article
        $article->delete();

        // Return a response indicating success
        return response()->json(['message' => 'Article deleted successfully'], 200);
    }
}
