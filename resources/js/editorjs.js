import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import List from '@editorjs/list';
import Table from '@editorjs/table';
import ImageTool from '@editorjs/image';
import Delimiter  from '@editorjs/delimiter';
import Warning from '@editorjs/warning'
import LineBreak from './linebreak';
import { ColorTool, MarkerTool } from './color-tool';

import { applyTemplate } from '/resources/js/template.js';
import SimpleLinkTool from '/resources/js/linktool.js';

class MyHeader extends Header {
    /**
     * Return Tool's view
     * @returns {HTMLHeadingElement}
     * @public
     */
    render() {
        const extrawrapper = document.createElement('div');
        extrawrapper.classList.add('content');
        extrawrapper.appendChild(this._element);

        return extrawrapper;
    }
}

const imageQueue = [];

const i18nConfig = {
    messages: {
      ui: {
        "blockTunes": {
          "toggler": {
            "Click to tune": "クリックして調整",
            "or drag to move": "またはドラッグして移動"
          },
        },
        "inlineToolbar": {
          "converter": {
            "Convert to": "変換"
          }
        },
        "toolbar": {
          "toolbox": {
            "Add": "追加"
          }
        }
      },
      toolNames: {
        "Text": "テキスト",
        "Heading": "見出し",
        "List": "リスト",
        "Warning": "警告",
        "Checklist": "チェックリスト",
        "Quote": "引用",
        "Code": "コード",
        "Delimiter": "区切り線",
        "Raw HTML": "HTML",
        "Table": "表",
        "Link": "リンク",
        "Marker": "マーカー",
        "Bold": "太字",
        "Italic": "斜体",
        "InlineCode": "インラインコード",
        "Image": "画像",
        "Color": "文字色",
        "Background": "背景色",
      },
      tools: {
        "warning": {
          "Title": "タイトル",
          "Message": "メッセージ",
        },
        "link": {
          "Add a link": "リンクを追加",
        },
        "stub": {
          'The block can not be displayed correctly.': 'このブロックは正しく表示できません。',
        },
      },
    },
  };

const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

window.editorErrorContent = {
    "time": Date.now(),
    "blocks": [
        {
            "type": "paragraph",
            "data": {
                "text": "コンテンツの読み込み中にエラーが発生しました。 データ形式を確認してください。"
            }
        }
    ],
    "version": "2.22.2"
};

const editor = new EditorJS({
    holder: 'editor-js',
    placeholder: 'ダイビングのコツや知識を書き留めてみよう！',
    i18n: i18nConfig,
    inlineToolbar: ['bold', 'italic', 'color', 'marker'],
    tools: {
        header: {
            class: Header,
            inlineToolbar: true,
            config: {
                placeholder: 'ヘッダーを入力',
                defaultLevel: 2,
                levels: [1, 2, 3],
            }
        },
        image: {
            class: ImageTool,
            config: {
                uploader: {
                    uploadByFile: (file) => {
                        const MAX_SIZE = 5 * 1024 * 1024;
                        return new Promise((resolve, reject) => {
                            if (file.size > MAX_SIZE) {
                                window.alert('ファイルサイズが5MBを超えています');
                                reject('ファイルサイズが5MBを超えています');
                                editor.blocks.getCurrentBlockIndex();
                                editor.blocks.delete();
                                return;
                            }
                            const reader = new FileReader();
                            reader.onload = (event) => {
                                resolve({
                                    success: 1,
                                    file: {
                                        url: event.target.result
                                    }
                                });
                            };
                            reader.onerror = (error) => {
                                reject('ファイル読み込みエラー');
                            };
                            reader.readAsDataURL(file);
                        });
                    },
                    uploadByUrl: (url) => {
                        return new Promise((resolve, reject) => {
                            fetch(url)
                                .then(response => response.blob())
                                .then(blob => {
                                    const reader = new FileReader();
                                    reader.onload = (event) => {
                                        resolve({
                                            success: 1,
                                            file: {
                                                url: event.target.result
                                            }
                                        });
                                    };
                                    reader.onerror = (error) => {
                                        reject('URL画像読み込みエラー');
                                    };
                                    reader.readAsDataURL(blob);
                                })
                                .catch(error => {
                                    reject('URLから画像を取得できませんでした');
                                });
                        });
                    }
                }
            }
        },
        list: {
            class: List,
            inlineToolbar: true,
        },
        table: {
            class: Table,
        },
        Delimiter: {
            class: Delimiter,
        },
        Warning: {
            class: Warning,
            inlineToolbar: true,
        },
        lineBreak: LineBreak,
        simpleLink: {
            class: SimpleLinkTool,
        },
        color: {
            class: ColorTool
        },
        marker: {
            class: MarkerTool
        }
    },
    autofocus: true,
    data: initialEditorData ? JSON.parse(initialEditorData) : undefined,
}, )

document.getElementById("applyTemplateButton").addEventListener("click", () => {
    const selectedTemplate = document.getElementById("templateDropdown").value;

    if (!selectedTemplate) {
        alert("テンプレートを選択してください！");
        return;
    }

    // 既存のコンテンツがあるかチェック
    editor.save().then((outputData) => {
        const hasContent = outputData.blocks && outputData.blocks.length > 0 && 
                          outputData.blocks.some(block => {
                              if (block.type === 'paragraph') {
                                  return block.data.text && block.data.text.trim() !== '';
                              }
                              return true;
                          });

        if (hasContent) {
            const confirmMessage = "既存のコンテンツがすべて削除され、選択したテンプレートに置き換わります。続行しますか？";
            if (!confirm(confirmMessage)) {
                return;
            }
        }

        applyTemplate(editor, selectedTemplate);
    }).catch((error) => {
        console.error('エディターの保存中にエラーが発生しました:', error);
        applyTemplate(editor, selectedTemplate);
    });
});

window.editor = editor;
