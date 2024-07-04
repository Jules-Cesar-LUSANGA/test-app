<?php

namespace App\Class;

use App\Models\Exam;
use Illuminate\Support\Facades\Auth;

class EvaluationPresentation {
    
    public static function userPassedEvaluation(Exam $exam)
    {
        $presentation = auth()->user()
                    ->presentations()
                    ->where([
                        'exam_id'   => $exam->id,
                    ])->first();
        
        if ($presentation == null) {
            $presentation = $exam->presentations()->create([
                'user_id' => Auth::id()
            ]);
        }
        
        return $presentation;
    }
}