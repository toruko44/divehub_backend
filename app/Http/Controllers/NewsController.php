<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::orderBy('created_at', 'desc')->paginate(10);
        return view('news.index', compact('news'));
    }

    public function show($news_id)
    {
        $news_show = News::where('id', $news_id)->first();
        return view('news.show', compact('news_show'));

    }
}
