<x-filament-panels::page>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap');
        
        .dashboard-card {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        }
        
        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.6s ease-in-out;
        }
        
        .dashboard-card:hover::before {
            left: 100%;
        }
        
        .dashboard-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.4);
        }
        
        .card-title {
            font-weight: 600;
            letter-spacing: 0.025em;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        }
        
        .card-number {
            font-weight: 800;
            letter-spacing: -0.025em;
            text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover .card-number {
            transform: scale(1.1);
            text-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }
        
        .card-icon {
            position: absolute;
            top: 1rem;
            right: 1rem;
            opacity: 0.3;
            font-size: 2rem;
            transition: all 0.3s ease;
        }
        
        .dashboard-card:hover .card-icon {
            opacity: 0.6;
            transform: rotate(10deg) scale(1.1);
        }
    </style>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
        <a href="/admin/patients" class="dashboard-card rounded-xl shadow-lg p-8 text-center flex flex-col justify-center cursor-pointer" style="background: linear-gradient(135deg, #00a3c4 0%, #0077a3 100%); color: #fff; text-decoration: none; height: 10em;">
            <div class="card-icon">👥</div>
            <h3 class="card-title text-xl mb-3">Total Patients</h3>
            <p class="card-number text-5xl font-bold">{{ \App\Models\Patient::count() ?? 0 }}</p>
        </a>
        
        <a href="/admin/forms" class="dashboard-card rounded-xl shadow-lg p-8 text-center flex flex-col justify-center cursor-pointer" style="background: linear-gradient(135deg, #22d3ee 0%, #00a3c4 100%); color: #fff; text-decoration: none; height: 10em;">
            <div class="card-icon">📋</div>
            <h3 class="card-title text-xl mb-3">Active Forms</h3>
            <p class="card-number text-5xl font-bold">{{ \App\Models\Form::count() ?? 0 }}</p>
        </a>
        
        <a href="/admin/form-submissions" class="dashboard-card rounded-xl shadow-lg p-8 text-center flex flex-col justify-center cursor-pointer" style="background: linear-gradient(135deg, #0077a3 0%, #083344 100%); color: #fff; text-decoration: none; height: 10em;">
            <div class="card-icon">📊</div>
            <h3 class="card-title text-xl mb-3">Submissions</h3>
            <p class="card-number text-5xl font-bold">{{ \App\Models\FormSubmission::count() ?? 0 }}</p>
        </a>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <a href="/admin/departments" class="dashboard-card rounded-xl shadow-lg p-8 text-center flex flex-col justify-center cursor-pointer" style="background: linear-gradient(135deg, #00c4b4 0%, #0077a3 100%); color: #fff; text-decoration: none; height: 10em;">
            <div class="card-icon">🏢</div>
            <h3 class="card-title text-xl mb-3">Total Departments</h3>
            <p class="card-number text-5xl font-bold">{{ \App\Models\Department::count() ?? 0 }}</p>
        </a>
        
        <a href="/admin/users" class="dashboard-card rounded-xl shadow-lg p-8 text-center flex flex-col justify-center cursor-pointer" style="background: linear-gradient(135deg, #00a3c4 0%, #005f82 100%); color: #fff; text-decoration: none; height: 10em;">
            <div class="card-icon">👤</div>
            <h3 class="card-title text-xl mb-3">Total Users</h3>
            <p class="card-number text-5xl font-bold">{{ \App\Models\User::count() ?? 0 }}</p>
        </a>
    </div>
</x-filament-panels::page>