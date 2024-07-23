<?php

namespace App\Http\Controllers;

use App\Jobs\PDFGenerator;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::paginate(100));
    }

    public function store()
    {
        $posts = Post::limit(100)->get();

        PDFGenerator::dispatch($posts);

        return response()->json(['message' => 'PDF generation is in progress.']);
    }
}
