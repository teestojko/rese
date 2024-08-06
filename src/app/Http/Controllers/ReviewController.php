<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Shop $shop)
    {
        $existingReview = Review::where('user_id', Auth::id())
            ->where('shop_id', $shop->id)
            ->first();
            if ($existingReview) {
                return redirect()->route('shops.show', $shop)->with('error', '既にこの店舗にレビューを投稿しています。');
            }
            
        $review = new Review();
        $review->user_id = Auth::id();
        $review->shop_id = $shop->id;
        $review->comment = $request->comment;
        $review->stars = $request->stars;
        $review->save();

        return redirect()->route('shops.show', $shop)->with('success', 'レビューを投稿しました');
    }

    public function destroy(Review $review)
    {
        if (Auth::id() !== $review->user_id) {
            return response()->json(['error' => 'この操作を実行する権限がありません。'], 403);
        }

        $review->delete();

        return back()->with('success', 'レビューを削除しました');
    }
}
