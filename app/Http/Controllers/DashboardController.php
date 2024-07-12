<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    const ADMIN_ROLE_ID = 1;
    const TEACHER_ROLE_ID = 2;
    const STUDENT_ROLE_ID = 3;
    const SUPERVISOR_ROLE_ID = 4;
    
    public function index()
    {
        switch (auth()->user()->role_id) {
            case self::ADMIN_ROLE_ID:
                $allUsers = User::all();
                $users = $allUsers->count();
                $teachers = $allUsers->where('role_id', self::TEACHER_ROLE_ID)->count();
                $students = $allUsers->where('role_id', self::STUDENT_ROLE_ID)->count();
                $supervisors = $allUsers->where('role_id', self::SUPERVISOR_ROLE_ID)->count();

                return view('dashboard', compact('users', 'teachers', 'students', 'supervisors'));                

                break;
            
            case self::TEACHER_ROLE_ID:
                $exams = Exam::count();
                
                return view('dashboard', compact('exams'));

                break;

            case self::STUDENT_ROLE_ID:
                $exams = auth()->user()->presentations()->count();
                
                return view('dashboard', compact('exams'));

                break;
        }

        return view('dashboard');
    }
}
