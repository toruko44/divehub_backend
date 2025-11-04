<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\ClaudeService;
use App\Models\Question;
use App\Models\Claude;

class ClaudeController extends Controller
{
    private $claudeService;

    public function __construct(ClaudeService $claudeService)
    {
        $this->claudeService = $claudeService;
    }

    public function index($question_id)
    {
        $question = Question::findOrFail($question_id);

        $claudes = Claude::where('question_id', $question_id)->get();

        $existing_answer = $question->answers()->where('user_id', config('bot.user_id'))->exists();

        return view('admin.question.bot_index', compact('question','claudes','existing_answer'));
    }

    public function bot($question_id)
    {
        $question = Question::findOrFail($question_id);

        $answer = $this->claudeService->generateDivingAnswer($question->content);

        $claude = new Claude();
        $claude->question_id = $question->id;
        $claude->content = $answer;
        $claude->save();

        $question = Question::findOrFail($question_id);

        $claudes = Claude::where('question_id', $question_id)->get();

        $existing_answer = $question->answers()->where('user_id', config('bot.user_id'))->exists();

        return view('admin.question.bot_index', compact('question','claudes','existing_answer'));
    }

    public function bot_register(Request $request)
    {
        $claude_id = $request->input('selected_claude_id');
        $claude_content = $request->input('claude_content');

        $claude = Claude::find($claude_id);
        $question_id = $claude->question_id;

        $question = Question::findOrFail($question_id);

        $question->answers()->create([
            'user_id' => config('bot.user_id'),
            'content' => $claude_content,
        ]);

        return redirect()->route('admin.question.index')->with('success', '選択した回答を登録しました。');
    }
}
