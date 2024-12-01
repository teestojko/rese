<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EvaluationRequest;

class EvaluationController extends Controller
{
    public function evaluation(Shop $shop)
    {
        return view('Evaluation.evaluation', compact('shop'));
    }

    public function store(EvaluationRequest $request, Shop $shop)
    {
        $existingEvaluation = Evaluation::where('user_id', Auth::id())
            ->where('shop_id', $shop->id)
            ->first();
            if ($existingEvaluation) {
                return redirect()->back()->withErrors(['custom_error' => '既にこの店舗にレビューを投稿しています。']);
            }
        $evaluation = new Evaluation();
        $evaluation->user_id = Auth::id();
        $evaluation->shop_id = $shop->id;
        $evaluation->comment = $request->comment;
        $evaluation->stars = $request->stars;
        $evaluation->save();
        return back()
        ->with('success', 'レビューを投稿しました');
    }
}
