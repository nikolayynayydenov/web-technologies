<?php

namespace App\Controllers;

use App\Services\Auth;
use App\Services\Validator;
use App\Models\Student;

class StudentsController
{
    public function create()
    {
        view('students/create');
    }

    public function store()
    {
        Auth::onlyTeacher();

        $v = new Validator($_POST);
        $v->validate([
            'faculty_number' => ['required', 'min:10000', 'max:99999'],
            'first_name' => ['required', 'minLen:1', 'maxLen:50'],
            'last_name' => ['required', 'minLen:1', 'maxLen:50'],
        ]);

        if (!$v->isValid()) {
            $_SESSION['errors'] = $v->errors;
            redirect("/student/create");
        }

        Student::insert($v->validated);

        $_SESSION['message'] = 'Студентът ' . $v->validated['faculty_number'] . ' е добавен успешно.';
        redirect('/dashboard');
    }
}
