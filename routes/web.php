<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\FormAssignment;
use App\Models\FormSubmission;
use App\Models\Form;
use Illuminate\Http\Request;
use App\Http\Controllers\FormSubmissionController;

Route::get('/', function () {
    if (auth()->check()) {
        return redirect('/dashboard');
    }
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Patient dashboard: show assigned forms
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        $patient = $user->patient ?? \App\Models\Patient::where('user_id', $user->id)->first();
        $assignments = $patient ? FormAssignment::where('patient_id', $patient->id)->with('form')->get() : collect();
        return view('patient.dashboard', compact('assignments'));
    })->name('dashboard');

    // Show assigned form (dynamic blade view)
    Route::get('/assigned-form/{assignment}', function (FormAssignment $assignment) {
        $submission = $assignment->submissions()->where('status', '!=', 'submitted')->first();
        $form = $assignment->form;
        $data = $submission ? json_decode($submission->data, true) : [];
        return view($form->blade_view, [
            'assignment' => $assignment,
            'form' => $form,
            'data' => $data,
            'submission' => $submission,
            'readOnly' => false
        ]);
    })->name('assigned.form');

    // Autosave/save as draft/submit
    Route::post('/assigned-form/{assignment}/save', function (Request $request, FormAssignment $assignment) {
        $data = $request->except(['_token', 'action']);
        $status = $request->input('action') === 'submit' ? 'submitted' : 'draft';
        $submission = $assignment->submissions()->updateOrCreate(
            ['status' => 'draft'],
            ['data' => json_encode($data), 'status' => $status, 'submitted_at' => $status === 'submitted' ? now() : null]
        );
        return response()->json(['success' => true, 'status' => $status]);
    });
});

// Route to view headache questionnaire directly (for testing)
Route::get('/headache-questionnaire', function () {
    return view('headache-questionnaire');
});

Route::get('/admin/submissions/{submission}', [FormSubmissionController::class, 'show'])
    ->middleware(['auth', 'admin'])
    ->name('admin.submissions.show');

Route::get('/admin/submissions/{submission}/edit', [FormSubmissionController::class, 'edit'])
    ->middleware(['auth', 'admin'])
    ->name('admin.submissions.edit');

Route::post('/admin/submissions/{submission}/update', [FormSubmissionController::class, 'update'])
    ->middleware(['auth', 'admin'])
    ->name('admin.submissions.update');

Route::get('/admin/submissions/{submission}/export', [App\Http\Controllers\FormSubmissionController::class, 'exportPdf'])->name('admin.submissions.export');

require __DIR__.'/auth.php';
