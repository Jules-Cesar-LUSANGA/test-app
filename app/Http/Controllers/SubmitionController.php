<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Presentation;
use Illuminate\Http\Request;

class SubmitionController extends Controller
{
    public function get(Exam $exam)
    { 
        $exam->load(['presentations.user', 'presentations.exam']);
        
        return view('exams.submitions.index', compact('exam'));
    }

    public function show(Presentation $presentation)
    {
        $presentation->load(['responses.question', 'responses.assertions', 'responses.assertions.questionAssertion']);

        $exam = $presentation->exam;
        $student = $presentation->user;
        $responses = $presentation->responses;
        
        return view('exams.submitions.show', compact('presentation', 'exam', 'student', 'responses'));
    }

    public function setPoints(Presentation $presentation, Request $request)
    {
        $request->validate([
            'points' => ['required', 'array'],
        ]);

        // Récupérer toutes les réponses pour ajouter les côtes
        $i = 0;

        foreach ($presentation->responses as $response) {
            $response->update([
                'points'    => $request->points[$i]
            ]);
            $i++;
        }

        dump($presentation->responses);

        dd($request->all());
    }
}
