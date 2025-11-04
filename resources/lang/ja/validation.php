<?php

return [

    /*
    |--------------------------------------------------------------------------
    | バリデーション言語行
    |--------------------------------------------------------------------------
    |
    | 以下の言語行はバリデタークラスにより使用されるデフォルトのエラー
    | メッセージです。サイズルールのようにいくつかのバリデーションを
    | 持っているものもあります。メッセージはご自由に調整してください。
    |
    */

    'accepted'             => ':attributeを承認してください。',
    'accepted_if' => ':otherが:valueの場合、:attributeを承認してください。',
    'active_url'           => ':attributeが有効なURLではありません。',
    'after'                => ':attributeには、:dateより後の日付を入力してください。',
    'after_or_equal'       => ':attributeには、:date以降の日付を入力してください。',
    'alpha'                => ':attributeはアルファベットのみがご利用できます。',
    'alpha_dash'           => ':attributeはアルファベットとダッシュ(-)及び下線(_)がご利用できます。',
    'alpha_num'            => ':attributeはアルファベット数字がご利用できます。',
    'array'                => ':attributeは配列でなくてはなりません。',
    'before'               => ':attributeには、:dateより前の日付をご利用ください。',
    'before_or_equal'      => ':attributeには、:date以前の日付をご利用ください。',
    'between'              => [
        'numeric' => ':attributeは、:minから:maxの間で入力してください。',
        'file'    => ':attributeは、:min kBから、:max kBの間で指定してください。',
        'string'  => ':attributeは、:min文字から、:max文字の間で入力してください。',
        'array'   => ':attributeは、:min個から:max個の間で入力してください。',
    ],
    'boolean'              => ':attributeは、trueかfalseを入力してください。',
    'confirmed'            => ':attributeと、確認フィールドとが、一致していません。',
    'current_password'     => 'パスワードが正しくありません。',
    'date'                 => ':attributeには有効な日付を入力してください。',
    'date_equals'          => ':attributeには、:dateと同じ日付けを入力してください。',
    'date_format'          => ':attributeは:format形式で入力してください。',
    'different'            => ':attributeと:otherには、異なった内容を入力してください。',
    'digits'               => ':attributeは:digits桁で入力してください。',
    'digits_between'       => ':attributeは:min桁から:max桁の間で入力してください。',
    'dimensions'           => ':attributeの図形サイズが正しくありません。',
    'distinct'             => ':attributeには異なった値を入力してください。',
    'email'                => ':attributeには、有効なメールアドレスを入力してください。',
    'ends_with'            => ':attributeには、:valuesのどれかで終わる値を入力してください。',
    'exists'               => '選択された:attributeは正しくありません。',
    'file'                 => ':attributeにはファイルを指定してください。',
    'filled'               => ':attributeに値を入力してください。',
    'gt'                   => [
        'numeric' => ':attributeには、:valueより大きな値を入力してください。',
        'file'    => ':attributeには、:value kBより大きなファイルを指定してください。',
        'string'  => ':attributeは、:value文字より長く入力してください。',
        'array'   => ':attributeには、:value個より多くのアイテムを入力してください。',
    ],
    'gte'                  => [
        'numeric' => ':attributeには、:value以上の値を入力してください。',
        'file'    => ':attributeには、:value kB以上のファイルを指定してください。',
        'string'  => ':attributeは、:value文字以上で入力してください。',
        'array'   => ':attributeには、:value個以上のアイテムを入力してください。',
    ],
    'image'                => ':attributeには画像ファイルを入力してください。',
    'in'                   => '選択された:attributeは正しくありません。',
    'in_array'             => ':attributeには:otherの値を入力してください。',
    'integer'              => ':attributeは整数で入力してください。',
    'ip'                   => ':attributeには、有効なIPアドレスを入力してください。',
    'ipv4'                 => ':attributeには、有効なIPv4アドレスを入力してください。',
    'ipv6'                 => ':attributeには、有効なIPv6アドレスを入力してください。',
    'json'                 => ':attributeには、有効なJSON文字列を入力してください。',
    'lt'                   => [
        'numeric' => ':attributeには、:valueより小さな値を入力してください。',
        'file'    => ':attributeには、:value kBより小さなファイルを指定してください。',
        'string'  => ':attributeは、:value文字より短く入力してください。',
        'array'   => ':attributeには、:value個より少ないアイテムを入力してください。',
    ],
    'lte'                  => [
        'numeric' => ':attributeには、:value以下の値を入力してください。',
        'file'    => ':attributeには、:value kB以下のファイルを指定してください。',
        'string'  => ':attributeは、:value文字以下で入力してください。',
        'array'   => ':attributeには、:value個以下のアイテムを入力してください。',
    ],
    'max'                  => [
        'numeric' => ':attributeには、:max以下の数字を入力してください。',
        'file'    => ':attributeには、:max kB以下のファイルを指定してください。',
        'string'  => ':attributeは、:max文字以下で入力してください。',
        'array'   => ':attributeは:max個以下入力してください。',
    ],
    'mimes'                => ':attributeには:valuesタイプのファイルを指定してください。',
    'mimetypes'            => ':attributeには:valuesタイプのファイルを指定してください。',
    'min'                  => [
        'numeric' => ':attributeには、:min以上の数字を入力してください。',
        'file'    => ':attributeには、:min kB以上のファイルを指定してください。',
        'string'  => ':attributeは、:min文字以上で入力してください。',
        'array'   => ':attributeは:min個以上入力してください。',
    ],
    'multiple_of' => ':attributeには、:valueの倍数を入力してください。',
    'not_in'               => '選択された:attributeは正しくありません。',
    'not_regex'            => ':attributeの形式が正しくありません。',
    'numeric'              => ':attributeには、数字を入力してください。',
    'password'             => '正しいパスワードを入力してください。',
    'present'              => ':attributeが存在していません。',
    'regex'                => ':attributeに正しい形式を入力してください。',
    'required'             => ':attributeは必ず入力してください。',
    'required_if'          => ':otherが:valueの場合、:attributeも入力してください。',
    'required_unless'      => ':otherが:valuesでない場合、:attributeを入力してください。',
    'required_with'        => ':valuesを入力する場合は、:attributeも入力してください。',
    'required_with_all'    => ':valuesを入力する場合は、:attributeも入力してください。',
    'required_without'     => ':valuesを入力しない場合は、:attributeを入力してください。',
    'required_without_all' => ':valuesのどれも入力しない場合は、:attributeを入力してください。',
    'prohibited'           => ':attributeは入力禁止です。',
    'prohibited_if' => ':otherが:valueの場合、:attributeは入力禁止です。',
    'prohibited_unless'    => ':otherが:valueでない場合、:attributeは入力禁止です。',
    'prohibits'            => 'attributeは:otherの入力を禁じています。',
    'same'                 => ':attributeと:otherには同じ値を入力してください。',
    'size'                 => [
        'numeric' => ':attributeは:sizeを入力してください。',
        'file'    => ':attributeのファイルは、:sizeキロバイトでなくてはなりません。',
        'string'  => ':attributeは:size文字で入力してください。',
        'array'   => ':attributeは:size個入力してください。',
    ],
    'starts_with'          => ':attributeには、:valuesのどれかで始まる値を入力してください。',
    'string'               => ':attributeは文字列を入力してください。',
    'timezone'             => ':attributeには、有効なゾーンを入力してください。',
    'unique'               => ':attributeの値は既に存在しています。',
    'uploaded'             => ':attributeのアップロードに失敗しました。',
    'url'                  => ':attributeに正しい形式を入力してください。',
    'uuid'                 => ':attributeに有効なUUIDを入力してください。',

    /*
    |--------------------------------------------------------------------------
    | Custom バリデーション言語行
    |--------------------------------------------------------------------------
    |
    | "属性.ルール"の規約でキーを入力することでカスタムバリデーション
    | メッセージを定義できます。入力した属性ルールに対する特定の
    | カスタム言語行を手早く入力できます。
    |
    */

    'custom' => [
        '属性名' => [
            'ルール名' => 'カスタムメッセージ',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | カスタムバリデーション属性名
    |--------------------------------------------------------------------------
    |
    | 以下の言語行は、例えば"email"の代わりに「メールアドレス」のように、
    | 読み手にフレンドリーな表現でプレースホルダーを置き換えるために入力する
    | 言語行です。これはメッセージをよりきれいに表示するために役に立ちます。
    |
    */

    'attributes' => [
        'image' => '画像',
        'title' => 'タイトル',
        'content' => '説明',
        'tag' => 'タグ',
        'email' => 'メールアドレス',
        'password' => 'パスワード',
        'name' => 'ユーザー名',
        'license' => 'ライセンス',
    ],

];
