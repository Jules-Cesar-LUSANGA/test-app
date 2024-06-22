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
}
