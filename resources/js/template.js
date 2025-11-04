const templates = {
    "diving-log": [
        {
            type: "header",
            data: { text: "ダイビングログ", level: 2 }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: ["日時:", "ポイント名:", "水温:", "透明度:"]
            }
        },
        {
            type: "header",
            data: { text: "発見した生き物", level: 3 }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: ["", "", "", ""]
            }
        },
        {
            type: "header",
            data: { text: "感想", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "ここに感想を記入してください。" }
        }
    ],
    "diving-trip": [
        {
            type: "header",
            data: { text: "ダイビング旅行レポート", level: 2 }
        },
        {
            type: "header",
            data: { text: "基本情報", level: 3 }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: [
                    "場所（県・海外）:",
                    "スポット名（例：慶良間諸島、黄金崎）:",
                    "時期（例：2025-01、2023-12）:",
                    "水温:"
                ]
            }
        },
        {
            type: "header",
            data: { text: "ダイビング詳細", level: 3 }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: [
                    "スーツタイプ（3mm/5mm/ロクハン/セミドライ/ドライ）:",
                    "透明度:",
                    "特徴:"
                ]
            }
        },
        {
            type: "header",
            data: { text: "発見した生物", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "観察できた生き物について記載してください。写真があるとより魅力的な記事になります。" }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: ["", "", "", ""]
            }
        },
        {
            type: "header",
            data: { text: "ショップ情報", level: 3 }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: [
                    "ショップ名:",
                    "ショップ評価（5段階）:",
                    "ショップの特徴（例：マクロ好き、フレンドリー）:"
                ]
            }
        },
        {
            type: "header",
            data: { text: "旅行詳細", level: 3 }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: [
                    "アクセス手段（例：レンタカーが必要、飛行機が必要）:",
                    "ホテル名:",
                    "総額（だいたい）:",
                    "今回の旅行の評価（5段階）:"
                ]
            }
        },
        {
            type: "header",
            data: { text: "感想とおすすめ", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "旅行全体の感想や、他の人へのおすすめポイントを記載してください。" }
        }
    ],
    "creature-introduction": [
        {
            type: "header",
            data: { text: "生き物紹介", level: 2 }
        },
        {
            type: "header",
            data: { text: "基本情報", level: 3 }
        },
        {
            type: "list",
            data: {
                style: "unordered",
                items: ["名前:",  "分布地域:"]
            }
        },
        {
            type: "header",
            data: { text: "特徴", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "生き物の外見や行動の特徴について記載してください。" }
        },
        {
            type: "header",
            data: { text: "生息地と環境", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "生息する場所やその環境について説明してください。" }
        },
        {
            type: "header",
            data: { text: "観察のポイント", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "どのように観察できるか、観察の注意点やタイミングなどを記載してください。" }
        },
        {
            type: "header",
            data: { text: "豆知識", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "この生き物に関する面白い事実や知っておくと役立つ情報を記載してください。" }
        },
        {
            type: "header",
            data: { text: "感想とおすすめ", level: 3 }
        },
        {
            type: "paragraph",
            data: { text: "この記事を通して伝えたいことや、読者へのメッセージを記載してください。" }
        }
    ]
};


// テンプレート挿入機能
export function applyTemplate(editor, templateKey) {
    if (!templates[templateKey]) {
        alert("無効なテンプレートが選択されました！");
        return;
    }

    const templateBlocks = templates[templateKey];

    // テンプレートデータを EditorJS の形式で作成
    const templateData = {
        time: Date.now(),
        blocks: templateBlocks,
        version: "2.22.2"
    };

    // 既存のコンテンツを完全に置き換え
    editor.render(templateData).then(() => {
        console.log('テンプレートが正常に適用されました');
    }).catch((error) => {
        console.error('テンプレート適用中にエラーが発生しました:', error);
        // エラーが発生した場合の代替処理
        fallbackApplyTemplate(editor, templateBlocks);
    });
}

// フォールバック用のテンプレート適用関数
function fallbackApplyTemplate(editor, templateBlocks) {
    // 既存のコンテンツを削除
    editor.clear();
    
    // 少し待ってからテンプレートを挿入
    setTimeout(() => {
        templateBlocks.forEach((block, index) => {
            editor.blocks.insert(block.type, block.data, {}, index, true);
        });
    }, 50);
}
