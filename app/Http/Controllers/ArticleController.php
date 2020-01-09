<?php

namespace App\Http\Controllers;

use App\Article;

class ArticleController extends Controller
{
    public function index()
    {
        $data = Article::paginate(12);
        return response()->json($data);
    }
}
