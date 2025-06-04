<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormSubmission extends Model
{
    protected $fillable = ['form_assignment_id', 'data', 'status', 'submitted_at'];

    public function formAssignment()
    {
        return $this->belongsTo(FormAssignment::class);
    }

    public function assignment()
    {
        return $this->formAssignment();
    }
}
