<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreQcmQuestionRequest;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Exam;
use App\Models\Question;

class QuestionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreQuestionRequest $request, Exam $exam)
    {
        $exam->questions()->create(
            [
                'content'   => $request->content,
                'qcm'       => false
            ]
        );

        return redirect()->back()->with('success', 'Question created successfully.');
    }

    public function storeQcm(StoreQcmQuestionRequest $request, Exam $exam)
    {
        //  Create exam qcm question
        $question = $exam->questions()->create(
            [
                'content'   => $request->content,
                'qcm'       => true
            ]
        );

        // Create all assertions
        foreach ($request->assertions as $assertion) {

            // An assertion can't be null
            if ($assertion != null) {
                $question->assertions()->create([
                    'content' => $assertion
                ]);
            }            
        }

        return redirect()->back()->with('success', 'Question created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Question $question)
    {
        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        $question->update([
            'content'   => $request->input('content')
        ]);

        return to_route('exams.show', $question->exam);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Question $question)
    {
        $question->delete();

        return back()->with("success", "La question a été supprimée");
    }
}
