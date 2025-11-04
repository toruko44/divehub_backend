<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Article;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        if ($request->filled('created_at_start')) {
            $query->where('created_at', '>=', $request->created_at_start);
        }

        if ($request->filled('created_at_end')) {
            $query->where('created_at', '<=', $request->created_at_end);
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.article.index', compact('items'));
    }

    public function show($article_id)
    {
        $article = Article::findOrFail($article_id);
        if (is_string($article->content)) {
            $article->content = json_decode($article->content, true);
        }
        return view('admin.article.show', compact('article'));
    }

    public function delete($article_id)
    {
        $article = Article::findOrFail($article_id);

        $article->delete();

        return redirect()->route('admin.article.index');
    }
}
