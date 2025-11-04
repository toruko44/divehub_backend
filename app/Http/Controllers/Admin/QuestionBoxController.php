<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Tag;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class QuestionBoxController extends Controller
{
    public function index(Request $request)
    {
        $query = Question::query();

        if ($request->filled('user_name')) {
            $query->whereHas('user', function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->user_name . '%');
            });
        }

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

        $items = $query->orderBy('created_at', 'desc')->paginate(20);

        return view('admin.question.index', compact('items'));
    }

    public function show($question_id)
    {
        $question = Question::findOrFail($question_id);
        return view('admin.question.show', compact('question'));
    }

    public function edit($question_id)
    {
        $question = Question::findOrFail($question_id);
        $tags = Tag::all()->pluck('name', 'id')->toArray();
        return view('admin.question.edit', compact('question', 'tags'));
    }

    public function update(Request $request, $question_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tag' => 'required|exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $question = Question::findOrFail($question_id);

        $question->title = $request->title;
        $question->content = $request->content;
        $question->tag_id = $request->tag;

        if ($request->hasFile('image')) {
            if ($question->image) {
                Storage::disk('public')->delete($question->image->path);
                $question->image->delete();
            }

            $image_path = $request->file('image')->store('images/questions', 'public');
            $image_name = basename($image_path);

            $image = Image::create([
                'path' => $image_path,
                'file_name' => $image_name,
                'file_type' => $request->file('image')->getClientMimeType(),
            ]);

            $question->image_id = $image->id;
        }

        $question->save();

        return redirect()->route('admin.question.show', $question->id)->with('success', '質問が更新されました。');
    }

    public function delete($question_id)
    {
        $question = Question::findOrFail($question_id);

        if ($question->image) {
            Storage::disk('public')->delete($question->image->path);
            $question->image->delete();
        }

        $question->delete();

        return redirect()->route('admin.question.index')->with('success', '質問が削除されました。');

    }
}
