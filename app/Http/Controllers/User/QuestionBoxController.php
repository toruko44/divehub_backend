<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\Image;
use App\Models\Answer;
use Illuminate\Support\Facades\Auth;
use App\Utils\FileUploader;
use Intervention\Image\Facades\Image as InterventionImage;

class QuestionBoxController extends Controller
{
    const IMAGE_PATH = 'question';

    public function index(Request $request)
    {
        $tag = $request->input('tag');

        if ($tag) {
            $questions = Question::whereHas('tag', function ($query) use ($tag) {
                $query->where('name', $tag);
            })->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $questions = Question::orderBy('created_at', 'desc')->paginate(10);
        }

        $tags =Tag::all()->pluck('name', 'id')->toArray();
        return view('user.question_box.index', compact('questions', 'tag', 'tags'));

    }

    public function show($question_id)
    {
        $question = Question::findOrFail($question_id);
        $answers = $question->answers()->orderBy('created_at', 'desc')->get();
        $tags =Tag::all()->pluck('name', 'id')->toArray();
        $user_answer = $answers->firstWhere('user_id', Auth::id());
        $related_questions = Question::where('id', '!=', $question->id)
                                    ->limit(10)
                                    ->get()
                                    ->shuffle();
        return view('user.question_box.show', compact('question', 'answers', 'tags', 'user_answer', 'related_questions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tag' => 'required|exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,,heic|max:5120',
        ]);

        $question = new Question();
        $question->user_id = Auth::id();
        $question->title = $request->title;
        $question->content = $request->content;
        $question->tag_id = $request->tag;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // $tmpPath = storage_path('app/tmp/') . $image->getClientOriginalName();

            // $this->compressImage($image, $tmpPath, 50, 500 * 1024);

            // $path = FileUploader::uploadFile(new \Illuminate\Http\File($tmpPath), self::IMAGE_PATH, $image->getClientOriginalName());

            $path = FileUploader::uploadFile($image, self::IMAGE_PATH, $image->getClientOriginalName());

            $imageModel = Image::create([
                'file_name' => $image->getClientOriginalName(),
                'file_type' => $image->getClientOriginalExtension(),
                'path' => $path,
            ]);

            // unlink($tmpPath);

            $question->image_id = $imageModel->id;
        }

        $question->save();

        return redirect()->route('user.question_box.index')->with('success', '質問が投稿されました。');
    }

    public function update(Request $request, $question_id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'tag' => 'required|exists:tags,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,heic|max:5120',
        ]);

        $question = Question::findOrFail($question_id);

        if ($question->answers()->exists()) {
            return redirect()->back()->withErrors(['error' => '質問には既に回答があるため、編集できません。']);
        }

        $question->title = $request->title;
        $question->content = $request->content;
        $question->tag_id = $request->tag;

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            // $tmpPath = storage_path('app/tmp/') . $image->getClientOriginalName();

            // $this->compressImage($image, $tmpPath, 50, 500 * 1024);

            // $path = FileUploader::uploadFile(new \Illuminate\Http\File($tmpPath), self::IMAGE_PATH, $image->getClientOriginalName());

            $path = FileUploader::uploadFile($image, self::IMAGE_PATH, $image->getClientOriginalName());

            $imageModel = Image::create([
                'file_name' => $image->getClientOriginalName(),
                'file_type' => $image->getClientOriginalExtension(),
                'path' => $path,
            ]);

            // unlink($tmpPath);

            $question->image_id = $imageModel->id;
        }

        $question->save();

        return redirect()->route('user.question_box.show', $question_id)->with('success', '質問が更新されました。');
    }


    public function delete($question_id)
    {
        $question = Question::findOrFail($question_id);

        if ($question->answers()->exists()) {
            return redirect()->back()->withErrors(['error' => '質問には既に回答があるため、削除できません。']);
        }

        $question->delete();

        return redirect()->route('user.question_box.index')->with('success', '質問が削除されました。');
    }

    public function answer($question_id,request $request)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $question = Question::findOrFail($question_id);

        $question->answers()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect()->route('user.question_box.show', $question_id)->with('success', '回答が投稿されました。');
    }

    public function answer_update(Request $request, $answer_id)
    {
        $request->validate([
            'content' => 'required|string',
        ]);

        $answer = Answer::findOrFail($answer_id);

        $answer->content = $request->content;
        $answer->save();

        return redirect()->route('user.question_box.show', $answer->question_id)->with('success', '回答が更新されました。');
    }

    public function answer_delete($answer_id)
    {
        $answer = Answer::findOrFail($answer_id);
        $question_id = $answer->question_id;

        $answer->delete();

        return redirect()->route('user.question_box.show', $question_id)->with('success', '回答が削除されました。');
    }

    // private function compressImage($img_file, $path, $quality, $size)
    // {
    //     $image = InterventionImage::make($img_file);
    //     $image->save($path, $quality);

    //     // クオリティを下げた後のファイルサイズが十分下がっていなければもう一度関数を呼び出す
    //     $image = InterventionImage::make($path);
    //     if($image->filesize() > $size){
    //         $quality -= 5;
    //         return $this->compressImage($img_file, $path, $quality, $size);
    //     }
    // }

}
