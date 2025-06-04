<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormAssignment extends Model
{
    protected $fillable = ['patient_id', 'form_id', 'status'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    public function submissions()
    {
        return $this->hasMany(FormSubmission::class);
    }
}
