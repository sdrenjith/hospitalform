<x-guest-layout>
    <!-- Custom TBI Styling -->
    <style>
        /* Clean white background */
        html, body {
            background: #ffffff !important;
            min-height: 100vh !important;
            margin: 0 !important;
            padding: 0 !important;
            font-family: 'Instrument Sans', system-ui, sans-serif !important;
        }

        /* Ensure the main app container also has white background */
        #app, .min-h-screen {
            background: #ffffff !important;
            min-height: 100vh !important;
        }

        /* Remove background pattern overlay since we want clean white */
        body::before {
            display: none;
        }

        /* Main container styling */
        .min-h-screen {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        /* Card container with TBI blue gradient background */
        .w-full {
            background: linear-gradient(135deg, #00a3c4 0%, #0077a3 100%) !important;
            backdrop-filter: blur(20px) !important;
            -webkit-backdrop-filter: blur(20px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 20px !important;
            box-shadow: 
                0 25px 50px -12px rgba(0, 163, 196, 0.4),
                0 8px 32px -8px rgba(0, 163, 196, 0.3),
                0 0 0 1px rgba(255, 255, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
            max-width: 450px !important;
            padding: 3rem !important;
            position: relative !important;
            overflow: hidden !important;
            margin: 2rem auto !important;
        }

        /* Add subtle pattern overlay to the card */
        .w-full::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: 
                radial-gradient(circle at 20% 20%, rgba(255,255,255,0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(255,255,255,0.05) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        /* Remove the pseudo-element logo */
        .w-full::before {
            display: none !important;
        }

        /* Title styling for blue card background */
        .w-full > h1,
        .w-full > div:first-child h1 {
            content: 'Welcome to TBI';
            position: absolute;
            top: 1.5rem;
            left: 50%;
            transform: translateX(-50%);
            color: #ffffff !important;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            width: 100%;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        /* Override the ::after pseudo element for title since we need proper text */
        .w-full {
            position: relative;
        }

        /* Custom title styling */
        .w-full > *:first-child {
            position: relative;
            z-index: 2;
        }

        /* Form styling adjustments */
        form {
            margin-top: 2rem;
        }

        /* Label styling for white background */
        label {
            color: #0077a3 !important;
            font-weight: 600 !important;
            font-size: 0.875rem !important;
            margin-bottom: 0.5rem !important;
            text-shadow: none !important;
        }

        /* Input styling for blue card background */
        input[type="email"],
        input[type="password"],
        input[type="text"] {
            background: rgba(255, 255, 255, 0.95) !important;
            border: 2px solid rgba(255, 255, 255, 0.3) !important;
            border-radius: 12px !important;
            color: #374151 !important;
            padding: 1rem !important;
            font-size: 1rem !important;
            transition: all 0.3s ease !important;
            width: 100% !important;
            box-shadow: 
                0 2px 8px rgba(0, 0, 0, 0.1),
                inset 0 1px 2px rgba(0, 0, 0, 0.05);
            position: relative;
            z-index: 2;
        }

        input[type="email"]::placeholder,
        input[type="password"]::placeholder,
        input[type="text"]::placeholder {
            color: rgba(107, 114, 128, 0.7) !important;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus {
            outline: none !important;
            border-color: rgba(255, 255, 255, 0.6) !important;
            background: rgba(255, 255, 255, 1) !important;
            box-shadow: 
                0 0 0 3px rgba(255, 255, 255, 0.2), 
                0 4px 12px rgba(0, 0, 0, 0.15),
                inset 0 1px 2px rgba(0, 0, 0, 0.05) !important;
            ring: none !important;
        }

        /* Checkbox styling for white background */
        input[type="checkbox"] {
            background: rgba(255, 255, 255, 0.9) !important;
            border: 2px solid rgba(0, 163, 196, 0.3) !important;
            border-radius: 4px !important;
            width: 1.25rem !important;
            height: 1.25rem !important;
        }

        input[type="checkbox"]:checked {
            background: #00a3c4 !important;
            border-color: #0077a3 !important;
        }

        /* Remember me text for white background */
        .text-sm.text-gray-600,
        .ms-2.text-sm.text-gray-600 {
            color: #fff !important;
            text-shadow: none !important;
        }

        /* Forgot password link for white background */
        .underline.text-sm.text-gray-600 {
            color: #fff !important;
            text-decoration: none !important;
            transition: color 0.2s ease !important;
            text-shadow: none !important;
        }

        .underline.text-sm.text-gray-600:hover {
            color: #0077a3 !important;
            text-decoration: underline !important;
        }

        /* Primary button styling for white background */
        .inline-flex.items-center,
        button[type="submit"] {
            background: linear-gradient(135deg, #00a3c4 0%, #0077a3 100%) !important;
            border: 2px solid transparent !important;
            color: #ffffff !important;
            padding: 1rem 2rem !important;
            border-radius: 12px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            backdrop-filter: none !important;
            text-transform: none !important;
            font-size: 1rem !important;
            box-shadow: 0 4px 12px -2px rgba(0, 163, 196, 0.3);
        }

        .inline-flex.items-center:hover,
        button[type="submit"]:hover {
            background: linear-gradient(135deg, #0077a3 0%, #005f82 100%) !important;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px -4px rgba(0, 163, 196, 0.4) !important;
        }

        .inline-flex.items-center:active,
        button[type="submit"]:active {
            transform: translateY(0);
        }

        /* Error message styling */
        .text-sm.text-red-600 {
            color: #fecaca !important;
            background: rgba(239, 68, 68, 0.1);
            padding: 0.5rem;
            border-radius: 8px;
            border-left: 3px solid #ef4444;
        }

        /* Session status styling */
        .mb-4 {
            background: rgba(34, 197, 94, 0.1) !important;
            border: 1px solid rgba(34, 197, 94, 0.3) !important;
            color: #bbf7d0 !important;
            padding: 1rem !important;
            border-radius: 12px !important;
            backdrop-filter: blur(10px);
        }

        /* Spacing adjustments */
        .mt-4 {
            margin-top: 1.5rem !important;
        }

        .mt-1 {
            margin-top: 0.5rem !important;
        }

        .mt-2 {
            margin-top: 0.75rem !important;
        }

        /* Responsive adjustments */
        @media (max-width: 640px) {
            .min-h-screen {
                padding: 1rem;
            }
            
            .w-full {
                padding: 2rem !important;
                max-width: 100%;
            }
            
            .w-full::after {
                font-size: 1.25rem;
            }
        }

        /* Focus states for better accessibility */
        *:focus {
            outline: none !important;
        }

        /* Add subtle animation to form elements */
        .w-full > * {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(20px);
        }

        .w-full > *:nth-child(1) { animation-delay: 0.1s; }
        .w-full > *:nth-child(2) { animation-delay: 0.2s; }
        .w-full > *:nth-child(3) { animation-delay: 0.3s; }
        .w-full > *:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Add floating effect to inputs */
        input:focus {
            transform: translateY(-2px);
        }

        /* Custom styling for the flex container */
        .flex.items-center.justify-end {
            gap: 1rem;
            flex-wrap: wrap;
        }

        @media (max-width: 640px) {
            .flex.items-center.justify-end {
                flex-direction: column;
                align-items: stretch;
            }
            
            .inline-flex.items-center {
                justify-content: center;
                width: 100%;
            }
        }

        /* Add TBI subtitle */
        form::before {
            content: '';
            display: block;
            text-align: center;
            color: #ffffff !important;
            font-size: 1rem;
            margin-bottom: 2rem;
            font-weight: 500;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
        }

        /* Force all text to be white */
        .w-full, .w-full * {
            color: #ffffff !important;
        }

        /* Override any dark text */
        .text-gray-900, .text-black, .text-gray-800, .text-gray-700 {
            color: #ffffff !important;
        }

        /* Ensure proper contrast for all elements */
        * {
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }
    </style>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Logo at the top of the card -->
    <div style="display: flex; justify-content: center; align-items: center; margin-bottom: 1.5rem;">
        <img src="/logo.png" alt="Texas Brain Institute Logo" style="height: 80px; width: auto; border-radius: 10%; box-shadow: 0 8px 16px -4px rgba(0,0,0,0.1); background: #fff; padding: 8px;" />
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email Address')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" 
                            placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>