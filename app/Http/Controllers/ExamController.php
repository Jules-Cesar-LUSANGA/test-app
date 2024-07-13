<?php

namespace App\Http\Controllers;

use App\Class\EvaluationPresentation;
use App\Http\Requests\Exam\CreateExamRequest;
use App\Http\Requests\ShowExamRequest;
use App\Models\Exam;
use App\Models\Presentation;
use Carbon\CarbonInterval;
use Illuminate\Http\RedirectResponse;
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
        $exams = auth()->user()->exams()->orderByDesc('created_at')->paginate(10);

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
        $exam = $this->getExamAndQuestions($exam);

        return view('exams.show', compact('exam'));
    }

    public function showWithCode(ShowExamRequest $request)
    {
        // Vérication de l'existence de l'évaluation
        $exam = $this->getExam($request);

        // Lever une erreur l'évaluation n'est pas encore lancée
        if ($exam->end_at == null) {
            return back()->with('error', "L'évaluation n'est pas encore lancée");
        }
        // Lever une erreur si le délai est déjà dépassé
        $end_at = $exam->end_at;
        if (now() > $end_at) {
            return back()->with('error', "Le temps est déjà dépassé");
        }

        // Vérifier et récupérer si l'étudiant a déjà présenté cette évaluation
        $presentation = EvaluationPresentation::userPassedEvaluation($exam);
        // Lever une erreur si aucune autorisation de refaire n'a été donné
        $this->checkIfHasAnotherChance($presentation);

        // Marquer comme déjà présentée
        $presentation->update([
            'retake' => false,
        ]);

        [$exam, $questions] = $this->getExamAndQuestions($exam);
        
        // Récupérer le temps qui reste avant la fin de l'évaluation
        $minutes = CarbonInterval::diff(now(), $end_at)->totalMinutes;
        $timeLeft = (int)$minutes+1;

        return view('exams.show-student', compact('exam', 'questions', 'timeLeft'));
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
                        ->with('success', 'Evaluation modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Exam $exam)
    {
        // Delete exam
        $exam->delete();

        return redirect()->route('exams.index')
                        ->with('success', 'Evaluation supprimée');
    }

    public function allowAnotherChance(Exam $exam)
    {
        // Decrement exam attempts
        if ($exam->attempts > 0) {
            $exam->update([
                'attempts'  => $exam->attempts - 1,
                'end_at'    => null,
            ]);
        } else {
            return back()->with('error', 'Le nombre de tentative restante est de 0');
        }
        
        $exam->presentations()->each(function($presentation){
            $presentation->update([
                'retake'    => true,
            ]);
        });

        return back()->with("success", "Une nouvelle chance a été accordée !");
    }

    public function getExamAndQuestions(Exam $exam)
    {
        // Get exam and its questions
        $exam->load(['questions', 'questions.assertions']);

        if (Auth::user()->role_id == self::STUDENT_ROLE_ID) {
            // Récuperer les questions en inversant l'ordre
            $questions = $exam->questions()
                                ->with(['assertions'])
                                ->get()
                                ->shuffle();

            return [$exam, $questions];
        }

        return $exam;
    }

    public function generateCode()
    {
        $code = \Str::random(10);

        if (Exam::where('code', $code)->exists()) {
            return $this->generateCode();
        }

        return $code;
    }

    // Lancer une évaluation
    public function launch(ShowExamRequest $request)
    {
        $exam = $this->getExam($request);

        // Vérifier qu'il reste des tentatives
        if ($exam->attempts < 1) {
            return back()->with('error', "Aucune tentative restante !");
        }
        
        $exam_duration = $exam->duration;
        $end_at = now()->addMinutes($exam_duration);

        $exam->update([
            'end_at' => $end_at
        ]);

        return back()->with('success', "L'évaluation a été lancée !");
    }

    public function getExam(ShowExamRequest $request) : Exam | RedirectResponse
    {
        $exam = Exam::where('code', $request->code)->first();

        if ($exam == null) {
            return abort(404);
        }

        return $exam;
    }

    public function checkIfHasAnotherChance(Presentation $presentation)
    {
        if ($presentation->retake == false) {
            return abort(403,  "Vous avez déjà présenté cette évaluation !");
        }
    }
}