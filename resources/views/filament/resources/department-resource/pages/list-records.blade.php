<x-filament-panels::page>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        
        .fi-main { 
            background: #ffffff !important;
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }
        
        .departments-container {
            max-width: none;
            margin: 0;
            padding: 2rem;
            width: 100%;
        }
        
        .page-header {
            margin-bottom: 2.5rem;
        }
        
        .page-subtitle {
            color: #64748b;
            font-size: 1.1rem;
            margin: 0;
            font-weight: 500;
        }
        
        .controls-bar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            gap: 1.5rem;
            flex-wrap: wrap;
            background: #f8fafc;
            padding: 1.5rem;
            border-radius: 16px;
            border: 1px solid #e2e8f0;
        }
        
        .search-filters {
            display: flex;
            gap: 1rem;
            align-items: center;
            flex: 1;
        }
        
        .search-box {
            position: relative;
            flex: 1;
            max-width: 400px;
        }
        
        .search-input {
            width: 100%;
            padding: 0.75rem 1rem 0.75rem 2.5rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: #f8fafc;
        }
        
        .search-input:focus {
            outline: none;
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }
        
        .search-icon {
            position: absolute;
            left: 0.75rem;
            top: 50%;
            transform: translateY(-50%);
            color: #64748b;
        }
        
        .filter-btn, .sort-btn {
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            border-radius: 10px;
            background: white;
            color: #64748b;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .filter-btn:hover, .sort-btn:hover {
            border-color: #3b82f6;
            color: #3b82f6;
        }
        
        .create-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            color: white;
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.875rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 2px 8px rgba(59, 130, 246, 0.2);
        }
        
        .create-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .departments-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .department-card {
            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 16px;
            padding: 2rem;
            transition: all 0.3s ease;
            cursor: pointer;
            position: relative;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
        }
        
        .department-card:hover {
            border-color: #3b82f6;
            box-shadow: 0 8px 30px rgba(59, 130, 246, 0.12);
            transform: translateY(-4px);
        }
        
        .department-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }
        
        .department-icon {
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.75rem;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
        }
        
        .department-actions {
            display: flex;
            gap: 0.5rem;
        }
        
        .action-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            background: white;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            color: #64748b;
        }
        
        .action-btn:hover {
            background: #f8fafc;
            border-color: #3b82f6;
            color: #3b82f6;
        }
        
        .department-name {
            font-size: 1.375rem;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 0.75rem;
            line-height: 1.3;
        }
        
        .department-description {
            color: #64748b;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
        
        .department-stats {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
        }
        
        .stat-item {
            text-align: center;
            flex: 1;
        }
        
        .stat-value {
            font-size: 1.5rem;
            font-weight: 800;
            color: #3b82f6;
            margin-bottom: 0.25rem;
        }
        
        .stat-label {
            font-size: 0.8rem;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }
        
        .department-status {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            background: #dcfce7;
            color: #166534;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-dot {
            width: 6px;
            height: 6px;
            background: #16a34a;
            border-radius: 50%;
        }
        
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border: 2px dashed #e2e8f0;
            border-radius: 12px;
        }
        
        .empty-icon {
            font-size: 3rem;
            color: #cbd5e1;
            margin-bottom: 1rem;
        }
        
        .empty-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        
        .empty-description {
            color: #64748b;
            margin-bottom: 2rem;
        }
        
        /* Empty state action styling */
        .empty-actions .fi-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
            color: white !important;
            padding: 0.875rem 1.75rem !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            cursor: pointer;
            transition: all 0.3s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25) !important;
            text-decoration: none !important;
        }
        
        .empty-actions .fi-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35) !important;
        }
        
        .pagination-bar {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            margin-top: 2rem;
            padding: 1rem;
            background: #f8fafc;
            border-radius: 10px;
        }
        
        .results-info {
            color: #64748b;
            font-size: 0.875rem;
        }
        
        /* Custom Create Button Link */
        .create-btn-link {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
            color: white !important;
            padding: 0.875rem 1.75rem !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            cursor: pointer;
            transition: all 0.3s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25) !important;
            text-decoration: none !important;
        }
        
        .create-btn-link:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35) !important;
            color: white !important;
            text-decoration: none !important;
        }
        
        /* Filament Action Button Styling */
        .create-department-actions .fi-btn {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
            color: white !important;
            padding: 0.875rem 1.75rem !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            cursor: pointer;
            transition: all 0.3s ease !important;
            display: flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25) !important;
            text-decoration: none !important;
        }
        
        .create-department-actions .fi-btn:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35) !important;
        }
        
        .create-department-actions .fi-btn-icon {
            width: 16px !important;
            height: 16px !important;
        }
        
        /* Empty state action styling */
        .empty-actions .create-btn-link {
            background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%) !important;
            color: white !important;
            padding: 0.875rem 1.75rem !important;
            border: none !important;
            border-radius: 12px !important;
            font-weight: 700 !important;
            font-size: 0.9rem !important;
            cursor: pointer;
            transition: all 0.3s ease !important;
            display: inline-flex !important;
            align-items: center !important;
            gap: 0.5rem !important;
            box-shadow: 0 4px 12px rgba(59, 130, 246, 0.25) !important;
            text-decoration: none !important;
        }
        
        .empty-actions .create-btn-link:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.35) !important;
            color: white !important;
            text-decoration: none !important;
        }
        
        /* Hide original Filament table */
        .fi-ta {
            display: none !important;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .departments-container {
                padding: 1rem;
            }
            
            .controls-bar {
                flex-direction: column;
                align-items: stretch;
                padding: 1rem;
            }
            
            .search-filters {
                flex-direction: column;
                gap: 1rem;
            }
            
            .departments-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }
        
        @media (min-width: 1400px) {
            .departments-grid {
                grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            }
        }
        
        @media (min-width: 1800px) {
            .departments-grid {
                grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
            }
        }
    </style>

    <div class="departments-container">
        {{-- Page Header --}}
        <!-- <div class="page-header">
            <p class="page-subtitle">Manage your organization's departments efficiently</p>
        </div> -->

        {{-- Controls Bar --}}
        <div class="controls-bar">
            <div class="search-filters">
                <div class="search-box">
                    <input type="text" class="search-input" placeholder="Search departments...">
                    <svg class="search-icon" width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M15.5 14h-.79l-.28-.27a6.5 6.5 0 0 0 1.48-5.34c-.47-2.78-2.79-5-5.59-5.34a6.505 6.505 0 0 0-7.27 7.27c.34 2.8 2.56 5.12 5.34 5.59a6.5 6.5 0 0 0 5.34-1.48l.27.28v.79l4.25 4.25c.41.41 1.08.41 1.49 0 .41-.41.41-1.08 0-1.49L15.5 14zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z"/>
                    </svg>
                </div>
                
                <button class="filter-btn">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 17v2h6v-2H3zM3 5v2h10V5H3zm10 16v-2h8v-2h-8v-2h-2v6h2zM7 9v2H3v2h4v2h2V9H7zm14 4v-2H11v2h10zm-6-4h2V7h4V5h-4V3h-2v6z"/>
                    </svg>
                    Filter
                </button>
                
                <button class="sort-btn">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 18h6v-2H3v2zM3 6v2h18V6H3zm0 7h12v-2H3v2z"/>
                    </svg>
                    Sort
                </button>
            </div>
            
            <div class="create-department-actions">
                <a href="{{ \App\Filament\Resources\DepartmentResource::getUrl('create') }}" 
                   class="create-btn-link">
                    <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                    </svg>
                    New Department
                </a>
            </div>
        </div>

        {{-- Departments Grid --}}
        @if(\App\Models\Department::count() > 0)
            <div class="departments-grid">
                @foreach(\App\Models\Department::all() as $department)
                    <div class="department-card">
                        <div class="department-header">
                            <div class="department-icon">🏢</div>
                        </div>
                        
                        <div class="department-name">{{ $department->name }}</div>
                        <div class="department-description">
                            Specialized treatment for chronic headaches and pain disorders with advanced neurological care.
                        </div>
                        
                        <div class="department-stats">
                            <div class="stat-item">
                                <div class="stat-value">{{ $department->forms()->count() }}</div>
                                <div class="stat-label">Forms</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-value">
                                    {{ \App\Models\Patient::whereIn('id', \App\Models\FormAssignment::whereIn('form_id', $department->forms->pluck('id'))->pluck('patient_id')->unique())->count() }}
                                </div>
                                <div class="stat-label">Patients</div>
                            </div>
                        </div>
                        
                        <div class="department-status">
                            <span class="status-dot"></span>
                            Active
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state">
                <div class="empty-icon">🏢</div>
                <h3 class="empty-title">No Departments Yet</h3>
                <p class="empty-description">Create your first department to get started with organizing your institution.</p>
                <div class="empty-actions">
                    <a href="{{ \App\Filament\Resources\DepartmentResource::getUrl('create') }}" 
                       class="create-btn-link">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M19 13h-6v6h-2v-6H5v-2h6V5h2v6h6v2z"/>
                        </svg>
                        Create First Department
                    </a>
                </div>
            </div>
        @endif

        {{-- Pagination --}}
        @if(\App\Models\Department::count() > 0)
            <div class="pagination-bar">
                <div class="results-info">
                    Showing {{ \App\Models\Department::count() }} departments
                </div>
            </div>
        @endif

        {{-- Hidden Filament Table (for functionality) --}}
        <div style="display: none;">
            {{ $this->table }}
        </div>
    </div>
</x-filament-panels::page>