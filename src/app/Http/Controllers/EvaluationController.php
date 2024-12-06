<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evaluation;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EvaluationRequest;
use App\Http\Requests\UpdateEvaluationRequest;

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
        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('public');
            $evaluation->image_path = $imagePath;
        }

        $evaluation->save();
        return back()
        ->with('success', '口コミを投稿しました');
    }

    public function edit($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        if ($evaluation->user_id !== Auth::id()) {
            abort(403);
        }
        return view('Evaluation.edit', compact('evaluation'));
    }

    // public function update(UpdateEvaluationRequest $request, $id)
    // {
    //     $evaluation = Evaluation::findOrFail($id);
    //     if ($evaluation->user_id !== Auth::id()) {
    //         abort(403);
    //     }
    //     $validated = $request->validate([
    //         'stars' => 'required|integer|min:1|max:5',
    //         'comment' => 'required|string|max:1000',
    //         'image' => 'nullable|image|max:2048',
    //     ]);
    //     $evaluation->stars = $validated['stars'];
    //     $evaluation->comment = $validated['comment'];
    //     if ($request->hasFile('image')) {
    //         $path = $request->file('image')->store('evaluations', 'public');
    //         $evaluation->image_path = $path;
    //     }
    //     $evaluation->save();
    //     return redirect()->route('shops.show', $evaluation->shop_id)->with('success', '評価を更新しました。');
    // }

    public function update(UpdateEvaluationRequest $request, $id)
        {
            $evaluation = Evaluation::findOrFail($id);

            $evaluation->stars = $request->stars;
            $evaluation->comment = $request->comment;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('evaluations', 'public');
                $evaluation->image_path = $path;
            }

            $evaluation->save();

            return redirect()->route('shops.show', $evaluation->shop_id)
                            ->with('success', '評価を更新しました。');
        }


    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        if ($evaluation->user_id !== Auth::id()) {
            abort(403);
        }
        $evaluation->delete();
        return redirect()->back()->with('success', '評価を削除しました。');
    }

    public function index($shopId)
    {
        $shop = Shop::findOrFail($shopId);
        $evaluations = Evaluation::where('shop_id', $shopId)->with('user')->get();
        return view('Evaluation.index', compact('shop', 'evaluations'));
    }
}
