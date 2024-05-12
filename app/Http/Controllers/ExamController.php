<?php

namespace App\Http\Controllers;

use App\Http\Requests\Exam\CreateExamRequest;
use App\Models\Exam;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all user exams
        $exams = auth()->user()->exams;

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
        // Create a new exam
        $exam = auth()->user()->exams()->create($request->validated());

        return redirect()->route('exams.show', compact('exam'))
                        ->with('success', 'Exam created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Exam $exam)
    {
        // Get exam and its questions
        // $exam->load('questions');

        return view('exams.show', compact('exam'));
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
}
