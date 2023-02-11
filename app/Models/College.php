<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $table = 'college';
    protected $primaryKey = 'college_id';
    public function programs()
    {
        return $this->hasMany(Program::class, 'college_id');
    }

    public function applications()
    {
        return $this->hasManyThrough(Application::class, Program::class, 'college_id', 'program_id');
    }
}
