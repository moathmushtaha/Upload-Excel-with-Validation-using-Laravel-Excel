<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'application';
    public function program()
    {
        return $this->belongsTo(Program::class, 'program_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
}
