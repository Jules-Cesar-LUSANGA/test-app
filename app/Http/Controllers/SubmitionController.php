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

        $presentation->load('responses.question');

        // Récupérer toutes les réponses pour ajouter les côtes
        $i = 0;

        foreach ($presentation->responses as $response) {

            // Vérifier que les points accordées sont bien des nombres et ne dépasse pas le nombre de points de la question
            if (!is_numeric($request->points[$i]) || $request->points[$i] > $response->question->points) {
                return back()->withErrors(['points' => 'Les points accordées doivent être des nombres et ne doivent pas dépasser le nombre de points de la question']);
            }

            $response->update([
                'points'    => $request->points[$i]
            ]);
            $i++;
        }

        dump($presentation->responses);

        dd($request->all());
    }
}
