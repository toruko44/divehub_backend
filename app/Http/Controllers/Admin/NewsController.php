<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\News;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        if ($request->filled('keyword')) {
            $query->where('title', 'like', '%' . $request->keyword . '%')
                  ->orWhere('content', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('created_at_start')) {
            $query->where('created_at', '>=', $request->created_at_start);
        }

        if ($request->filled('created_at_end')) {
            $query->where('created_at', '<=', $request->created_at_end);
        }

        $news_items = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.news.index', compact('news_items'));
    }

    public function show($id)
    {
        $news_item = News::findOrFail($id);
        return view('admin.news.show', compact('news_item'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $news_item = new News();
        $news_item->title = $request->title;
        $news_item->content = $request->content;
        $news_item->save();

        return redirect()->route('admin.news.index')->with('success', 'お知らせが作成されました');
    }


    public function edit($id)
    {
        $news_item = News::findOrFail($id);
        return view('admin.news.edit', compact('news_item'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $news_item = News::findOrFail($id);
        $news_item->title = $request->title;
        $news_item->content = $request->content;
        $news_item->save();

        return redirect()->route('admin.news.index')->with('success', 'News updated successfully.');
    }

    public function delete($id)
    {
        $news_item = News::findOrFail($id);
        $news_item->delete();

        return redirect()->route('admin.news.index')->with('success', 'News deleted successfully.');
    }
}
