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
                                ->orderBy('created_at', 'desc')
                                ->get();

        return view('presentations.index', compact('presentations'));
    }
}
