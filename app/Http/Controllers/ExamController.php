<?php

namespace App\Http\Controllers;

use App\Class\EvaluationPresentation;
use App\Http\Requests\Exam\CreateExamRequest;
use App\Models\Exam;
use App\Models\Presentation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    const STUDENT_ROLE_ID = 3;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all user exams
        $exams = auth()->user()->exams()->orderByDesc('created_at')->get();

        return view('exams.index', compact('exams'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('exams.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateExamRequest $request)
    {
        $data = $request->validated();
        $data['code'] = $this->generateCode();

        // Create a new exam
        $exam = auth()->user()->exams()->create($data);

        return redirect()->route('exams.show', compact('exam'))
                        ->with('success', 'Exam created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        // Get exam and its questions
        $exam->load(['questions', 'questions.assertions']);

        if (Auth::user()->role_id == self::STUDENT_ROLE_ID) {
            // Récuperer les questions en inversant l'ordre
            $questions = $exam->questions()
                                ->with(['assertions'])
                                ->get()
                                ->shuffle();

            return view('exams.show-student', compact('exam', 'questions'));
        }
        return view('exams.show', compact('exam'));
    }

    public function showWithCode(Request $request)
    {
        // Used when a student want to reply to an evaluation
        $request->validate([
            'code' => 'required'
        ]);

        $exam = Exam::where('code', $request->code)->first();

        if ($exam == null) {
            return redirect()->back()->with('error', 'Evaluation code invalid');
        }

        // Check if user passed already this evaluation

        $presentation = EvaluationPresentation::userPassedEvaluation($exam);

        // Set presented
        $presentation->update([
            'retake' => false,
        ]);

        return redirect()->route('exams.show', $exam->id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Exam $exam)
    {
        return view('exams.edit', compact('exam'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateExamRequest $request, Exam $exam)
    {
        // Update exam informations
        $exam->update($request->validated());

        return redirect()->route('exams.show', compact('exam'))
                        ->with('success', 'Exam updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        // Delete exam
        $exam->delete();

        return redirect()->route('exams.index')
                        ->with('success', 'Exam deleted successfully');
    }

    public function allowAnotherChance(Exam $exam)
    {
        $exam->presentations()->each(function($presentation){
            $presentation->update([
                'retake'    => true
            ]);
        });

        return back()->with("success", "Une nouvelle chance a été accordée !");
    }

    public function generateCode()
    {
        $code = \Str::random(10);

        if (Exam::where('code', $code)->exists()) {
            return $this->generateCode();
        }

        return $code;
    }
}
