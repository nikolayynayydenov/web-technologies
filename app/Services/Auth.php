<?php

namespace App\Services;

use App\Models\Teacher;

class Auth
{
    /**
     * Get the current authenticated user (teacher)
     * 
     * @return Teacher|null
     */
    public static function user()
    {
        // TODO
    }

    /**
     * Check if a teacher has logged
     * 
     * @return bool
     */
    public static function checkTeacher()
    {
        return array_key_exists('teacherId', $_SESSION) && is_numeric($_SESSION['teacherId']) && !self::checkStudent();
    }

    /**
     * Check if a student has logged
     * 
     * @return bool
     */
    public static function checkStudent()
    {
        return array_key_exists('fn', $_SESSION) && is_numeric($_SESSION['fn']) && !self::checkTeacher();
    }

    public static function check()
    {
        return self::checkTeacher() || self::checkStudent();
    }


    /**
     * @param User $teacher
     * @return void
     */
    public static function login(Teacher $teacher)
    {
        $_SESSION['teacherId'] = $teacher->id;
        $_SESSION['firstName'] = $teacher->first_name;
        $_SESSION['lastName'] = $teacher->last_name;
    }

    /**
     * If neither a teacher nor a student has been authenticated, redirect to login
     */
    public static function guard()
    {
        if (!self::checkTeacher() && !self::checkStudent()) {
            redirect('/login');
        }
    }

    public static function onlyTeacher()
    {
        if (!self::checkTeacher()) {
            redirect('/login');
        }
    }
}
