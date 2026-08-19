<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
  // ✅ idagdag ang course_id dito
    protected $fillable = ['code','name','course_id'];

    public function subjects() {
        return $this->belongsToMany(Subject::class, 'module_subject');
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }
    
}
