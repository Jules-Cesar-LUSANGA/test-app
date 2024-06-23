<?php

namespace App\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresentationController extends Controller
{
    public function index()
    {
        $presentations = Auth::user()->presentations()
                                ->with(['exam'])
                                ->where('finished', true)
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('presentations.index', compact('presentations'));
    }

    public function allowSecondChance(Presentation $presentation)
    {
        $presentation->update([
            'redo'      => true,
            'finished'  => true,
        ]);

        return back()->with('success', "L'étudiant est autorisé à refaire cette évaluation");
    }
}
