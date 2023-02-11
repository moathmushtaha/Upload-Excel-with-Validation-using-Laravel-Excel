<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    protected $table = 'program';
    protected $primaryKey = 'program_id';

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }

    public function applications()
    {
        return $this->hasMany(Application::class, 'program_id');
    }
}
