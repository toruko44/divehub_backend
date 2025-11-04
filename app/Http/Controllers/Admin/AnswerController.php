<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Answer;

class AnswerController extends Controller
{
    public function index(Request $request)
    {
        $query = Answer::query();

        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

        if ($request->filled('keyword')) {
            $query->where('content', 'like', '%' . $request->keyword . '%')
                  ->orWhereHas('question', function($q) use ($request) {
                      $q->where('title', 'like', '%' . $request->keyword . '%');
                  });
        }

        if ($request->filled('created_at_start')) {
            $query->where('created_at', '>=', $request->created_at_start);
        }

        if ($request->filled('created_at_end')) {
            $query->where('created_at', '<=', $request->created_at_end);
        }

        $items = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.answer.index', compact('items'));
    }

    public function show($answer_id)
    {
        $answer = Answer::findOrFail($answer_id);
        return view('admin.answer.show', compact('answer'));
    }

    public function edit($answer_id)
    {
        $answer = Answer::findOrFail($answer_id);
        return view('admin.answer.edit', compact('answer'));
    }

    public function update(Request $request, $answer_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $answer = Answer::findOrFail($answer_id);

        $answer->content = $request->content;
        $answer->save();

        return redirect()->route('admin.answer.index')->with('success', '回答が更新されました。');
    }

    public function delete($answer_id)
    {
        $answer = Answer::findOrFail($answer_id);

        $answer->delete();

        return redirect()->route('admin.answer.index')->with('success', '質問が削除されました。');

    }
}
