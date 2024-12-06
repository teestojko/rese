<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Evaluation;

class EvaluationEditController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('can:delete-evaluations');
    // }

    public function index()
    {
        $evaluations = Evaluation::all();
        return view('Admin.evaluations_index', compact('evaluations'));
    }

    public function destroy($id)
    {
        $evaluation = Evaluation::findOrFail($id);
        $evaluation->delete();

        return back()->with('success', '口コミが削除されました。');
    }
}
