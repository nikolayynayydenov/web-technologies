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
        //
    }

    /**
     * Check if a user has logged
     * 
     * @return bool
     */
    public static function check()
    {
        return array_key_exists('teacherId', $_SESSION);
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
}
