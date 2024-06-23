<?php

namespace App\Class;

use App\Models\Exam;
use App\Models\Presentation;

class EvaluationPresentation {
    
    public static function userPassedEvaluation(Exam $exam) : Presentation | null
    {
        return auth()->user()
                    ->presentations()
                    ->where([
                        'exam_id'   => $exam->id,
                        'redo'      => false
                    ])->first();
    }
}