<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentType extends Model
{
    protected $fillable = ['name','domain_id'];

    public function domain() {
        return $this->belongsTo(Domain::class);
    }
}
