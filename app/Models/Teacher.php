<?php

namespace App\Models;

use Core\Model;
use Core\Database;

class Teacher extends Model
{
    protected static $table = 'teachers';

    public function getOwnEvents()
    {
        return [];
    }
}
