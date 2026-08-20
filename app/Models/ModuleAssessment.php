<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleAssessment extends Model {
    protected $fillable = ['student_id','module_id','weight','grade','points'];
    public function student() { return $this->belongsTo(Student::class); }
    public function module() { return $this->belongsTo(Module::class); }
}

