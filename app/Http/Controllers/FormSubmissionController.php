<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormSubmission;
use Barryvdh\Snappy\Facades\SnappyPdf as Pdf;

class FormSubmissionController extends Controller
{
    public function show(FormSubmission $submission)
    {
        $data = json_decode($submission->data, true);
        $assignment = $submission->assignment;
        return view('headache-questionnaire', [
            'data' => $data,
            'assignment' => $assignment,
            'readOnly' => true,
            'submission' => $submission
        ]);
    }

    public function edit(FormSubmission $submission)
    {
        $data = json_decode($submission->data, true);
        $assignment = $submission->assignment;
        return view('headache-questionnaire', [
            'data' => $data,
            'assignment' => $assignment,
            'readOnly' => false,
            'submission' => $submission
        ]);
    }

    public function update(Request $request, FormSubmission $submission)
    {
        $data = $request->except(['_token', 'form_action_type']);
        $status = $request->input('form_action_type') === 'submit' ? 'submitted' : 'draft';
        
        $submission->update([
            'data' => json_encode($data),
            'status' => $status,
            'submitted_at' => $status === 'submitted' ? now() : null
        ]);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'status' => $status]);
        } else {
            return redirect()->route('admin.submissions.edit', $submission)->with('success', 'Form updated successfully!');
        }
    }

    public function exportPdf(FormSubmission $submission)
    {
        $data = json_decode($submission->data, true);
        $assignment = $submission->assignment;
        $pdf = Pdf::loadView('headache-questionnaire-pdf', [
            'data' => $data,
            'assignment' => $assignment,
            'readOnly' => true,
            'submission' => $submission
        ])->setPaper('a4');
        return $pdf->download('headache-questionnaire-'.$submission->id.'.pdf');
    }
}
