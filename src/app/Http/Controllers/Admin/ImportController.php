<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CsvImportRequest;
use App\Models\Shop;
use App\Models\Genre;
use App\Models\Prefecture;
use Illuminate\Support\Facades\Validator;
use League\Csv\Reader;

class ImportController extends Controller
{

    public function showImport()
    {
        return view('admin.import');
    }

    // public function store(CsvImportRequest $request)
    // {
    //     // CSVの読み込み
    //     $csv = Reader::createFromPath($request->file('csv_file')->getPathName(), 'r');
    //     $csv->setHeaderOffset(0);  // ヘッダー行を指定
    //     $records = $csv->getRecords();
    //     foreach ($records as $record) {

    //         // 地域IDとジャンルIDを取得
    //         $prefecture = Prefecture::where('name', $record['地域'])->first();
    //         $genre = Genre::where('name', $record['ジャンル'])->first();

    //         // データベースに保存
    //         Shop::create([
    //             'name' => $record['店舗名'],
    //             'prefecture_id' => $prefecture->id,
    //             'genre_id' => $genre->id,
    //             'detail' => $record['店舗概要'],
    //             'image_path' => $record['画像URL'],
    //         ]);
    //     }

    //     return back()->with('success', 'CSVインポートが完了しました。');
    // }
    public function store(CsvImportRequest $request)
    {
        // CSVファイルが選択されているか確認
        if ($request->hasFile('csv_file') && $request->file('csv_file')->isValid()) {
            // CSVの読み込み
            $csv = Reader::createFromPath($request->file('csv_file')->getPathname(), 'r');
            $csv->setHeaderOffset(0);  // ヘッダー行を指定
            $records = $csv->getRecords();

            foreach ($records as $record) {
                // 地域IDとジャンルIDを取得
                $prefecture = Prefecture::where('name', $record['地域'])->first();
                $genre = Genre::where('name', $record['ジャンル'])->first();

                // データベースに保存
                Shop::create([
                    'name' => $record['店舗名'],
                    'prefecture_id' => $prefecture->id,
                    'genre_id' => $genre->id,
                    'detail' => $record['店舗概要'],
                    'image_path' => $record['画像URL'],
                ]);
            }

            return back()->with('success', 'CSVインポートが完了しました。');
        } else {
            return back()->withErrors(['csv_file' => 'CSVファイルを選択してください。']);
        }
    }
}
