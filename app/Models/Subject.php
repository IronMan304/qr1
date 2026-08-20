<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = ['code', 'name', 'description'];

    public function modules() {
    return $this->belongsToMany(Module::class, 'module_subject');
}


}

