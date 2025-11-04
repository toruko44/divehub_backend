<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Question;
use App\Models\Answer;
use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;

class MyPageController extends Controller
{
    public function index()
    {
        $tags =Tag::all()->pluck('name', 'id')->toArray();
        $questions = Question::where('user_id', Auth::id())
            ->paginate(5, ['*'], 'questions_page');

        $answers = Answer::where('user_id', Auth::id())
            ->paginate(5, ['*'], 'answers_page');

        $article_reports = Article::where('user_id', Auth::id())
            ->paginate(5, ['*'], 'articles_page');

        return view('user.my_page.my_page', compact('questions', 'answers', 'article_reports'));
    }
}
