<?php

namespace App\Http\Controllers;

use App\Models\Assertion;
use Illuminate\Http\Request;

class AssertionController extends Controller
{
    public function IsAnswer(Assertion $assertion)
    {
        // Set or Unset an assertion like question qcm answer
        $assertion->isAnswer = !$assertion->isAnswer;
        $assertion->save();

        return back();
    }

}
