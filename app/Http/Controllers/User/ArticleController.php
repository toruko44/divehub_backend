<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Utils\FileUploader;
use App\Models\Article;
use App\Models\Image;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    const IMAGE_PATH = 'article';
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $searchTerm = $request->input('title');
        $article_reports = Article::with('image')
        ->where('is_draft', false)
        ->when($searchTerm, function ($query, $searchTerm) {
            return $query->where('title', 'LIKE', '%' . $searchTerm . '%');
        })
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        return view('user.article.index', compact('article_reports', 'searchTerm'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // デバッグ情報
        \Log::info('Store request data:', [
            'has_file' => $request->hasFile('thumbnail'),
            'file_info' => $request->file('thumbnail') ? [
                'original_name' => $request->file('thumbnail')->getClientOriginalName(),
                'mime_type' => $request->file('thumbnail')->getMimeType(),
                'size' => $request->file('thumbnail')->getSize(),
            ] : null,
            'all_request' => $request->all()
        ]);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|json',
            'is_draft' => 'required|boolean',
            'thumbnail' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            $image_id = null;
            
            // サムネイル画像のアップロード処理
            if ($request->hasFile('thumbnail')) {
                $thumbnailFile = $request->file('thumbnail');
                $imageName = time() . '_' . $thumbnailFile->getClientOriginalName();
                
                // Cloudflare R2にアップロード
                $url = FileUploader::uploadFile($thumbnailFile, self::IMAGE_PATH, $imageName);
                
                // Imageモデルに保存
                $image = new Image();
                $image->path = $url;
                $image->file_name = $imageName;
                $image->file_type = $thumbnailFile->getMimeType();
                $image->save();
                
                $image_id = $image->id;
            }

            $article = new Article();
            $article->user_id = auth()->id();
            $article->title = $validatedData['title'];
            $article->is_draft = $validatedData['is_draft'];
            $article->content = $validatedData['content'];
            $article->image_id = $image_id;
            $article->save();

            return redirect()->route('user.article.index')->with('success', '記事が正常に保存されました。');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '記事の保存中にエラーが発生しました。',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $article_report = Article::findOrFail($id);

        if (is_string($article_report->content)) {
            $article_report->content = json_decode($article_report->content, true);
        }

        return view('user.article.show')
            ->with('article_report', $article_report);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $article_report = Article::where('id', $id)
                            ->where('user_id', auth()->id())
                            ->firstOrFail();

        return view('user.article.edit')
        ->with('article_report', $article_report);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // バリデーション
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|json',
            'is_draft' => 'required|boolean',
            'thumbnail' => 'nullable|file|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        try {
            // 記事をIDで取得
            $article = Article::findOrFail($id);

            // 認証済みユーザーと記事の所有者が一致するか確認
            if ($article->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => '許可されていない操作です。',
                ], 403);
            }

            // サムネイル画像のアップロード処理
            if ($request->hasFile('thumbnail')) {
                $thumbnailFile = $request->file('thumbnail');
                $imageName = time() . '_' . $thumbnailFile->getClientOriginalName();
                
                // Cloudflare R2にアップロード
                $url = FileUploader::uploadFile($thumbnailFile, self::IMAGE_PATH, $imageName);
                
                // 既存の画像がある場合は削除（オプション）
                if ($article->image_id) {
                    $oldImage = Image::find($article->image_id);
                    if ($oldImage) {
                        $oldImage->delete();
                    }
                }
                
                // 新しいImageモデルに保存
                $image = new Image();
                $image->path = $url;
                $image->file_name = $imageName;
                $image->file_type = $thumbnailFile->getMimeType();
                $image->save();
                
                $article->image_id = $image->id;
            }

            // 記事情報を更新
            $article->title = $validatedData['title'];
            $article->is_draft = $validatedData['is_draft'];
            $article->content = $validatedData['content'];
            $article->save();

            return redirect()->route('user.article.show',['article_id' => $article->id])->with('article_report', $article)->with('success', '記事が正常に更新されました。');

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => '記事の更新中にエラーが発生しました。',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        // 該当する記事をIDで検索
        $article = Article::findOrFail($id);

        // 記事を削除
        $article->delete();

        // 削除成功メッセージを返す
        return redirect()->route('user.article.index')->with('success', '質問が削除されました。');

    }


    public function uploadImage(Request $request)
    {
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = $file->getClientOriginalName();
                $path = 'article'; // Directory for storing article images

                // Upload the image to S3 using FileUploader
                $url = FileUploader::uploadFile($file, $path, $imageName);

                return response()->json([
                    'success' => true,
                    'file' => ['url' => $url] // Return the S3 URL
                ]);
            }

            return response()->json(['success' => false, 'message' => 'ファイルが見つかりません'], 400);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }


    public function uploadImageByUrl(Request $request)
    {
        try {
            $url = $request->input('url');
            if (!$url) {
                return response()->json(['success' => false, 'message' => 'URLが見つかりません'], 400);
            }

            $path = 'article';
            $imageName = basename(parse_url($url, PHP_URL_PATH));

            $uploadedUrl = FileUploader::uploadFile($url, $path, $imageName, true);

            return response()->json([
                'success' => true,
                'file' => ['url' => $uploadedUrl]
            ]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function instructions()
    {
        return view('user.article.instructions');
    }

}
