<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ClaudeService
{
    private $apiKey;
    private $baseUrl = 'https://api.anthropic.com/v1/messages';

    public function __construct()
    {
        $this->apiKey = env('CLAUDE_API_KEY');
    }

    public function generateDivingAnswer(string $question): string
    {
        try {
            // 質問内容をログに出力

            $response = Http::withHeaders([
                'x-api-key' => $this->apiKey,
                'anthropic-version' => '2023-06-01',
                'content-type' => 'application/json',
            ])->post($this->baseUrl, [
                'model' => 'claude-3-5-sonnet-20241022',
                'max_tokens' => 300,
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => "以下はスキューバダイビングに関する質問です。専門的かつ安全に配慮した回答を提供してください：\n\n" . $question
                    ]
                ]
            ]);

            if ($response->successful()) {
                return $response->json()['content'][0]['text'];
            }

            // レスポンスが成功しなかった場合のログ
            Log::error('API response unsuccessful', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            return '申し訳ありませんが、現在回答を生成できません。';

        } catch (\Exception $e) {
            // 例外が発生した場合のログ
            Log::error('Exception occurred while generating diving answer', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return '申し訳ありませんが、現在回答を生成できません。';
        }
    }
}
