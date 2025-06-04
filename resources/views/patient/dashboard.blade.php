@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-text">
                <h1 class="dashboard-title">Your Forms</h1>
                <p class="dashboard-subtitle">Manage and track your assigned questionnaires</p>
            </div>
            <div class="header-stats">
                @php
                    $totalForms = $assignments->count();
                    $completedForms = $assignments->filter(function($assignment) {
                        $submission = $assignment->submissions->sortByDesc('updated_at')->first();
                        return $submission && $submission->status === 'submitted';
                    })->count();
                    $draftForms = $assignments->filter(function($assignment) {
                        $submission = $assignment->submissions->sortByDesc('updated_at')->first();
                        return $submission && $submission->status !== 'submitted';
                    })->count();
                    $notStartedForms = $totalForms - $completedForms - $draftForms;
                @endphp
                <div class="stat-card">
                    <div class="stat-number">{{ $totalForms }}</div>
                    <div class="stat-label">Total Forms</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $completedForms }}</div>
                    <div class="stat-label">Completed</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ $draftForms }}</div>
                    <div class="stat-label">In Progress</div>
                </div>
            </div>
        </div>
    </div>

    @if(request()->has('submitted'))
        <div class="success-alert" id="success-alert">
            <div class="alert-content">
                <div class="alert-icon">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="alert-text">
                    <strong>Success!</strong> Your form has been submitted successfully.
                </div>
                <button onclick="document.getElementById('success-alert').remove()" class="alert-close">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    @endif

    <div class="forms-container">
        @forelse($assignments as $assignment)
            @php
                $submission = $assignment->submissions->sortByDesc('updated_at')->first();
                $status = $submission ? ($submission->status === 'submitted' ? 'completed' : 'draft') : 'not-started';
                $actionLabel = $status === 'completed' ? 'View Results' : ($status === 'draft' ? 'Continue' : 'Start');
                $actionUrl = route('assigned.form', $assignment);
                
                $statusLabels = [
                    'completed' => 'Completed',
                    'draft' => 'In Progress',
                    'not-started' => 'Not Started'
                ];
                
                $progressPercentage = $status === 'completed' ? 100 : ($status === 'draft' ? 65 : 0);
                
                // Calculate days since assignment or last update
                $lastActivity = $submission ? $submission->updated_at : $assignment->created_at;
                $daysSince = now()->diffInDays($lastActivity);
            @endphp
            
            <div class="form-card {{ $status }}">
                <div class="form-card-header">
                    <div class="form-info">
                        <h3 class="form-title">{{ $assignment->form->name }}</h3>
                        <div class="form-meta">
                            <span class="form-type">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Questionnaire
                            </span>
                            <span class="form-activity">
                                @if($daysSince === 0)
                                    Updated today
                                @elseif($daysSince === 1)
                                    Updated yesterday
                                @else
                                    Updated {{ $daysSince }} days ago
                                @endif
                            </span>
                        </div>
                    </div>
                    
                    <div class="status-badge status-{{ $status }}">
                        @if($status === 'completed')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @elseif($status === 'draft')
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        @endif
                        {{ $statusLabels[$status] }}
                    </div>
                </div>

                <div class="form-progress">
                    <div class="progress-label">
                        <span>Progress</span>
                        <span>{{ $progressPercentage }}%</span>
                    </div>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $progressPercentage }}%"></div>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ $actionUrl }}" class="action-btn primary">
                        {{ $actionLabel }}
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    
                    @if($status === 'completed')
                        <button class="action-btn secondary" onclick="downloadResults('{{ $assignment->id }}')">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download
                        </button>
                    @endif
                </div>
            </div>
        @empty
            <div class="empty-state">
                <div class="empty-icon">
                    <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="empty-title">No forms assigned yet</h3>
                <p class="empty-description">You'll see your assigned questionnaires here when they become available.</p>
            </div>
        @endforelse
    </div>
</div>

<style>
    .dashboard-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #00a3c4 0%, #0077a3 100%);
        padding: 0;
        margin: 0;
    }

    .dashboard-header {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 2rem 0;
    }

    .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 2rem;
    }

    .header-text {
        color: white;
    }

    .dashboard-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        letter-spacing: -0.02em;
    }

    .dashboard-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
    }

    .header-stats {
        display: flex;
        gap: 1.5rem;
        flex-wrap: wrap;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.15);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        color: white;
        min-width: 100px;
    }

    .stat-number {
        font-size: 2rem;
        font-weight: 700;
        line-height: 1;
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }

    .success-alert {
        max-width: 1200px;
        margin: 2rem auto 0;
        padding: 0 2rem;
    }

    .alert-content {
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .alert-icon {
        color: #059669;
        flex-shrink: 0;
    }

    .alert-text {
        color: #065f46;
        flex: 1;
    }

    .alert-close {
        color: #065f46;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0.25rem;
        border-radius: 4px;
        transition: background-color 0.2s;
    }

    .alert-close:hover {
        background: rgba(5, 150, 105, 0.1);
    }

    .forms-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
        gap: 2rem;
    }

    .form-card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.3s ease;
        border: 1px solid rgba(0, 0, 0, 0.05);
        position: relative;
        overflow: hidden;
    }

    .form-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        transition: background-color 0.3s ease;
    }

    .form-card.completed::before {
        background: linear-gradient(90deg, #10b981, #059669);
    }

    .form-card.draft::before {
        background: linear-gradient(90deg, #f59e0b, #d97706);
    }

    .form-card.not-started::before {
        background: linear-gradient(90deg, #6b7280, #4b5563);
    }

    .form-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    .form-card-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 1.5rem;
        gap: 1rem;
    }

    .form-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
        margin: 0 0 0.5rem 0;
        line-height: 1.4;
    }

    .form-meta {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .form-type, .form-activity {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .status-badge {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
        white-space: nowrap;
    }

    .status-completed {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }

    .status-draft {
        background: #fef3c7;
        color: #d97706;
        border: 1px solid #fcd34d;
    }

    .status-not-started {
        background: #f3f4f6;
        color: #6b7280;
        border: 1px solid #d1d5db;
    }

    .form-progress {
        margin-bottom: 2rem;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
        color: #6b7280;
    }

    .progress-bar {
        height: 8px;
        background: #f3f4f6;
        border-radius: 4px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #00a3c4, #0077a3);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
    }

    .action-btn.primary {
        background: linear-gradient(135deg, #00a3c4 0%, #0077a3 100%);
        color: white;
        box-shadow: 0 2px 4px rgba(0, 163, 196, 0.4);
    }

    .action-btn.primary:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0, 163, 196, 0.6);
    }

    .action-btn.secondary {
        background: #f8fafc;
        color: #475569;
        border: 1px solid #e2e8f0;
    }

    .action-btn.secondary:hover {
        background: #f1f5f9;
        border-color: #cbd5e1;
    }

    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }

    .empty-icon {
        color: #9ca3af;
        margin-bottom: 1.5rem;
        display: flex;
        justify-content: center;
    }

    .empty-title {
        font-size: 1.5rem;
        font-weight: 600;
        color: #374151;
        margin: 0 0 1rem 0;
    }

    .empty-description {
        color: #6b7280;
        margin: 0;
        font-size: 1rem;
    }

    @media (max-width: 768px) {
        .dashboard-title {
            font-size: 2rem;
        }

        .header-content {
            flex-direction: column;
            text-align: center;
        }

        .header-stats {
            justify-content: center;
        }

        .forms-container {
            grid-template-columns: 1fr;
            padding: 1rem;
        }

        .form-card-header {
            flex-direction: column;
            align-items: flex-start;
        }

        .status-badge {
            align-self: flex-start;
        }

        .form-actions {
            flex-direction: column;
        }

        .action-btn {
            justify-content: center;
        }
    }
</style>

<script>
    function downloadResults(assignmentId) {
        // Add your download functionality here
        console.log('Downloading results for assignment:', assignmentId);
        // Example: window.location.href = `/assignments/${assignmentId}/download`;
    }

    // Auto-hide success alert after 5 seconds
    document.addEventListener('DOMContentLoaded', function() {
        const alert = document.getElementById('success-alert');
        if (alert) {
            setTimeout(() => {
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.remove(), 300);
            }, 5000);
        }
    });
</script>
@endsection