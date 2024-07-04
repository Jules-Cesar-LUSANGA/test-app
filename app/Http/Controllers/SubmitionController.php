<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Presentation;
use App\Models\Submition;
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
        // $presentation->load(['responses.question', 'responses.assertions', 'responses.assertions.questionAssertion']);

        $exam = $presentation->exam;
        $student = $presentation->user;
        $submitions = $presentation->submitions;
        
        return view('exams.submitions.show', compact('presentation', 'exam', 'student', 'submitions'));
    }

    public function setPoints(Submition $submition, Request $request)
    {
        $request->validate([
            'points' => ['required', 'array'],
        ]);

        $submition->load('responses.question');

        // Récupérer toutes les réponses pour ajouter les côtes
        $i = 0;

        foreach ($submition->responses as $response) {

            // Vérifier que les points accordées sont bien des nombres et ne dépasse pas le nombre de points de la question
            if (!is_numeric($request->points[$i]) || $request->points[$i] > $response->question->points) {
                return back()->withErrors(['points' => 'Les points accordées doivent être des nombres et ne doivent pas dépasser le nombre de points de la question']);
            }

            $response->update([
                'points'    => $request->points[$i]
            ]);
            $i++;
        }

        // Marquer comme déjà corrigé
        $submition->update([
            'finished' => true
        ]);

        return back()->with('success', 'Les points ont été attribués avec succès');
    }
}
