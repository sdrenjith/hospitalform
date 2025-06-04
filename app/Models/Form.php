<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    protected $fillable = ['name', 'department_id', 'blade_view'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }
    public function assignments()
    {
        return $this->hasMany(FormAssignment::class);
    }
    public function submissions()
    {
        return $this->hasManyThrough(FormSubmission::class, FormAssignment::class);
    }
}
