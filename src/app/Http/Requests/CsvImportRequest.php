<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class CsvImportRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'csv_file' => 'required|file|mimes:csv,txt',
        ];
    }

    public function messages()
    {
        return [
            'csv_file.required' => 'CSVファイルは必須です。',
            'csv_file.file' => 'アップロードされたファイルは無効です。再度ファイルを選択してください。',
            'csv_file.mimes' => 'CSVまたはテキストファイルのみが許可されています。',
        ];
    }


    /**
     * Configure the validator for the request.
     *
     * @param \Illuminate\Validation\Validator $validator
     * @return void
     */
    public function withValidator($validator)
{
    // ファイルが存在しない場合にエラーメッセージを追加
    $validator->after(function ($validator) {

        if (!$this->hasFile('csv_file') || !$this->file('csv_file')->isValid()) {
            $validator->errors()->add('csv_file', 'CSVファイルのアップロードに失敗しました。再度ファイルを選択してください。');
        }

        // CSVレコードを取得
        $records = $this->getCsvRecords();

        // レコードが配列か確認し、適切なバリデーションを行う
        if (is_array($records) && !empty($records)) {
            foreach ($records as $record) {
                // 各レコードが配列であるか確認
                if (is_array($record)) {
                    // 画像URLのバリデーション（URLの拡張子がjpegまたはpngか）
                    if (isset($record['画像URL'])) {
                        $imageUrl = $record['画像URL'];
                        $extension = pathinfo($imageUrl, PATHINFO_EXTENSION);
                        if (!in_array(strtolower($extension), ['jpeg', 'jpg', 'png'])) {
                            $validator->errors()->add('csv_file', 'CSVの画像URLはJPEGまたはPNG形式のみが許可されています。');
                        }
                    }
                    $csvValidator = Validator::make($record, [
                        '店舗名' => 'required|string|max:50',
                        '地域' => 'required|string|exists:prefectures,name',
                        'ジャンル' => 'required|string|exists:genres,name',
                        '店舗概要' => 'required|string|max:400',
                        '画像URL' => 'required|url',
                    ]);

                    if ($csvValidator->fails()) {
                        $csvValidator->errors()->add('csv_file', 'CSVのデータにエラーがあります。');
                    }
                } else {
                    $validator->errors()->add('csv_file', 'CSVのフォーマットが不正です。');
                }
            }
        } else {
            $validator->errors()->add('csv_file', 'CSVファイルが空か無効です。');
        }

    });
}



    /**
     * CSVファイルのレコードを取得
     *
     * @return array
     */
    protected function getCsvRecords()
    {
        // ファイルが選択されているか確認
        if ($this->hasFile('csv_file') && $this->file('csv_file')->isValid()) {
            // CSVの読み込み
            $csv = \League\Csv\Reader::createFromPath($this->file('csv_file')->getPathname(), 'r');
            $csv->setHeaderOffset(0);  // ヘッダー行を指定
            return iterator_to_array($csv->getRecords());
        }
        return back()->withErrors(['csv_file' => 'CSVファイルが選択されていないか、無効です。']);
    }
}
