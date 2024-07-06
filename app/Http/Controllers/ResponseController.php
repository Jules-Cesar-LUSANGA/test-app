<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Class\EvaluationPresentation;
use Illuminate\Http\Request;

class ResponseController extends Controller
{
    public function set(Exam $exam, Request $request)
    {
        $presentation = EvaluationPresentation::userPassedEvaluation($exam);

        // Create a submition
        $submition = $presentation->submitions()->create();

        $data = $request->except('_token');

        foreach ($data as $key => $value) {

            // Get question id
            $questionId = \Str::after($key, 'question');
            // Retrive question from database
            $question = $exam->questions()->find((int) $questionId);
            
            if ($question !== null) {

                $isQcm = $question->qcm;

                if ($isQcm == true) {
                    // Get assertion choice
                    $assertion = \Str::after($questionId, $question->id . "-assertion-");
                    
                    // Save this assertion response if not saved

                    $response = $submition->responses()->where('question_id', $question->id)->firstOrCreate([
                        'question_id' => $question->id
                    ]);

                    $response->assertions()->create([
                        'assertion_id'  => (int) $assertion
                    ]);

                } else {
                    $submition->responses()->create([
                        'question_id' => $question->id,
                        'content'     => $value
                    ]);
                }
            }

        }

        // Student can't submit again this presentation if not allowed
        $presentation->update([
            'retake' => false,
        ]);

        return redirect()->route('dashboard')->with('success', 'Evaluation submitted');
    }
}
