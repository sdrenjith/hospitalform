@extends('layouts.app')

@section('content')
@if (!empty($pdfMode))
    @php $isPdf = true; @endphp
@else
    @php $isPdf = false; @endphp
@endif
<style>
    /* Viewport and base optimizations */
    * {
        box-sizing: border-box;
    }
    
    /* Viewport and base optimizations */
    html {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    
    body {
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
    }
    
    .pdf-font { font-family: Arial, Helvetica, sans-serif; font-size: 13px; }
    body, .pdf-form-container, .pdf-header-row, .pdf-header-col, .pdf-header-center, .pdf-header-logo, .pdf-header-contact, .pdf-header-label, .pdf-header-title, .pdf-header-sub, .pdf-important, .pdf-patient-row, .pdf-patient-label, .pdf-patient-blank, .pdf-patient-blank-short, .pdf-form-section, .pdf-form-table, .pdf-form-label, .pdf-form-input, .pdf-form-logo, .pdf-form-diagram {
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-form-container {
        background: #fff;
        border: 1.5px solid #e0e0e0;
        border-radius: 10px;
        box-shadow: 0 2px 12px #0001;
        padding: 0 36px 32px 36px;
        margin: 0 auto 0 auto;
        width: 78%;
        min-width: 340px;
        max-width: 1100px;
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
    .pdf-header-row, .pdf-header-center, .pdf-header-col {
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-header-title {
        font-size: 1.6rem;
        font-weight: bold;
        margin-bottom: 0;
        margin-top: 32px;
        letter-spacing: 0.5px;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-header-sub {
        font-size: 0.95rem;
        margin-bottom: 10px;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-header-logo img {
        height: 85px;
        width: auto;
        margin-bottom: 2px;
        margin-top: 0;
        display: block;
    }
    .pdf-header-logo {
        align-items: flex-start;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 0;
        margin-bottom: 0;
    }
    .pdf-header-col {
        padding: 0 0 0 0;
        margin: 0;
    }
    .pdf-header-contact {
        font-size: 13px;
        margin-bottom: 2px;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-header-label {
        font-weight: bold;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-important {
        background: #e3f3fa;
        border: 1.5px solid #b5d6e6;
        color: #222;
        padding: 10px 14px;
        border-radius: 4px;
        margin: 18px 0 18px 0;
        font-size: 1rem;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-important b { font-weight: bold; }
    .pdf-important .blue { color: #1976d2; font-weight: bold; }
    .pdf-patient-row {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 18px;
        margin-bottom: 18px;
        font-size: 1rem;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-patient-label { min-width: 120px; font-weight: normal; }
    .pdf-patient-blank {
        border-bottom: 1px solid #222;
        min-width: 120px;
        display: inline-block;
        height: 1.2em;
        margin: 0 8px;
    }
    .pdf-patient-blank-short {
        border-bottom: 1px solid #222;
        min-width: 70px;
        display: inline-block;
        height: 1.2em;
        margin: 0 8px;
    }
    .pdf-form-section { margin-bottom: 22px; }
    .pdf-form-table td, .pdf-form-table th {
        padding: 8px 6px !important;
        line-height: 1.7;
        border: 1px solid #333;
        font-size: 1rem;
    }
    .pdf-form-table tr {
        border-bottom: 1px solid #e0e0e0;
    }
    .pdf-form-label { font-weight: bold; margin-bottom: 6px; display: block; }
    .pdf-form-input { margin-bottom: 10px; }
    .pdf-form-logo { margin-bottom: 10px; }
    .pdf-form-diagram { margin-bottom: 18px; margin-top: 8px; }
    .fixed-top { position: fixed; top: 0; left: 0; right: 0; z-index: 1000; }
    
    /* Header Layout - Desktop */
    .pdf-header-row {
        margin-top: 32px;
        margin-bottom: 0;
        padding: 0;
        padding-top: 32px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: flex-start;
    }
    .pdf-header-col {
        flex: 1;
        padding: 0 8px;
    }
    .pdf-header-logo {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: flex-start;
        min-width: 200px;
        margin-top: 0;
        margin-bottom: 0;
    }
    
    /* Desktop: Keep original 4-column layout */
    .pdf-header-addresses {
        display: contents;
    }
    .pdf-header-contact-logo {
        display: contents;
    }
    .pdf-header-logo .tbi-title {
        font-size: 1.7rem;
        font-weight: 400;
        letter-spacing: 2px;
        margin-top: 18px;
        margin-bottom: 8px;
    }
    .pdf-header-logo .tbi-sub {
        font-size: 1.05rem;
        margin-top: 0;
        margin-bottom: 12px;
    }
    
    /* Patient info row below blue box */
    .pdf-patient-row {
        margin-top: 18px;
        margin-bottom: 0;
        gap: 20px;
        font-size: 1.05rem;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
    }
    
    /* Desktop: Keep all fields in one row with reduced spacing */
    .patient-name-row {
        display: flex;
        flex-direction: row;
        gap: 20px;
    }
    
    .patient-name-row > div {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 6px;
    }
    
    .patient-dob-mrn {
        display: flex;
        flex-direction: row;
        gap: 20px;
    }
    
    .patient-dob-mrn > div {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 6px;
    }
    
    .pdf-patient-row label {
        font-weight: normal;
        margin-right: 4px;
        white-space: nowrap;
    }
    
    .pdf-patient-row input[type="text"],
    .pdf-patient-row input[type="date"] {
        border: none;
        border-bottom: 1.5px solid #222;
        background: transparent;
        outline: none;
        padding: 0 0 2px 0;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.05rem;
    }
    
    /* Specific widths for desktop to fit properly */
    .patient-name-row input[type="text"] {
        width: 140px;
    }
    
    .patient-dob-mrn input[type="date"] {
        width: 160px;
    }
    
    .patient-dob-mrn input[type="text"] {
        width: 100px;
    }
    .pdf-patient-row input[type="text"] {
        border: none;
        border-bottom: 1.5px solid #222;
        background: transparent;
        outline: none;
        min-width: 120px;
        font-size: 1.05rem;
        padding: 0 0 2px 0;
        margin-right: 18px;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .pdf-table th, .pdf-table td { border: 1px solid #333; padding: 2px 6px; }
    .diagram-container { position: relative; display: inline-block; width: 100%; }
    .pain-label { 
        position: absolute; 
        background: none; 
        color: #222; 
        border-radius: 4px; 
        font-size: 12px; 
        pointer-events: none;
        /* Remove fixed width/height - these are now set dynamically by JavaScript */
        display: flex;
        align-items: center;
        justify-content: center;
        /* Ensure no margin/padding that could affect positioning */
        margin: 0;
        padding: 0;
        /* Ensure no border that could affect positioning */
        border: none;
        /* Prevent any text selection or other interactions */
        user-select: none;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
    }
    
    /* Ensure the pain-label SVGs are perfectly centered */
    .pain-label svg {
        display: block;
        margin: 0;
        padding: 0;
    }
    
    /* CSS for loading spinner animation */
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Save status container */
    #save-status {
        animation: slideDown 0.3s ease-out;
        margin: 20px 0 !important;
    }

    /* Ensure loading messages are visible on mobile */
    @media (max-width: 768px) {
        #save-status {
            margin: 16px 0 !important;
            font-size: 0.95rem !important;
        }
        
        #save-status div[style*="padding"] {
            padding: 12px 14px !important;
        }
    }

    /* Make sure the save status is positioned properly */
    .pdf-form-container #save-status {
        position: relative;
        z-index: 10;
        max-width: 100%;
        box-sizing: border-box;
    }
    
    .pdf-header-bold { font-weight: bold; }
    .pdf-patient-row { display: flex; flex-direction: row; align-items: center; gap: 18px; margin-bottom: 18px; font-size: 1rem; }
    .pdf-patient-row input[type="text"] {
        border: none;
        border-bottom: 1.5px solid #222;
        background: transparent;
        outline: none;
        min-width: 120px;
        font-size: 1.05rem;
        padding: 0 0 2px 0;
        margin-right: 18px;
        font-family: Arial, Helvetica, sans-serif !important;
    }
    .scale-btn {
        min-width: 28px;
        height: 28px;
        line-height: 28px;
        font-size: 1rem;
        border-radius: 5px;
        margin: 0 2px;
        padding: 0 0.3em;
        border: 1.5px solid #ddd;
        background: #fff;
        color: #333;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.2s ease;
    }
    .scale-btn.selected, .scale-btn input[type=radio]:checked + label {
        background: #222;
        color: #fff;
        border-color: #222;
    }
    .scale-btn input[type=radio] {
        display: none;
    }
    .scale-btn:hover {
        background: #f0f0f0;
        border-color: #999;
    }
    .scale-btn.selected:hover {
        background: #222;
        border-color: #222;
    }
    .scale-row {
        gap: 4px;
        margin: 4px 0 4px 0;
    }
    .scale-table td {
        padding: 6px 0 !important;
    }
    .pdf-form-section.pain-scale-section {
        margin-left: auto;
        margin-right: auto;
        max-width: 900px;
    }
    
    /* Desktop: Hide mobile sections */
    .pain-scale-section .mobile-stacked-sections {
        display: none;
    }
    .form-actions {
        margin-bottom: 0 !important;
    }
    html, body {
        height: 100%;
        background: #fff;
        margin: 0;
        padding: 0;
    }
    /* Remove extra space after form */
    #app, main, .container, .content, .wrapper {
        margin-bottom: 0 !important;
        padding-bottom: 0 !important;
    }
    .pain-consistency-label {
        color: #222 !important;
    }
    .pdf-form-table .question-num {
        width: 36px;
        min-width: 28px;
        max-width: 44px;
        text-align: center;
        font-weight: bold;
        font-size: 1.05rem;
        background: #fafbfc;
        border-right: 1px solid #333;
    }
    input[type="date"] {
        min-width: 120px;
        max-width: 180px;
        font-size: 1.05rem;
        padding: 2px 8px;
        border: 1.5px solid #888;
        border-radius: 4px;
        background: #fafbfc;
        color: #222;
        font-family: Arial, Helvetica, sans-serif;
        transition: border 0.2s;
    }
    input[type="date"]:focus {
        border: 1.5px solid #1976d2;
        outline: none;
        background: #e3f3fa;
    }
    /* Ensure calendar icon is visible and clickable */
    input[type="date"]::-webkit-calendar-picker-indicator {
        filter: invert(0.3) sepia(1) saturate(5) hue-rotate(180deg);
        cursor: pointer;
        opacity: 1;
        padding: 2px;
        margin-left: 2px;
    }
    
    /* Mobile-specific date input styling */
    @media (max-width: 768px) {
        input[type="date"] {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            touch-action: manipulation;
            pointer-events: auto;
        }
        
        input[type="date"]::-webkit-calendar-picker-indicator {
            opacity: 1 !important;
            pointer-events: auto !important;
            cursor: pointer !important;
            padding: 4px !important;
            margin-left: 4px !important;
            background: none !important;
            color: #333 !important;
            filter: none !important;
        }
        
        .pain-label {
            /* All sizing is now handled by JavaScript for consistency */
            font-size: 8px;
        }
    }
    
    /* Tablet Responsive - 768px to 1024px */
    @media (max-width: 1024px) and (min-width: 769px) {
        .pdf-form-container {
            width: 95%;
            padding: 0 3vw 32px 3vw;
        }
        .pdf-header-row {
            gap: 16px;
        }
        .pdf-header-col {
            padding: 0 4px;
        }
        .pdf-header-logo {
            min-width: 180px;
        }
        .pdf-header-logo img {
            height: 75px;
        }
    }
    
    /* Mobile Landscape - 768px and below */
    @media (max-width: 768px) {
        .pdf-form-container {
            width: 100%;
            padding: 0 4vw 24px 4vw;
            min-width: unset;
            max-width: 100vw;
            box-sizing: border-box;
        }
        
        /* Header responsive layout */
        .pdf-header-row {
            flex-direction: column;
            align-items: stretch;
            gap: 20px;
            padding-top: 20px;
        }
        
        .pdf-header-addresses {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            width: 100%;
        }
        
        .pdf-header-col {
            padding: 0;
            flex: unset;
        }
        
        .pdf-header-contact-logo {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-top: 16px;
        }
        
        .pdf-header-contact {
            flex: 1;
        }
        
        .pdf-header-logo {
            align-items: flex-end;
            min-width: unset;
            margin-left: 16px;
        }
        
        .pdf-header-logo img {
            height: 65px;
        }
        
        /* Better typography for mobile */
        .pdf-header-col {
            font-size: 0.95rem;
            line-height: 1.4;
        }
        
        /* Improve form title readability */
        .pdf-header-title, .form-title {
            font-size: 1.4rem !important;
            text-align: center;
            margin: 20px 0 !important;
        }
        
        /* Better spacing for important notice */
        .pdf-important {
            margin: 16px 0 !important;
            padding: 12px 16px !important;
            font-size: 0.95rem !important;
        }
        
        /* Improve touch targets for checkboxes and radio buttons */
        input[type="checkbox"], input[type="radio"] {
            min-width: 18px !important;
            min-height: 18px !important;
            margin-right: 8px !important;
        }
        
        label {
            padding: 8px 4px !important;
            cursor: pointer;
        }
        
        /* Patient info fields at top of form - mobile responsive */
        .pdf-patient-row {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            gap: 10px 2%;
            width: 100%;
        }
        .pdf-patient-row > div {
            flex: 1 1 48%;
            max-width: 100%;
            min-width: 0;
            box-sizing: border-box;
        }
        .patient-dob-mrn {
            flex-basis: 100%;
            max-width: 100%;
            width: 100%;
            display: flex !important;
            flex-direction: row !important;
            gap: 2%;
            margin-top: 0;
        }
        .patient-dob-mrn > div {
            flex: 1 1 48%;
            max-width: 48%;
            min-width: 0;
            box-sizing: border-box;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .pdf-patient-row input[type="text"],
        .pdf-patient-row input[type="date"] {
            width: 100%;
            max-width: 100%;
            min-width: 0;
        }
        .pdf-form-table, .pdf-form-table th, .pdf-form-table td {
            font-size: 0.98rem !important;
            padding: 6px 2px !important;
        }
        
        /* FIXED: Pain Scale Section Mobile CSS */
        .pdf-form-section.pain-scale-section {
            max-width: 100% !important;
            overflow-x: hidden !important;
            margin: 0 auto !important;
            padding: 0 !important;
            width: 100% !important;
        }
        
        .pain-scale-section table {
            width: 100% !important;
            max-width: 100% !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
        }
        
        .pain-scale-section td {
            font-size: 0.9rem !important;
            padding: 6px 2px !important;
            text-align: center !important;
            overflow: hidden !important;
            word-wrap: break-word !important;
        }
        
        /* Pain consistency checkboxes mobile styling */
        .pain-consistency-label {
            color: #222 !important;
            font-size: 0.8rem !important;
            display: inline-block !important;
            margin: 0 6px !important;
            white-space: nowrap !important;
        }
        
        /* Ensure checkbox spacing on mobile */
        .pain-scale-section input[type="checkbox"] {
            margin-right: 4px !important;
            margin-left: 2px !important;
            transform: scale(0.9) !important;
        }
        
        .diagram-container, #diagram-container {
            width: 100% !important;
            max-width: 100vw !important;
            min-width: 0 !important;
        }
        #head-diagram {
            width: 100% !important;
            max-width: 100vw !important;
            height: auto !important;
        }
        .pain-symbol {
            min-width: 80px !important;
            padding: 6px 8px 6px 8px !important;
            font-size: 0.95rem !important;
        }
        .scale-btn {
            min-width: 22px !important;
            height: 22px !important;
            font-size: 0.8rem !important;
            margin: 0 1px !important;
            padding: 0 !important;
            border: 1.5px solid #ddd !important;
            background: #fff !important;
            color: #333 !important;
            border-radius: 4px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            font-weight: bold !important;
            line-height: 1 !important;
        }
        
        .scale-btn.selected,
        .scale-btn input[type=radio]:checked + label {
            background: #222 !important;
            color: #fff !important;
            border-color: #222 !important;
        }
        
        .scale-btn input[type=radio] {
            display: none !important;
        }
        
        /* Pain scale table mobile optimization */
        .pain-scale-section table {
            font-size: 0.9rem !important;
        }
        
        .scale-row td {
            padding: 6px 2px !important;
            text-align: center !important;
        }
        
        /* Reduce title font size and spacing */
        .pain-scale-section table tr:first-child td {
            font-size: 0.85rem !important;
            padding: 6px 4px !important;
            line-height: 1.2 !important;
        }
        
        /* Adjust split headers for mobile */
        .pain-scale-section .desktop-split-header td {
            font-size: 0.8rem !important;
            padding: 4px 2px !important;
            line-height: 1.1 !important;
        }
        
        /* Make consistency section wrap better */
        .pain-scale-section tr:last-child td {
            text-align: center !important;
            padding: 8px 2px !important;
        }
        
        .pain-scale-section tr:last-child span {
            display: inline-block !important;
            margin: 2px 3px !important;
            font-size: 0.8rem !important;
        }
        
        canvas#sig-canvas, canvas#assist-sig-canvas {
            width: 100% !important;
            max-width: 480px !important;
            min-width: 160px !important;
            height: 90px !important;
            display: block;
            margin: 0 auto;
        }
        .form-actions {
            flex-direction: column !important;
            gap: 12px !important;
            margin: 24px 0 0 0 !important;
            align-items: stretch !important;
        }
        .form-actions button, .form-actions .action-btn {
            width: 100% !important;
            min-width: 0 !important;
            font-size: 1.1rem !important;
            padding: 12px 0 !important;
            margin: 0 !important;
            border-radius: 8px !important;
        }
    }
    
    /* Mobile Portrait - 600px and below */
    @media (max-width: 600px) {
        .pdf-form-container {
            width: 100%;
            padding: 0 3vw 12px 3vw;
            max-width: 100vw;
            box-sizing: border-box;
        }
        
        /* Stack header elements vertically on small screens */
        .pdf-header-addresses {
            grid-template-columns: 1fr;
            gap: 16px;
        }
        
        .pdf-header-contact-logo {
            flex-direction: column;
            gap: 16px;
            align-items: stretch;
        }
        
        .pdf-header-logo {
            align-items: center;
            margin-left: 0;
        }
        
        .pdf-header-logo img {
            height: 55px;
        }
        
        /* Enhanced mobile typography */
        .pdf-header-col {
            font-size: 0.9rem;
            line-height: 1.3;
        }
        
        /* Better mobile form title */
        .form-title-container {
            text-align: center;
            margin: 20px 0;
        }
        
        .form-title-container > div:first-child {
            font-size: 1.2rem !important;
            margin-bottom: 8px !important;
        }
        
        .form-title-container > div:last-child {
            font-size: 0.85rem !important;
        }
        
        /* Optimize important notice for mobile */
        .pdf-important {
            margin: 14px 0 !important;
            padding: 10px 14px !important;
            font-size: 0.9rem !important;
            line-height: 1.4 !important;
        }
        
        /* Better mobile input styling */
        input[type="text"], input[type="date"] {
            font-size: 16px !important; /* Prevents zoom on iOS */
            padding: 8px 4px !important;
        }
        
        /* Enhanced touch targets */
        input[type="checkbox"], input[type="radio"] {
            min-width: 20px !important;
            min-height: 20px !important;
            margin-right: 10px !important;
        }
        
        label {
            padding: 10px 6px !important;
            cursor: pointer;
            display: inline-block;
            line-height: 1.3;
        }
        
        .pdf-form-label {
            font-size: 1.05rem !important;
        }
        .pdf-form-section {
            margin-bottom: 12px !important;
        }
        .pdf-form-table, .pdf-form-table th, .pdf-form-table td {
            font-size: 0.92rem !important;
            padding: 4px 1px !important;
        }
        .pain-symbol {
            min-width: 60px !important;
            font-size: 0.85rem !important;
        }
        
        /* FIXED: Even more compact pain scale for small mobile */
        .pdf-form-section.pain-scale-section {
            margin: 0 !important;
            padding: 0 !important;
        }
        
        .pain-scale-section table {
            font-size: 0.8rem !important;
        }
        
        .scale-btn {
            min-width: 18px !important;
            height: 18px !important;
            font-size: 0.7rem !important;
            margin: 0 0.5px !important;
            padding: 0 !important;
            border: 1px solid #ddd !important;
            background: #fff !important;
            color: #333 !important;
            border-radius: 3px !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            cursor: pointer !important;
            font-weight: bold !important;
            line-height: 1 !important;
        }
        
        .scale-btn.selected,
        .scale-btn input[type=radio]:checked + label {
            background: #222 !important;
            color: #fff !important;
            border-color: #222 !important;
        }
        
        .scale-btn input[type=radio] {
            display: none !important;
        }
        
        /* Compact title text */
        .pain-scale-section table tr:first-child td {
            font-size: 0.75rem !important;
            padding: 4px 2px !important;
            line-height: 1.1 !important;
        }
        
        /* Split headers even smaller */
        .pain-scale-section .desktop-split-header td {
            font-size: 0.7rem !important;
            padding: 3px 1px !important;
        }
        
        /* Pain consistency checkboxes small mobile styling */
        .pain-consistency-label {
            color: #222 !important;
            font-size: 0.65rem !important;
            display: inline-block !important;
            margin: 0 2px !important;
            white-space: nowrap !important;
        }
        
        /* Make consistency section wrap on small mobile */
        .pain-scale-section tr:last-child td {
            text-align: center !important;
            padding: 6px 2px !important;
        }
        
        .pain-scale-section tr:last-child span {
            display: inline-block !important;
            margin: 1px 2px !important;
            font-size: 0.65rem !important;
        }
        
        /* Ensure checkbox spacing on small mobile */
        .pain-scale-section input[type="checkbox"] {
            margin-right: 3px !important;
            margin-left: 1px !important;
            transform: scale(0.8) !important;
        }
        
        .pain-label {
            /* All sizing is now handled by JavaScript for consistency */
            font-size: 6px;
        }
        
        canvas#sig-canvas, canvas#assist-sig-canvas {
            width: 100% !important;
            max-width: 320px !important;
            min-width: 120px !important;
            height: 90px !important;
            display: block;
            margin: 0 auto;
        }
        .form-actions {
            flex-direction: column !important;
            gap: 10px !important;
            margin: 18px 0 0 0 !important;
            align-items: stretch !important;
        }
        .form-actions button, .form-actions .action-btn {
            width: 100% !important;
            min-width: 0 !important;
            font-size: 1.08rem !important;
            padding: 12px 0 !important;
            margin: 0 !important;
            border-radius: 8px !important;
        }
        /* Patient information fields at top of form - Very Small Mobile (600px and below) */
        .pdf-patient-row {
            display: flex !important;
            flex-wrap: wrap !important;
            flex-direction: column !important;
            gap: 18px !important;
            width: 100% !important;
            margin-top: 25px !important;
            margin-bottom: 25px !important;
            padding: 0 !important;
            align-items: stretch !important;
            justify-content: flex-start !important;
        }
        
        /* First row: First Name and Last Name with top labels */
        .patient-name-row {
            display: flex !important;
            flex-direction: row !important;
            gap: 4% !important;
            width: 100% !important;
            margin: 0 !important;
            align-items: stretch !important;
        }
        
        .patient-name-row > div {
            flex: 1 1 48% !important;
            max-width: 48% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 6px !important;
            align-items: flex-start !important;
        }
        
        .patient-name-row label {
            display: block !important;
            margin-bottom: 6px !important;
            margin-right: 0 !important;
            font-weight: normal !important;
            font-size: 1rem !important;
            white-space: normal !important;
            text-align: left !important;
        }
        
        /* Second row: DOB and MRN with top labels */
        .patient-dob-mrn {
            flex-basis: 100% !important;
            max-width: 100% !important;
            width: 100% !important;
            display: flex !important;
            flex-direction: row !important;
            gap: 4% !important;
            margin-top: 0 !important;
            align-items: stretch !important;
        }
        
        .patient-dob-mrn > div {
            flex: 1 1 48% !important;
            max-width: 48% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 6px !important;
            align-items: flex-start !important;
        }
        
        .patient-dob-mrn label {
            display: block !important;
            margin-bottom: 6px !important;
            margin-right: 0 !important;
            font-weight: normal !important;
            font-size: 0.95rem !important;
            white-space: normal !important;
            text-align: left !important;
        }
        
        /* Ensure top patient info inputs fill their containers properly */
        .pdf-patient-row input[type="text"],
        .pdf-patient-row input[type="date"] {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            padding: 12px 8px !important;
            border: none !important;
            border-bottom: 1.5px solid #222 !important;
            background: transparent !important;
            outline: none !important;
            font-size: 16px !important; /* Prevents iOS zoom */
            font-family: Arial, Helvetica, sans-serif !important;
            margin: 0 !important;
        }
        
        /* Specific sizing for top patient info firstname and lastname inputs */
        .patient-name-row input[type="text"] {
            padding: 12px 8px !important;
            font-size: 16px !important;
        }
        
        /* Patient information layout - Small Mobile (for pain diagram section at bottom) */
        .pdf-patient-row {
            display: flex !important;
            flex-wrap: wrap !important;
            flex-direction: column !important;
            gap: 18px !important;
            width: 100% !important;
            margin-top: 30px !important;
            margin-bottom: 30px !important;
            padding: 0 !important;
            align-items: stretch !important;
            justify-content: flex-start !important;
        }
        
        /* First row: First Name and Last Name with top labels */
        .patient-name-row {
            display: flex !important;
            flex-direction: row !important;
            gap: 4% !important;
            width: 100% !important;
            margin: 0 !important;
            align-items: stretch !important;
        }
        
        .patient-name-row > div {
            flex: 1 1 48% !important;
            max-width: 48% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 8px !important;
            align-items: flex-start !important;
        }
        
        .patient-name-row label {
            display: block !important;
            margin-bottom: 8px !important;
            margin-right: 0 !important;
            font-weight: normal !important;
            font-size: 1.05rem !important;
            white-space: normal !important;
            text-align: left !important;
        }
        
        /* Second row: DOB and MRN with top labels */
        .patient-dob-mrn {
            flex-basis: 100% !important;
            max-width: 100% !important;
            width: 100% !important;
            display: flex !important;
            flex-direction: row !important;
            gap: 4% !important;
            margin-top: 0 !important;
            align-items: stretch !important;
        }
        
        .patient-dob-mrn > div {
            flex: 1 1 48% !important;
            max-width: 48% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            display: flex !important;
            flex-direction: column !important;
            gap: 6px !important;
            align-items: flex-start !important;
        }
        
        .patient-dob-mrn label {
            display: block !important;
            margin-bottom: 6px !important;
            margin-right: 0 !important;
            font-weight: normal !important;
            font-size: 0.95rem !important;
            white-space: normal !important;
            text-align: left !important;
        }
        
        /* Ensure inputs fill their containers properly */
        .pdf-patient-row input[type="text"],
        .pdf-patient-row input[type="date"] {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 0 !important;
            box-sizing: border-box !important;
            padding: 12px 8px !important;
            border: none !important;
            border-bottom: 1.5px solid #222 !important;
            background: transparent !important;
            outline: none !important;
            font-size: 16px !important; /* Prevents iOS zoom */
            font-family: Arial, Helvetica, sans-serif !important;
            margin: 0 !important;
        }
        
        /* Specific sizing for firstname and lastname inputs */
        .patient-name-row input[type="text"] {
            padding: 14px 8px !important;
            font-size: 17px !important; /* Slightly larger but still prevents zoom */
        }
    }
</style>
<div class="pdf-form-container pdf-font" style="margin-top:120px;">
    @if(!$isPdf && auth()->user()->isAdmin() && isset($submission))
    <div style="display:flex;justify-content:flex-end;gap:12px;margin-bottom:18px;">
        @if($readOnly)
            <a href="{{ route('admin.submissions.edit', $submission) }}" class="action-btn" style="background:#1976d2;color:#fff;padding:8px 24px;border-radius:6px;font-size:1rem;font-weight:bold;border:none;box-shadow:0 2px 8px #0001;transition:background 0.2s;text-decoration:none;">Edit Form</a>
        @else
            <a href="{{ route('admin.submissions.show', $submission) }}" class="action-btn" style="background:#888;color:#fff;padding:8px 24px;border-radius:6px;font-size:1rem;font-weight:bold;border:none;box-shadow:0 2px 8px #0001;transition:background 0.2s;text-decoration:none;">View Form</a>
        @endif
    </div>
    @endif
    <div class="pdf-header-row">
        <div class="pdf-header-addresses">
            <div class="pdf-header-col" style="text-align:left;line-height:1.5;">
                <div style="font-weight:bold;font-size:1.1rem;">Houston Medical Center</div>
                <div>7205 Fannin<br>Suite 110B<br>Houston, TX 77030</div>
            </div>
            <div class="pdf-header-col" style="text-align:left;line-height:1.5;">
                <div style="font-weight:bold;font-size:1.1rem;">Dallas-Fort Worth</div>
                <div>405 State Highway 121<br>Bldg. A, Suite 150<br>Lewisville, TX 75067</div>
            </div>
        </div>
        <div class="pdf-header-contact-logo">
            <div class="pdf-header-col pdf-header-contact" style="text-align:left;line-height:1.5;">
                <div><span style="font-weight:bold;">Phone</span> 1-888-900-1TBI</div>
                <div><span style="font-weight:bold;">Fax</span> 713-779-3400</div>
                <div><span style="font-weight:bold;">Email</span> contact@tbi.clinic</div>
            </div>
            <div class="pdf-header-logo">
                @if($isPdf)
                    <img src="{{ $publicPath . '/logo.png' }}" />
                @else
                    <img src="{{ asset('logo.png') }}" />
                @endif
            </div>
        </div>
    </div>
    <div class="form-title-container" style="text-align:center;margin-bottom:30px;margin-top:50px;">
        <div style="font-size:1.5rem;font-weight:400;letter-spacing:1px;">HEADACHE QUESTIONNAIRE</div>
        <div style="font-size:1rem;letter-spacing:0.5px;">APPROVED BY TEXAS BRAIN INSTITUTE LLC: FORM TBI042125HEADACHE</div>
    </div>
    <div style="background:#e3f3fa;border:1.5px solid #b5d6e6;color:#222;padding:12px 18px;border-radius:4px;margin:18px 0 18px 0;font-size:1.08rem;text-align:left;max-width:900px;margin-left:auto;margin-right:auto;">
        <b>IMPORTANT:</b> We understand suffering from a brain injury can be very difficult and we sympathize with you. Please try and answer the questions below to the best of your ability to help us to fully understand your brain injury and headaches. These questions relate to if <b style="font-weight:bold;color:#1976d2;">the symptoms are NEW</b> after your accident.
    </div>
    <form id="questionnaire-form" method="POST" enctype="multipart/form-data" action="@if(auth()->user()->isAdmin() && isset($submission)){{ route('admin.submissions.update', $submission) }}@else{{ url('/assigned-form/' . $assignment->id . '/save') }}@endif">
        @csrf
        @if(auth()->user()->isAdmin() && isset($submission))
            @method('POST')
        @endif
        <input type="hidden" name="assignment_id" value="{{ $assignment->id ?? '' }}" />
        <input type="hidden" name="form_action_type" id="form-action-type" value="draft" />
        <div id="save-status" style="margin: 0 0 20px 0; position: relative; z-index: 100;"></div>
        
        <!-- Patient Information Fields -->
        <div class="pdf-patient-row" style="margin-top: 18px; margin-bottom: 30px; gap: 20px; font-size: 1.05rem; display: flex; flex-direction: row; align-items: center; justify-content: space-between;">
            <div class="patient-name-row" style="display: flex; flex-direction: row; gap: 20px;">
                <div style="display: flex; flex-direction: row; align-items: center; gap: 6px;">
                    <label style="font-weight: normal; margin-right: 4px; white-space: nowrap;">First Name:</label>
                    <input type="text" name="patient_first_name" style="border: none; border-bottom: 1.5px solid #222; background: transparent; outline: none; padding: 0 0 2px 0; font-family: Arial, Helvetica, sans-serif; font-size: 1.05rem; width: 140px;" @if(isset($data['patient_first_name']) && $data['patient_first_name'] !== null) value="{{ $data['patient_first_name'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                </div>
                <div style="display: flex; flex-direction: row; align-items: center; gap: 6px;">
                    <label style="font-weight: normal; margin-right: 4px; white-space: nowrap;">Last Name:</label>
                    <input type="text" name="patient_last_name" style="border: none; border-bottom: 1.5px solid #222; background: transparent; outline: none; padding: 0 0 2px 0; font-family: Arial, Helvetica, sans-serif; font-size: 1.05rem; width: 140px;" @if(isset($data['patient_last_name']) && $data['patient_last_name'] !== null) value="{{ $data['patient_last_name'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                </div>
            </div>
            <div class="patient-dob-mrn" style="display: flex; flex-direction: row; gap: 20px;">
                <div style="display: flex; flex-direction: row; align-items: center; gap: 6px;">
                    <label style="font-weight: normal; margin-right: 4px; white-space: nowrap;">DOB:</label>
                    <input type="date" name="patient_dob" style="border: none; border-bottom: 1.5px solid #222; background: transparent; outline: none; padding: 0 0 2px 0; font-family: Arial, Helvetica, sans-serif; font-size: 1.05rem; width: 160px;" @if(isset($data['patient_dob']) && $data['patient_dob'] !== null) value="{{ $data['patient_dob'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                </div>
                <div style="display: flex; flex-direction: row; align-items: center; gap: 6px;">
                    <label style="font-weight: normal; margin-right: 4px; white-space: nowrap;">MRN#:</label>
                    <input type="text" name="patient_mrn" style="border: none; border-bottom: 1.5px solid #222; background: transparent; outline: none; padding: 0 0 2px 0; font-family: Arial, Helvetica, sans-serif; font-size: 1.05rem; width: 100px;" @if(isset($data['patient_mrn']) && $data['patient_mrn'] !== null) value="{{ $data['patient_mrn'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                </div>
            </div>
        </div>
        
        <!-- Questions 1-11 (tabular layout) -->
        <div class="pdf-form-section">
            <table class="w-full border text-xs pdf-form-table" style="border-collapse:collapse;">
                <tbody>
                    <tr>
                        <td class="question-num">1</td>
                        <td style="width:70%;border-right:0.5px solid #333;">Are you experiencing any headaches:</td>
                        <td style="width:12.5%;text-align:center;"><label>Y <input type="radio" name="q1" value="Y" @if(isset($data['q1']) && $data['q1'] === 'Y') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                        <td style="width:12.5%;text-align:center;"><label>N <input type="radio" name="q1" value="N" @if(isset($data['q1']) && $data['q1'] === 'N') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                    </tr>
                    <tr>
                        <td class="question-num">2</td>
                        <td style="width:70%;border-right:0.5px solid #333;">Did the headaches start or worsen after the accident/incident described above</td>
                        <td style="width:12.5%;text-align:center;"><label>Y <input type="radio" name="q2" value="Y" @if(isset($data['q2']) && $data['q2'] === 'Y') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                        <td style="width:12.5%;text-align:center;"><label>N <input type="radio" name="q2" value="N" @if(isset($data['q2']) && $data['q2'] === 'N') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                    </tr>
                    <tr>
                        <td class="question-num">3</td>
                        <td style="width:70%;border-right:0.5px solid #333;">Were the headaches caused by the above accident?</td>
                        <td style="width:12.5%;text-align:center;"><label>Y <input type="radio" name="q3" value="Y" @if(isset($data['q3']) && $data['q3'] === 'Y') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                        <td style="width:12.5%;text-align:center;"><label>N <input type="radio" name="q3" value="N" @if(isset($data['q3']) && $data['q3'] === 'N') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                    </tr>
                    <tr>
                        <td class="question-num">4</td>
                        <td style="width:70%;border-right:0.5px solid #333;">When did the headaches start?</td>
                        <td colspan="2">Date : <input type="date" name="q4" style="border:none;border-bottom:1px solid #888;width:180px;background:transparent;outline:none;" @if(isset($data['q4']) && $data['q4'] !== null) value="{{ $data['q4'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></td>
                    </tr>
                    <tr>
                        <td class="question-num">5</td>
                        <td style="width:70%;border-right:0.5px solid #333;">When did the headaches get worse?</td>
                        <td colspan="2">Date : <input type="date" name="q5" style="border:none;border-bottom:1px solid #888;width:180px;background:transparent;outline:none;" @if(isset($data['q5']) && $data['q5'] !== null) value="{{ $data['q5'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></td>
                    </tr>
                    <tr>
                        <td class="question-num">6</td>
                        <td colspan="3" style="border-right:0.5px solid #333;">
                            Where are the headaches located?
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_front" @if(!empty($data['headache_location_front'])) checked @endif @if(!empty($readOnly)) disabled @endif /> In the front</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_back" @if(!empty($data['headache_location_back'])) checked @endif @if(!empty($readOnly)) disabled @endif /> In the back</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_sides" @if(!empty($data['headache_location_sides'])) checked @endif @if(!empty($readOnly)) disabled @endif /> On the sides (temples)</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_top" @if(!empty($data['headache_location_top'])) checked @endif @if(!empty($readOnly)) disabled @endif /> On the top</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_left" @if(!empty($data['headache_location_left'])) checked @endif @if(!empty($readOnly)) disabled @endif /> On the left side</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_right" @if(!empty($data['headache_location_right'])) checked @endif @if(!empty($readOnly)) disabled @endif /> On the right side</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_left_eye" @if(!empty($data['headache_location_left_eye'])) checked @endif @if(!empty($readOnly)) disabled @endif /> Behind the left eye</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_location_right_eye" @if(!empty($data['headache_location_right_eye'])) checked @endif @if(!empty($readOnly)) disabled @endif /> Behind the right eye</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="question-num">7</td>
                        <td colspan="3" style="border-right:0.5px solid #333;">
                            Headaches occurs with the following frequency
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_frequency_occasionally" @if(!empty($data['headache_frequency_occasionally'])) checked @endif @if(!empty($readOnly)) disabled @endif /> occasionally</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_frequency_on_off" @if(!empty($data['headache_frequency_on_off'])) checked @endif @if(!empty($readOnly)) disabled @endif /> on and off</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_frequency_all_time" @if(!empty($data['headache_frequency_all_time'])) checked @endif @if(!empty($readOnly)) disabled @endif /> all the time</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_frequency_throughout_day" @if(!empty($data['headache_frequency_throughout_day'])) checked @endif @if(!empty($readOnly)) disabled @endif /> throughout the day</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_frequency_at_night" @if(!empty($data['headache_frequency_at_night'])) checked @endif @if(!empty($readOnly)) disabled @endif /> at night</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_frequency_no_difference" @if(!empty($data['headache_frequency_no_difference'])) checked @endif @if(!empty($readOnly)) disabled @endif /> no difference</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="question-num">8</td>
                        <td colspan="3" style="border-right:0.5px solid #333;">
                            Each episode of headache usually lasts:
                            <input type="text" name="q8_duration" style="border:none;border-bottom:1px solid #888;width:80px;background:transparent;outline:none;" @if(isset($data['q8_duration']) && $data['q8_duration'] !== null) value="{{ $data['q8_duration'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_duration_seconds" @if(!empty($data['headache_duration_seconds'])) checked @endif @if(!empty($readOnly)) disabled @endif /> seconds</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_duration_minutes" @if(!empty($data['headache_duration_minutes'])) checked @endif @if(!empty($readOnly)) disabled @endif /> minutes</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_duration_hours" @if(!empty($data['headache_duration_hours'])) checked @endif @if(!empty($readOnly)) disabled @endif /> hours</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_duration_days" @if(!empty($data['headache_duration_days'])) checked @endif @if(!empty($readOnly)) disabled @endif /> days</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_duration_week" @if(!empty($data['headache_duration_week'])) checked @endif @if(!empty($readOnly)) disabled @endif /> week</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="question-num">9</td>
                        <td colspan="3" style="border-right:0.5px solid #333;">
                            Headaches feels like
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_dull_aching" @if(!empty($data['headache_intensity_dull_aching'])) checked @endif @if(!empty($readOnly)) disabled @endif /> a dull aching</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_sharp" @if(!empty($data['headache_intensity_sharp'])) checked @endif @if(!empty($readOnly)) disabled @endif /> sharp</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_stabbing" @if(!empty($data['headache_intensity_stabbing'])) checked @endif @if(!empty($readOnly)) disabled @endif /> stabbing</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_burning" @if(!empty($data['headache_intensity_burning'])) checked @endif @if(!empty($readOnly)) disabled @endif /> burning</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_cramping" @if(!empty($data['headache_intensity_cramping'])) checked @endif @if(!empty($readOnly)) disabled @endif /> cramping</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_throbbing" @if(!empty($data['headache_intensity_throbbing'])) checked @endif @if(!empty($readOnly)) disabled @endif /> throbbing</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_pressure" @if(!empty($data['headache_intensity_pressure'])) checked @endif @if(!empty($readOnly)) disabled @endif /> pressure</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_squeezing" @if(!empty($data['headache_intensity_squeezing'])) checked @endif @if(!empty($readOnly)) disabled @endif /> squeezing</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_dull" @if(!empty($data['headache_intensity_dull'])) checked @endif @if(!empty($readOnly)) disabled @endif /> dull</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_other" @if(!empty($data['headache_intensity_other'])) checked @endif @if(!empty($readOnly)) disabled @endif /> other <input type="text" name="headache_intensity_other_details" style="border:none;border-bottom:1px solid #888;width:120px;background:transparent;outline:none;" @if(isset($data['headache_intensity_other_details']) && $data['headache_intensity_other_details'] !== null) value="{{ $data['headache_intensity_other_details'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></label>
                        </td>
                    </tr>
                    <tr>
                        <td class="question-num">10</td>
                        <td colspan="3" style="border-right:0.5px solid #333;vertical-align:top;">
                            Intensity of Headache (scale of 1-10):
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_0" @if(!empty($data['headache_intensity_0'])) checked @endif @if(!empty($readOnly)) disabled @endif /> no pain (0)</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_1_2" @if(!empty($data['headache_intensity_1_2'])) checked @endif @if(!empty($readOnly)) disabled @endif /> mild pain (1-2)</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_3_4" @if(!empty($data['headache_intensity_3_4'])) checked @endif @if(!empty($readOnly)) disabled @endif /> moderate pain (3-4)</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_5_6" @if(!empty($data['headache_intensity_5_6'])) checked @endif @if(!empty($readOnly)) disabled @endif /> severe pain (5-6)</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_7_8" @if(!empty($data['headache_intensity_7_8'])) checked @endif @if(!empty($readOnly)) disabled @endif /> very severe pain (7-8)</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_intensity_9_10" @if(!empty($data['headache_intensity_9_10'])) checked @endif @if(!empty($readOnly)) disabled @endif /> worst possible pain (9-10)</label>
                        </td>
                    </tr>
                    <tr>
                        <td class="question-num">11</td>
                        <td style="width:70%;border-right:0.5px solid #333;">There is associated pain or tension in the neck:</td>
                        <td style="width:12.5%;text-align:center;"><label>Y <input type="radio" name="q11" value="Y" @if(isset($data['q11']) && $data['q11'] === 'Y') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                        <td style="width:12.5%;text-align:center;"><label>N <input type="radio" name="q11" value="N" @if(isset($data['q11']) && $data['q11'] === 'N') checked @endif @if(!empty($readOnly)) disabled @endif /></label></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Section 12: Activities Table (refactored to match reference) -->
        <div class="pdf-form-section">
            <label class="pdf-form-label" style="font-size:1.25rem;font-weight:bold;background:#e3f3fa;padding:6px 12px;display:block;border-radius:4px;margin-bottom:8px;">12. Activities Affecting Headaches</label>
            <table class="w-full border text-xs pdf-form-table" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th style="width:4%;text-align:center;">&nbsp;</th>
                        <th style="width:32%;text-align:left;">&nbsp;</th>
                        <th style="width:16%;text-align:center;">better</th>
                        <th style="width:16%;text-align:center;">worse</th>
                        <th style="width:16%;text-align:center;">not applicable</th>
                    </tr>
                </thead>
                <tbody>
                    @php $activities = [
                        ['a','Stress'],['b','Bright Lights'],['c','Loud Noises'],['d','Sleep Deprivation'],
                        ['e','Consuming Alcohol'],['f','Menses'],['g','Straining'],['h','Coughing, Sneezing'],
                        ['i','Movement'],['j','Sitting'],['k','Standing'],['l','Walking'],
                        ['m','During the day'],['n','At Night'],['o','Laying Down'],['p','No Activity'],
                        ['q','Sleeping'],['r','Medications'],['s','Heat'],['t','Cold'],
                        ['u','Rest'],['v','Massage'],['w','Hot Baths'],['x','Reducing Stimulation']
                    ]; @endphp
                    @foreach ($activities as [$label, $activity])
                    <tr>
                        <td>{{ $label }}</td>
                        <td>{{ $activity }}</td>
                        <td style="text-align:center;">
                            <label><input type="radio" name="activity_{{ $label }}" value="better" @if(isset($data['activity_'.$label]) && $data['activity_'.$label] === 'better') checked @endif @if(!empty($readOnly)) disabled @endif /> better</label>
                        </td>
                        <td style="text-align:center;">
                            <label><input type="radio" name="activity_{{ $label }}" value="worse" @if(isset($data['activity_'.$label]) && $data['activity_'.$label] === 'worse') checked @endif @if(!empty($readOnly)) disabled @endif /> worse</label>
                        </td>
                        <td style="text-align:center;">
                            @if($label === 'e' || $label === 'f')
                                <label><input type="radio" name="activity_{{ $label }}" value="not_applicable" @if(isset($data['activity_'.$label]) && $data['activity_'.$label] === 'not_applicable') checked @endif @if(!empty($readOnly)) disabled @endif /> not applicable</label>
                            @else
                                &nbsp;
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- Section 13: Associated Symptoms (refactored to match reference) -->
        <div class="pdf-form-section">
            <label class="pdf-form-label" style="font-size:1.25rem;font-weight:bold;background:#e3f3fa;padding:6px 12px;display:block;border-radius:4px;margin-bottom:8px;">13. What associated symptoms do you experience with your headaches?</label>
            <table class="w-full border text-xs pdf-form-table" style="border-collapse:collapse;">
                <tbody>
                    <tr>
                        <td class="question-num" style="vertical-align:top;width:36px;">a</td>
                        <td style="font-weight:bold;vertical-align:top;width:18%;">General:</td>
                        <td>
                            <label><input type="checkbox" name="headache_associated_symptoms_nausea" @if(!empty($data['headache_associated_symptoms_nausea'])) checked @endif @if(!empty($readOnly)) disabled @endif /> nausea</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_vomiting" @if(!empty($data['headache_associated_symptoms_vomiting'])) checked @endif @if(!empty($readOnly)) disabled @endif /> vomiting</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_dizziness" @if(!empty($data['headache_associated_symptoms_dizziness'])) checked @endif @if(!empty($readOnly)) disabled @endif /> dizziness</label>
                        </td>
                    </tr>
                    <tr style="border-top:none;">
                        <td></td><td></td>
                        <td>Provide details : <input type="text" name="headache_associated_symptoms_details_a" style="width:60%;border-bottom:1px solid #888;border:none;border-bottom:1.5px solid #888;background:transparent;outline:none;height:1.2em;" @if(isset($data['headache_associated_symptoms_details_a']) && $data['headache_associated_symptoms_details_a'] !== null) value="{{ $data['headache_associated_symptoms_details_a'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></td>
                    </tr>
                    <tr>
                        <td class="question-num" style="vertical-align:top;">b</td>
                        <td style="font-weight:bold;vertical-align:top;">Vision:</td>
                        <td>
                            <label><input type="checkbox" name="headache_associated_symptoms_blind_spots" @if(!empty($data['headache_associated_symptoms_blind_spots'])) checked @endif @if(!empty($readOnly)) disabled @endif /> blind spots</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_sensitivity_to_light" @if(!empty($data['headache_associated_symptoms_sensitivity_to_light'])) checked @endif @if(!empty($readOnly)) disabled @endif /> sensitivity to light</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_blurred_vision" @if(!empty($data['headache_associated_symptoms_blurred_vision'])) checked @endif @if(!empty($readOnly)) disabled @endif /> blurred vision</label>
                        </td>
                    </tr>
                    <tr style="border-top:none;">
                        <td></td><td></td>
                        <td>Provide details : <input type="text" name="headache_associated_symptoms_details_b" style="width:60%;border-bottom:1px solid #888;border:none;border-bottom:1.5px solid #888;background:transparent;outline:none;height:1.2em;" @if(isset($data['headache_associated_symptoms_details_b']) && $data['headache_associated_symptoms_details_b'] !== null) value="{{ $data['headache_associated_symptoms_details_b'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></td>
                    </tr>
                    <tr>
                        <td class="question-num" style="vertical-align:top;">c</td>
                        <td style="font-weight:bold;vertical-align:top;">Sensory:</td>
                        <td>
                            <label><input type="checkbox" name="headache_associated_symptoms_head_pain" @if(!empty($data['headache_associated_symptoms_head_pain'])) checked @endif @if(!empty($readOnly)) disabled @endif /> head pain</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_head_numbness" @if(!empty($data['headache_associated_symptoms_head_numbness'])) checked @endif @if(!empty($readOnly)) disabled @endif /> head numbness</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_head_tingling" @if(!empty($data['headache_associated_symptoms_head_tingling'])) checked @endif @if(!empty($readOnly)) disabled @endif /> head tingling</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_sensitivity_to_sound" @if(!empty($data['headache_associated_symptoms_sensitivity_to_sound'])) checked @endif @if(!empty($readOnly)) disabled @endif /> sensitivity to sound</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_loss_of_taste" @if(!empty($data['headache_associated_symptoms_loss_of_taste'])) checked @endif @if(!empty($readOnly)) disabled @endif /> loss of sense of taste</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_loss_of_smell" @if(!empty($data['headache_associated_symptoms_loss_of_smell'])) checked @endif @if(!empty($readOnly)) disabled @endif /> loss of sense of smell</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_arm_or_leg_numbness" @if(!empty($data['headache_associated_symptoms_arm_or_leg_numbness'])) checked @endif @if(!empty($readOnly)) disabled @endif /> arm or leg numbness</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_arm_or_leg_tingling" @if(!empty($data['headache_associated_symptoms_arm_or_leg_tingling'])) checked @endif @if(!empty($readOnly)) disabled @endif /> arm or leg tingling</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_insomnia" @if(!empty($data['headache_associated_symptoms_insomnia'])) checked @endif @if(!empty($readOnly)) disabled @endif /> insomnia</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_drowsiness" @if(!empty($data['headache_associated_symptoms_drowsiness'])) checked @endif @if(!empty($readOnly)) disabled @endif /> drowsiness</label>
                        </td>
                    </tr>
                    <tr style="border-top:none;">
                        <td></td><td></td>
                        <td>Provide details : <input type="text" name="headache_associated_symptoms_details_c" style="width:60%;border-bottom:1px solid #888;border:none;border-bottom:1.5px solid #888;background:transparent;outline:none;height:1.2em;" @if(isset($data['headache_associated_symptoms_details_c']) && $data['headache_associated_symptoms_details_c'] !== null) value="{{ $data['headache_associated_symptoms_details_c'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></td>
                    </tr>
                    <tr>
                        <td class="question-num" style="vertical-align:top;">d</td>
                        <td style="font-weight:bold;vertical-align:top;">Cognitive:</td>
                        <td>
                            <label><input type="checkbox" name="headache_associated_symptoms_memory_difficulties" @if(!empty($data['headache_associated_symptoms_memory_difficulties'])) checked @endif @if(!empty($readOnly)) disabled @endif /> memory difficulties</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_concentration_problems" @if(!empty($data['headache_associated_symptoms_concentration_problems'])) checked @endif @if(!empty($readOnly)) disabled @endif /> concentration problems</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_mental_fogginess" @if(!empty($data['headache_associated_symptoms_mental_fogginess'])) checked @endif @if(!empty($readOnly)) disabled @endif /> mental fogginess</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_learning_disabilities" @if(!empty($data['headache_associated_symptoms_learning_disabilities'])) checked @endif @if(!empty($readOnly)) disabled @endif /> learning disabilities</label>
                        </td>
                    </tr>
                    <tr style="border-top:none;">
                        <td></td><td></td>
                        <td>Provide details : <input type="text" name="headache_associated_symptoms_details_d" style="width:60%;border-bottom:1px solid #888;border:none;border-bottom:1.5px solid #888;background:transparent;outline:none;height:1.2em;" @if(isset($data['headache_associated_symptoms_details_d']) && $data['headache_associated_symptoms_details_d'] !== null) value="{{ $data['headache_associated_symptoms_details_d'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></td>
                    </tr>
                    <tr>
                        <td class="question-num" style="vertical-align:top;">e</td>
                        <td style="font-weight:bold;vertical-align:top;">Psychological:</td>
                        <td>
                            <label><input type="checkbox" name="headache_associated_symptoms_irritability" @if(!empty($data['headache_associated_symptoms_irritability'])) checked @endif @if(!empty($readOnly)) disabled @endif /> irritability</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_depression" @if(!empty($data['headache_associated_symptoms_depression'])) checked @endif @if(!empty($readOnly)) disabled @endif /> depression</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_anxiety" @if(!empty($data['headache_associated_symptoms_anxiety'])) checked @endif @if(!empty($readOnly)) disabled @endif /> anxiety</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_mood_changes" @if(!empty($data['headache_associated_symptoms_mood_changes'])) checked @endif @if(!empty($readOnly)) disabled @endif /> mood changes</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_attention_deficit" @if(!empty($data['headache_associated_symptoms_attention_deficit'])) checked @endif @if(!empty($readOnly)) disabled @endif /> attention deficit</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_hyperactivity" @if(!empty($data['headache_associated_symptoms_hyperactivity'])) checked @endif @if(!empty($readOnly)) disabled @endif /> hyperactivity</label>
                            <label style="margin-left:18px;"><input type="checkbox" name="headache_associated_symptoms_anger" @if(!empty($data['headache_associated_symptoms_anger'])) checked @endif @if(!empty($readOnly)) disabled @endif /> anger</label>
                        </td>
                    </tr>
                    <tr style="border-top:none;">
                        <td></td><td></td>
                        <td>Provide details : <input type="text" name="headache_associated_symptoms_details_e" style="width:60%;border-bottom:1px solid #888;border:none;border-bottom:1.5px solid #888;background:transparent;outline:none;height:1.2em;" @if(isset($data['headache_associated_symptoms_details_e']) && $data['headache_associated_symptoms_details_e'] !== null) value="{{ $data['headache_associated_symptoms_details_e'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif /></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Signature and Consent Section (refactored to match reference) -->
        <div class="pdf-form-section">
            <div style="border:1.5px solid #888; border-radius:6px; padding:18px 18px 10px 18px; margin-bottom:18px; background:#fff;">
                <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:8px;">
                    <input type="checkbox" name="agree_signature" style="margin-top:3px;" @if(!empty($data['agree_signature'])) checked @endif @if(!empty($readOnly)) disabled @endif />
                    <div>
                        <b>Electronic Signature Disclosure and Consent:</b><br>
                        <span style="font-weight:normal;">
                            By selecting the "I agree" button, I am signing this document electronically. I agree that my electronic signature is the legal equivalent of my manual/handwritten signature on this document. By selecting "I agree" using any device, means, or action, I consent to the legally binding terms and conditions of this document. I further agree that my signature on this document is as valid as if I signed the document in writing.
                        </span>
                    </div>
                </div>
                <div style="display:flex;align-items:flex-start;gap:10px;margin-bottom:18px;">
                    <input type="checkbox" name="authentication" style="margin-top:3px;" @if(!empty($data['authentication'])) checked @endif @if(!empty($readOnly)) disabled @endif />
                    <div>
                        <b>Authentication/Endorsement:</b><br>
                        <span style="font-weight:normal;">
                            I confirm that the information given above is correct to the best of my knowledge. I have read and understood the contents of this form and I take full responsibility for the information given above. I have had the opportunity to ask questions regarding the Headache Questionnaire. By signing my name electronically on this form, I am agreeing that my electronic signature is the legal equivalent of my manual signature.
                        </span>
                    </div>
                </div>
                <div style="margin-bottom:18px;">
                    <span>Patient's Name : </span>
                    <input type="text" name="sig_patient_name" style="min-width:220px;border:1.5px solid #888;border-radius:4px;padding:4px 10px;font-size:1rem;" @if(isset($data['sig_patient_name']) && $data['sig_patient_name'] !== null) value="{{ $data['sig_patient_name'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                    <span style="margin-left:32px;">Date : </span>
                    <input type="date" name="sig_date" style="min-width:180px;border:1.5px solid #888;border-radius:4px;padding:4px 10px;font-size:1rem;" @if(isset($data['sig_date']) && $data['sig_date'] !== null) value="{{ $data['sig_date'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                </div>
                <div style="margin-bottom:32px;">
                    <span>Signature : </span>
                    <span style="display:inline-block;vertical-align:middle;">
                        @if($isPdf)
                            @if(!empty($data['sig_image']))
                                <img src="{{ $data['sig_image'] }}" alt="Signature" style="border:1.5px solid #888;border-radius:4px;background:#fafafa;width:480px;height:80px;object-fit:contain;" />
                            @endif
                        @else
                            <canvas id="sig-canvas" width="480" height="80" style="border:1.5px solid #888;border-radius:4px;background:#fafafa;cursor:crosshair;"></canvas>
                            <button type="button" id="sig-clear" style="margin-left:8px;font-size:0.95rem;">Clear</button>
                            <input type="hidden" name="sig_image" id="sig-image" value="{{ $data['sig_image'] ?? '' }}" />
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var sigImage = document.getElementById('sig-image').value;
                                if(sigImage) {
                                    var canvas = document.getElementById('sig-canvas');
                                    var ctx = canvas.getContext('2d');
                                    var img = new Image();
                                    img.onload = function() { ctx.drawImage(img, 0, 0, canvas.width, canvas.height); };
                                    img.src = sigImage;
                                }
                            });
                            </script>
                        @endif
                    </span>
                </div>
                <div style="margin-bottom:10px;">If you have been assisted in filling out the questions above, please provide name and signature below:</div>
                <div style="margin-bottom:18px;">
                    <span>Name : </span>
                    <input type="text" name="assist_name" style="min-width:220px;border:1.5px solid #888;border-radius:4px;padding:4px 10px;font-size:1rem;" @if(isset($data['assist_name']) && $data['assist_name'] !== null) value="{{ $data['assist_name'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                    <span style="margin-left:32px;">Date : </span>
                    <input type="date" name="assist_date" style="min-width:180px;border:1.5px solid #888;border-radius:4px;padding:4px 10px;font-size:1rem;" @if(isset($data['assist_date']) && $data['assist_date'] !== null) value="{{ $data['assist_date'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                </div>
                <div style="margin-bottom:18px;">
                    <span>Relationship : </span>
                    <input type="text" name="assist_relationship" style="min-width:220px;border:1.5px solid #888;border-radius:4px;padding:4px 10px;font-size:1rem;" @if(isset($data['assist_relationship']) && $data['assist_relationship'] !== null) value="{{ $data['assist_relationship'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                </div>
                <div style="margin-bottom:0;">
                    <span>Signature : </span>
                    <span style="display:inline-block;vertical-align:middle;">
                        @if($isPdf)
                            @if(!empty($data['assist_sig_image']))
                                <img src="{{ $data['assist_sig_image'] }}" alt="Assistant Signature" style="border:1.5px solid #888;border-radius:4px;background:#fafafa;width:480px;height:80px;object-fit:contain;" />
                            @endif
                        @else
                            <canvas id="assist-sig-canvas" width="480" height="80" style="border:1.5px solid #888;border-radius:4px;background:#fafafa;cursor:crosshair;"></canvas>
                            <button type="button" id="assist-sig-clear" style="margin-left:8px;font-size:0.95rem;">Clear</button>
                            <input type="hidden" name="assist_sig_image" id="assist-sig-image" value="{{ $data['assist_sig_image'] ?? '' }}" />
                            <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                var sigImage = document.getElementById('assist-sig-image').value;
                                if(sigImage) {
                                    var canvas = document.getElementById('assist-sig-canvas');
                                    var ctx = canvas.getContext('2d');
                                    var img = new Image();
                                    img.onload = function() { ctx.drawImage(img, 0, 0, canvas.width, canvas.height); };
                                    img.src = sigImage;
                                }
                            });
                            </script>
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <!-- Headache Diagram Page Section (moved inside form) -->
        <div class="pdf-form-section pdf-form-diagram" style="margin-top:40px;max-width:900px;margin-left:auto;margin-right:auto;">
            <div>
                <div style="font-weight:bold;font-size:1.3rem;text-align:center;margin-bottom:10px;letter-spacing:1px;">HEADACHE DIAGRAM</div>
                <div style="display:flex;gap:24px;margin-bottom:10px;">
                    <div style="flex:1;">
                        <label style="font-weight:normal;">Patient Name:</label>
                        <input type="text" name="pain_patient_name" style="border:none;border-bottom:1px solid #888;width:120px;background:transparent;outline:none;" @if(isset($data['pain_patient_name']) && $data['pain_patient_name'] !== null) value="{{ $data['pain_patient_name'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                    </div>
                    <div style="flex:1;">
                        <label style="font-weight:normal;">Date:</label>
                        <input type="date" name="pain_date" style="border:none;border-bottom:1px solid #888;width:180px;background:transparent;outline:none;" @if(isset($data['pain_date']) && $data['pain_date'] !== null) value="{{ $data['pain_date'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                    </div>
                    <div style="flex:1;">
                        <label style="font-weight:normal;">Age:</label>
                        <input type="text" name="pain_age" style="border:none;border-bottom:1px solid #888;width:50px;background:transparent;outline:none;" @if(isset($data['pain_age']) && $data['pain_age'] !== null) value="{{ $data['pain_age'] }}" @endif @if(!empty($readOnly)) readonly disabled @endif />
                    </div>
                </div>
                <div style="font-weight:bold;margin-bottom:6px;">Where is your pain now? <span style="font-weight:normal;">Please mark the areas of pain using the symbols indicated below.<br/>(please take some time and be as accurate as possible!)</span></div>
                <!-- SVG Symbols Row -->
                <div id="pain-symbols" style="display: flex; gap: 24px; margin-bottom: 16px; flex-wrap: wrap; justify-content: center;">
                    <div class="pain-symbol" data-label="active pain" title="active pain" style="cursor:pointer;display:flex;flex-direction:column;align-items:flex-start;background:#f5fafd;padding:10px 18px 10px 14px;border-radius:6px;min-width:120px;">
                        <span style="font-weight:bold;font-size:15px;margin-bottom:2px;">active pain</span>
                        <svg width="90" height="28" style="display:block;"><g stroke="#e53935" stroke-width="3" fill="none"><polyline points="5,25 15,10 25,25"/></g></svg>
                        <button type="button" class="clear-symbol" data-label="active pain" style="margin-top:4px;font-size:12px;">Clear</button>
                    </div>
                    <div class="pain-symbol" data-label="numbness" title="numbness" style="cursor:pointer;display:flex;flex-direction:column;align-items:flex-start;background:#f5fafd;padding:10px 18px 10px 14px;border-radius:6px;min-width:120px;">
                        <span style="font-weight:bold;font-size:15px;margin-bottom:2px;">numbness</span>
                        <svg width="90" height="28" style="display:block;"><g stroke="#43a047" stroke-width="2.5" fill="none"><circle cx="15" cy="12" r="7"/></g></svg>
                        <button type="button" class="clear-symbol" data-label="numbness" style="margin-top:4px;font-size:12px;">Clear</button>
                    </div>
                    <div class="pain-symbol" data-label="pins & needles" title="pins & needles" style="cursor:pointer;display:flex;flex-direction:column;align-items:flex-start;background:#f5fafd;padding:10px 18px 10px 14px;border-radius:6px;min-width:120px;">
                        <span style="font-weight:bold;font-size:15px;margin-bottom:2px;">pins & needles</span>
                        <svg width="90" height="28" style="display:block;"><g stroke="#1e88e5" stroke-width="3"><line x1="15" y1="8" x2="15" y2="22"/></g></svg>
                        <button type="button" class="clear-symbol" data-label="pins & needles" style="margin-top:4px;font-size:12px;">Clear</button>
                    </div>
                    <div class="pain-symbol" data-label="burning" title="burning" style="cursor:pointer;display:flex;flex-direction:column;align-items:flex-start;background:#f5fafd;padding:10px 18px 10px 14px;border-radius:6px;min-width:120px;">
                        <span style="font-weight:bold;font-size:15px;margin-bottom:2px;">burning</span>
                        <svg width="90" height="28" style="display:block;"><g fill="#fbc02d" stroke="#fbc02d" stroke-width="1.5"><rect x="10" y="10" width="8" height="8" rx="2"/></g></svg>
                        <button type="button" class="clear-symbol" data-label="burning" style="margin-top:4px;font-size:12px;">Clear</button>
                    </div>
                    <div class="pain-symbol" data-label="radiating pain" title="radiating pain" style="cursor:pointer;display:flex;flex-direction:column;align-items:flex-start;background:#f5fafd;padding:10px 18px 10px 14px;border-radius:6px;min-width:120px;">
                        <span style="font-weight:bold;font-size:15px;margin-bottom:2px;">radiating pain</span>
                        <svg width="90" height="28" style="display:block;"><g stroke="#ab47bc" stroke-width="3"><line x1="10" y1="10" x2="30" y2="22"/></g></svg>
                        <button type="button" class="clear-symbol" data-label="radiating pain" style="margin-top:4px;font-size:12px;">Clear</button>
                    </div>
                </div>
                <!-- Pain Diagram Section - This is the ONLY interactive diagram now -->
                @if($isPdf)
                    @php
                        $diagramWidth = 900; // Set this to the actual width used in your PDF
                        $diagramHeight = 320; // Set this to the actual height used in your PDF
                    @endphp
                    <div class="diagram-container" style="width:100%;max-width:{{ $diagramWidth }}px;margin:auto;position:relative;">
                        <img src="{{ $publicPath . '/storage/headache-diagram.png' }}" alt="Head Diagram" style="width:100%;max-width:{{ $diagramWidth }}px;height:{{ $diagramHeight }}px;object-fit:contain;border:1.5px solid #888; margin-bottom: 10px;" />
                        @if(!empty($data['pain_points']))
                            @php $painPoints = json_decode($data['pain_points'], true); @endphp
                            <svg width="{{ $diagramWidth }}" height="{{ $diagramHeight }}" style="position:absolute;top:0;left:0;pointer-events:none;">
                                @foreach($painPoints as $pt)
                                    @php
                                        // Always use percentage coordinates for responsive placement
                                        if (isset($pt['xPercent']) && isset($pt['yPercent'])) {
                                            $x = ($pt['xPercent'] / 100) * $diagramWidth;
                                            $y = ($pt['yPercent'] / 100) * $diagramHeight;
                                        } else {
                                            // Legacy pixel coordinates fallback
                                            $x = $pt['x'] ?? 0;
                                            $y = $pt['y'] ?? 0;
                                        }
                                    @endphp
                                    @switch($pt['label'])
                                        @case('active pain')
                                            <polyline points="{{ ($x-12) }},{{ ($y+8) }} {{ $x }},{{ ($y-12) }} {{ ($x+12) }},{{ ($y+8) }}" fill="none" stroke="#e53935" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
                                            @break
                                        @case('numbness')
                                            <circle cx="{{ $x }}" cy="{{ $y }}" r="12" fill="none" stroke="#43a047" stroke-width="4"/>
                                            @break
                                        @case('pins & needles')
                                            <line x1="{{ $x }}" y1="{{ $y-8 }}" x2="{{ $x }}" y2="{{ $y+8 }}" stroke="#1e88e5" stroke-width="4" stroke-linecap="round"/>
                                            @break
                                        @case('burning')
                                            <rect x="{{ $x-4 }}" y="{{ $y-4 }}" width="8" height="8" rx="2" fill="#fbc02d"/>
                                            @break
                                        @case('radiating pain')
                                            <line x1="{{ $x-10 }}" y1="{{ $y-10 }}" x2="{{ $x+10 }}" y2="{{ $y+12 }}" stroke="#ab47bc" stroke-width="3"/>
                                            @break
                                    @endswitch
                                @endforeach
                            </svg>
                        @endif
                    </div>
                @else
                    <div class="diagram-container" id="diagram-container" style="width:100%;max-width:900px;margin:auto;">
                        <img src="{{ asset('storage/headache-diagram.png') }}" id="head-diagram" alt="Head Diagram" style="width:100%;max-width:900px;height:320px;object-fit:contain;border:1.5px solid #888; margin-bottom: 10px;" />
                        <!-- Pain labels will be placed here by JS -->
                    </div>
                @endif
                <input type="hidden" name="pain_points" id="pain_points" value="{{ $data['pain_points'] ?? '' }}" />
                <!-- Pain Scale Section -->
                <div class="pdf-form-section pain-scale-section" style="margin-top:18px;margin-bottom:0;">
                    <table style="width:100%;border:1.5px solid #b5d6e6;border-collapse:collapse;text-align:center;font-size:1.1rem;background:#fff;">
                        <tr style="border-bottom:1.5px solid #b5d6e6;">
                            <td colspan="11" style="color:#2196f3;font-weight:bold;padding:8px 0;">How bad is your headache right now? ( 0 = no pain , 10 = worst pain )</td>
                        </tr>
                        <tr class="scale-row">
                            <td colspan="11" style="padding:8px 0;">
                                @for ($i = 0; $i <= 10; $i++)
                                    <input type="radio" name="headache_now" value="{{ $i }}" id="headache_now_{{ $i }}" style="display:none;" @if(isset($data['headache_now']) && $data['headache_now'] == $i) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_now_{{ $i }}" class="scale-btn @if(isset($data['headache_now']) && $data['headache_now'] == $i) selected @endif">{{ $i }}</label>
                                @endfor
                            </td>
                        </tr>
                        <tr class="desktop-split-header" style="border-bottom:1.5px solid #b5d6e6;">
                            <td colspan="6" style="color:#2196f3;font-weight:bold;padding:8px 0;border-right:1.5px solid #b5d6e6;">How bad is your headache at its worst?</td>
                            <td colspan="6" style="color:#2196f3;font-weight:bold;padding:8px 0;">How bad is your headache at its best?</td>
                        </tr>
                        <tr class="desktop-split-buttons">
                            <td colspan="6" style="padding:8px 0;border-right:1.5px solid #b5d6e6;">
                                @for ($i = 0; $i <= 10; $i++)
                                    <input type="radio" name="headache_worst" value="{{ $i }}" id="headache_worst_{{ $i }}" style="display:none;" @if(isset($data['headache_worst']) && $data['headache_worst'] == $i) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_worst_{{ $i }}" class="scale-btn @if(isset($data['headache_worst']) && $data['headache_worst'] == $i) selected @endif">{{ $i }}</label>
                                @endfor
                            </td>
                            <td colspan="6" style="padding:8px 0;">
                                @for ($i = 0; $i <= 10; $i++)
                                    <input type="radio" name="headache_best" value="{{ $i }}" id="headache_best_{{ $i }}" style="display:none;" @if(isset($data['headache_best']) && $data['headache_best'] == $i) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_best_{{ $i }}" class="scale-btn @if(isset($data['headache_best']) && $data['headache_best'] == $i) selected @endif">{{ $i }}</label>
                                @endfor
                            </td>
                        </tr>
                        <tr><td colspan="11" style="color:#2196f3;font-weight:bold;padding:10px 0 10px 0;font-size:1.08rem;">How consistent is your headache as now?</td></tr>
                        <tr>
                            <td colspan="11" style="text-align:center;padding:12px 0;">
                                <span style="margin:0 18px;display:inline-block;min-width:120px;">
                                    <input type="checkbox" name="headache_consistency_continuous" id="headache_consistency_continuous" @if(!empty($data['headache_consistency_continuous'])) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_consistency_continuous" class="pain-consistency-label">Continuous</label>
                                </span>
                                <span style="margin:0 18px;display:inline-block;min-width:120px;">
                                    <input type="checkbox" name="headache_consistency_positional" id="headache_consistency_positional" @if(!empty($data['headache_consistency_positional'])) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_consistency_positional" class="pain-consistency-label">Positional</label>
                                </span>
                                <span style="margin:0 18px;display:inline-block;min-width:160px;">
                                    <input type="checkbox" name="headache_consistency_intermittent" id="headache_consistency_intermittent" @if(!empty($data['headache_consistency_intermittent'])) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_consistency_intermittent" class="pain-consistency-label">Intermittent (on/off)</label>
                                </span>
                                <span style="margin:0 18px;display:inline-block;min-width:120px;">
                                    <input type="checkbox" name="headache_consistency_unable" id="headache_consistency_unable" @if(!empty($data['headache_consistency_unable'])) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_consistency_unable" class="pain-consistency-label">unable to rate</label>
                                </span>
                            </td>
                        </tr>
                    </table>
                    
                    <!-- Mobile-only stacked sections -->
                    <div class="mobile-stacked-sections">
                        <div class="mobile-worst">
                            <h4>How bad is your headache at its worst?</h4>
                            <div class="buttons">
                                @for ($i = 0; $i <= 10; $i++)
                                    <input type="radio" name="headache_worst_mobile" value="{{ $i }}" id="headache_worst_mobile_{{ $i }}" style="display:none;" @if(isset($data['headache_worst']) && $data['headache_worst'] == $i) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_worst_mobile_{{ $i }}" class="scale-btn @if(isset($data['headache_worst']) && $data['headache_worst'] == $i) selected @endif">{{ $i }}</label>
                                @endfor
                            </div>
                        </div>
                        <div class="mobile-best">
                            <h4>How bad is your headache at its best?</h4>
                            <div class="buttons">
                                @for ($i = 0; $i <= 10; $i++)
                                    <input type="radio" name="headache_best_mobile" value="{{ $i }}" id="headache_best_mobile_{{ $i }}" style="display:none;" @if(isset($data['headache_best']) && $data['headache_best'] == $i) checked @endif @if(!empty($readOnly)) disabled @endif />
                                    <label for="headache_best_mobile_{{ $i }}" class="scale-btn @if(isset($data['headache_best']) && $data['headache_best'] == $i) selected @endif">{{ $i }}</label>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if(!$readOnly)
        <div class="form-actions" style="display:flex;justify-content:center;gap:18px;margin:32px 0 0 0;">
            <button type="submit" id="submit-btn" class="action-btn" style="background:#1976d2;color:#fff;padding:10px 32px;border-radius:6px;font-size:1.1rem;font-weight:bold;border:none;box-shadow:0 2px 8px #0001;transition:background 0.2s;">
                @if(auth()->user()->isAdmin() && isset($submission))
                    Update
                @else
                    Submit
                @endif
            </button>
            <button type="button" id="save-draft" class="action-btn" style="background:#888;color:#fff;padding:10px 32px;border-radius:6px;font-size:1.1rem;font-weight:bold;border:none;box-shadow:0 2px 8px #0001;transition:background 0.2s;">Save Draft</button>
            <button type="reset" id="reset-btn" class="action-btn" style="background:#fff;color:#1976d2;padding:10px 32px;border-radius:6px;font-size:1.1rem;font-weight:bold;border:2px solid #1976d2;box-shadow:0 2px 8px #0001;transition:background 0.2s;">Reset</button>
        </div>
        @endif
    </form>
</div>
<div style="height:32px;background:#fff;"></div>
<script>
// FIXED PAIN DIAGRAM JAVASCRIPT - REPLACE COMPLETELY
// Set readOnly JS flag from Blade
window.readOnlyForm = {{ !empty($readOnly) ? 'true' : 'false' }};

const diagram = document.getElementById('head-diagram');
const container = document.getElementById('diagram-container');
// At the top of the script, declare painPointsInput only once
var painPointsInput = document.getElementById('pain_points');
var painPoints = [];
var selectedPainLabel = null;

// Only clear markings if not read-only AND there are no saved markings
if (!window.readOnlyForm) {
    if (painPointsInput && !painPointsInput.value) {
        painPoints = [];
        painPointsInput.value = '';
    }
}

// SVG symbol selection logic - works on both desktop and mobile
const painSymbols = document.querySelectorAll('.pain-symbol');
painSymbols.forEach(symbol => {
    // Add both click and touch events for maximum compatibility
    symbol.addEventListener('click', function(e) {
        // Prevent click if clear button is pressed
        if (e.target.classList.contains('clear-symbol')) return;
        painSymbols.forEach(s => s.style.outline = '');
        this.style.outline = '2px solid #1976d2';
        selectedPainLabel = this.getAttribute('data-label');
        e.preventDefault();
    });
    
    // Touch event for mobile (prevents double-tap zoom)
    symbol.addEventListener('touchend', function(e) {
        if (e.target.classList.contains('clear-symbol')) return;
        painSymbols.forEach(s => s.style.outline = '');
        this.style.outline = '2px solid #1976d2';
        selectedPainLabel = this.getAttribute('data-label');
        e.preventDefault();
    });
});

// Clear button logic - works on both desktop and mobile
const clearButtons = document.querySelectorAll('.clear-symbol');
clearButtons.forEach(btn => {
    // Click event for desktop
    btn.addEventListener('click', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const label = this.getAttribute('data-label');
        painPoints = painPoints.filter(pt => pt.label !== label);
        painPointsInput.value = JSON.stringify(painPoints);
        renderPainPoints();
    });
    
    // Touch event for mobile
    btn.addEventListener('touchend', function(e) {
        e.stopPropagation();
        e.preventDefault();
        const label = this.getAttribute('data-label');
        painPoints = painPoints.filter(pt => pt.label !== label);
        painPointsInput.value = JSON.stringify(painPoints);
        renderPainPoints();
    });
});

// Diagram click/touch logic - works on both desktop and mobile with proper scaling
if (diagram) {
    function addPainPoint(clientX, clientY) {
        if (!selectedPainLabel) {
            alert('Please select a pain symbol above before marking the diagram.');
            return;
        }
        
        const rect = diagram.getBoundingClientRect();
        const x = clientX - rect.left;
        const y = clientY - rect.top;
        
        // Convert to percentages with higher precision for consistent cross-device positioning
        const xPercent = Math.round(((x / rect.width) * 100) * 1000) / 1000; // 3 decimal places
        const yPercent = Math.round(((y / rect.height) * 100) * 1000) / 1000; // 3 decimal places
        
        // Store ONLY percentage coordinates for perfect consistency
        painPoints.push({
            xPercent: xPercent,
            yPercent: yPercent,
            label: selectedPainLabel
        });
        
        renderPainPoints();
        painPointsInput.value = JSON.stringify(painPoints);
    }
    
    // Desktop click event
    diagram.addEventListener('click', function(e) {
        addPainPoint(e.clientX, e.clientY);
    });
    
    // Mobile touch event
    diagram.addEventListener('touchend', function(e) {
        e.preventDefault();
        let clientX, clientY;
        
        if (e.changedTouches && e.changedTouches.length > 0) {
            clientX = e.changedTouches[0].clientX;
            clientY = e.changedTouches[0].clientY;
        } else {
            clientX = e.clientX;
            clientY = e.clientY;
        }
        
        addPainPoint(clientX, clientY);
    });
}

function renderPainPoints() {
    // Remove old labels
    container.querySelectorAll('.pain-label').forEach(el => el.remove());
    
    // Get current diagram dimensions for scaling
    const rect = diagram.getBoundingClientRect();
    
    // Use consistent icon sizing with perfect centering
    const isVerySmallMobile = window.innerWidth <= 600;
    const isMobile = window.innerWidth <= 768;
    
    let iconSize;
    if (isVerySmallMobile) {
        iconSize = 20;
    } else if (isMobile) {
        iconSize = 24;
    } else {
        iconSize = 36;
    }
    
    // Calculate exact center offset - this ensures consistent positioning across all screen sizes
    const iconOffset = iconSize / 2;
    
    // Render all markings using ONLY percentage coordinates for consistency
    painPoints.forEach(pt => {
        const el = document.createElement('div');
        el.className = 'pain-label';
        
        let x, y;
        
        // Always use percentage coordinates if available (preferred method)
        if (pt.xPercent !== undefined && pt.yPercent !== undefined) {
            // Convert percentage to current diagram size with high precision
            x = (pt.xPercent / 100) * rect.width;
            y = (pt.yPercent / 100) * rect.height;
        } else if (pt.x !== undefined && pt.y !== undefined) {
            // Legacy pixel coordinates - convert to percentages for future consistency
            x = pt.x;
            y = pt.y;
            // Update the point with percentage coordinates for future renders
            pt.xPercent = Math.round(((x / rect.width) * 100) * 1000) / 1000; // 3 decimal places for higher precision
            pt.yPercent = Math.round(((y / rect.height) * 100) * 1000) / 1000;
            // Remove old pixel coordinates
            delete pt.x;
            delete pt.y;
        } else {
            // Fallback to center if no coordinates
            x = rect.width / 2;
            y = rect.height / 2;
        }
        
        // Apply exact centering - subtract half the icon size for perfect positioning
        const leftPos = Math.round(x - iconOffset);
        const topPos = Math.round(y - iconOffset);
        
        el.style.position = 'absolute';
        el.style.left = leftPos + 'px';
        el.style.top = topPos + 'px';
        el.style.background = 'none';
        el.style.width = iconSize + 'px';
        el.style.height = iconSize + 'px';
        el.style.display = 'flex';
        el.style.alignItems = 'center';
        el.style.justifyContent = 'center';
        el.style.pointerEvents = 'none';
        el.innerHTML = getPainSymbolSVG(pt.label, iconSize);
        container.appendChild(el);
    });
    
    // Save updated data with cleaned coordinates
    painPointsInput.value = JSON.stringify(painPoints);
}

function getPainSymbolSVG(label, size) {
    // Use consistent coordinate system regardless of screen size
    // All coordinates are relative to the center (size/2, size/2)
    const center = size / 2;
    const strokeWidth = Math.max(2, size / 12); // Proportional stroke width
    
    // Calculate proportional offsets based on icon size
    const smallOffset = size * 0.25;  // 25% of icon size
    const mediumOffset = size * 0.3;  // 30% of icon size
    const largeOffset = size * 0.35;  // 35% of icon size
    
    switch(label) {
        case 'active pain':
            // V-shaped arrow pointing down - perfectly centered
            return `<svg width='${size}' height='${size}' viewBox='0 0 ${size} ${size}' style='display:block;'>
                <polyline points='${center-mediumOffset},${center+smallOffset} ${center},${center-smallOffset} ${center+mediumOffset},${center+smallOffset}' 
                    fill='none' stroke='#e53935' stroke-width='${strokeWidth}' stroke-linecap='round' stroke-linejoin='round'/>
            </svg>`;
            
        case 'numbness':
            // Perfect circle centered
            const radius = size * 0.3; // 30% of icon size
            return `<svg width='${size}' height='${size}' viewBox='0 0 ${size} ${size}' style='display:block;'>
                <circle cx='${center}' cy='${center}' r='${radius}' 
                    fill='none' stroke='#43a047' stroke-width='${strokeWidth}'/>
            </svg>`;
            
        case 'pins & needles':
            // Vertical line perfectly centered
            return `<svg width='${size}' height='${size}' viewBox='0 0 ${size} ${size}' style='display:block;'>
                <line x1='${center}' y1='${center-mediumOffset}' x2='${center}' y2='${center+mediumOffset}' 
                    stroke='#1e88e5' stroke-width='${strokeWidth}' stroke-linecap='round'/>
            </svg>`;
            
        case 'burning':
            // Square/rectangle perfectly centered
            const rectSize = size * 0.4; // 40% of icon size
            const rectOffset = rectSize / 2;
            return `<svg width='${size}' height='${size}' viewBox='0 0 ${size} ${size}' style='display:block;'>
                <rect x='${center-rectOffset}' y='${center-rectOffset}' width='${rectSize}' height='${rectSize}' 
                    rx='2' fill='#fbc02d' stroke='#fbc02d' stroke-width='1'/>
            </svg>`;
            
        case 'radiating pain':
            // Diagonal line perfectly centered
            return `<svg width='${size}' height='${size}' viewBox='0 0 ${size} ${size}' style='display:block;'>
                <line x1='${center-mediumOffset}' y1='${center-mediumOffset}' x2='${center+mediumOffset}' y2='${center+mediumOffset}' 
                    stroke='#ab47bc' stroke-width='${strokeWidth}' stroke-linecap='round'/>
            </svg>`;
            
        default:
            return '';
    }
}

// Load and render pain points function
function loadAndRenderPainPoints() {
    try {
        if (painPointsInput && painPointsInput.value) {
            const savedPoints = JSON.parse(painPointsInput.value);
            if (Array.isArray(savedPoints)) {
                // Convert any legacy pixel coordinates to percentage coordinates with higher precision
                painPoints = savedPoints.map(pt => {
                    if (pt.xPercent !== undefined && pt.yPercent !== undefined) {
                        // Already has percentage coordinates - ensure proper precision
                        return {
                            xPercent: Math.round(pt.xPercent * 1000) / 1000, // 3 decimal places
                            yPercent: Math.round(pt.yPercent * 1000) / 1000,
                            label: pt.label
                        };
                    } else if (pt.x !== undefined && pt.y !== undefined) {
                        // Convert legacy pixel coordinates to percentages with high precision
                        // Use a standard reference size for conversion (900x320 - the original diagram size)
                        const refWidth = 900;
                        const refHeight = 320;
                        return {
                            xPercent: Math.round(((pt.x / refWidth) * 100) * 1000) / 1000,
                            yPercent: Math.round(((pt.y / refHeight) * 100) * 1000) / 1000,
                            label: pt.label
                        };
                    } else {
                        // Fallback - return as is but with default coordinates
                        return {
                            xPercent: 50.0, // Center with precision
                            yPercent: 50.0,
                            label: pt.label || 'active pain'
                        };
                    }
                });
                
                renderPainPoints();
            }
        }
    } catch (e) { 
        console.warn('Error loading pain points:', e);
        painPoints = [];
    }
}

document.querySelectorAll('.scale-btn').forEach(btn => {
    // Handle both click and touch events for mobile compatibility
    function handleSelection() {
        // Find the associated input
        const input = document.getElementById(btn.getAttribute('for'));
        if (!input) return;
        
        // Get the name of the radio group
        const groupName = input.getAttribute('name');
        
        // Remove selected class from all labels in this group
        document.querySelectorAll('input[name="' + groupName + '"]').forEach(radio => {
            const label = document.querySelector('label[for="' + radio.id + '"]');
            if (label) label.classList.remove('selected');
        });
        
        // Add selected class to the clicked one and select the radio
        btn.classList.add('selected');
        input.checked = true;
    }
    
    // Add click event
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        handleSelection();
    });
    
    // Add touch event for mobile
    btn.addEventListener('touchend', function(e) {
        e.preventDefault();
        handleSelection();
    });
});

// Signature pad logic for main signature
function enableSignaturePad(canvasId, clearBtnId, hiddenInputId) {
    const canvas = document.getElementById(canvasId);
    const clearBtn = document.getElementById(clearBtnId);
    const hiddenInput = document.getElementById(hiddenInputId);
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let drawing = false;
    let lastX = 0, lastY = 0;

    function getPos(e) {
        if (e.touches && e.touches.length === 1) {
            const rect = canvas.getBoundingClientRect();
            return {
                x: e.touches[0].clientX - rect.left,
                y: e.touches[0].clientY - rect.top
            };
        } else {
            const rect = canvas.getBoundingClientRect();
            return {
                x: e.clientX - rect.left,
                y: e.clientY - rect.top
            };
        }
    }

    function startDraw(e) {
        drawing = true;
        const pos = getPos(e);
        lastX = pos.x;
        lastY = pos.y;
        e.preventDefault();
    }
    function draw(e) {
        if (!drawing) return;
        const pos = getPos(e);
        ctx.beginPath();
        ctx.moveTo(lastX, lastY);
        ctx.lineTo(pos.x, pos.y);
        ctx.strokeStyle = '#222';
        ctx.lineWidth = 2;
        ctx.lineCap = 'round';
        ctx.stroke();
        lastX = pos.x;
        lastY = pos.y;
        e.preventDefault();
        // Save to hidden input as base64
        if (hiddenInput) hiddenInput.value = canvas.toDataURL();
    }
    function endDraw(e) {
        drawing = false;
        e.preventDefault();
        // Save to hidden input as base64
        if (hiddenInput) hiddenInput.value = canvas.toDataURL();
    }
    canvas.addEventListener('mousedown', startDraw);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', endDraw);
    canvas.addEventListener('mouseleave', endDraw);
    canvas.addEventListener('touchstart', startDraw);
    canvas.addEventListener('touchmove', draw);
    canvas.addEventListener('touchend', endDraw);
    if (clearBtn) {
        clearBtn.addEventListener('click', function() {
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (hiddenInput) hiddenInput.value = '';
        });
    }
}
enableSignaturePad('sig-canvas', 'sig-clear', 'sig-image');
enableSignaturePad('assist-sig-canvas', 'assist-sig-clear', 'assist-sig-image');

document.addEventListener('DOMContentLoaded', function() {
    var questionnaireForm = document.getElementById('questionnaire-form');
    
    // Fix mobile date input functionality
    function setupMobileDateInputs() {
        const dateInputs = document.querySelectorAll('input[type="date"]');
        dateInputs.forEach(function(input) {
            // Ensure mobile date inputs are clickable and functional
            input.addEventListener('touchstart', function(e) {
                e.stopPropagation();
            });
            
            input.addEventListener('click', function(e) {
                e.stopPropagation();
                // Force focus on mobile devices
                if (window.innerWidth <= 768) {
                    this.focus();
                    this.click();
                }
            });
            
            // Handle mobile-specific date picker opening
            input.addEventListener('touchend', function(e) {
                e.preventDefault();
                this.focus();
                if (this.showPicker && typeof this.showPicker === 'function') {
                    try {
                        this.showPicker();
                    } catch (err) {
                        // Fallback for older browsers
                        this.click();
                    }
                }
            });
        });
    }
    
    // Initialize mobile date input fixes
    setupMobileDateInputs();
    
    // --- Pain Diagram: Load saved markings in read-only/admin view and edit mode ---
    function loadAndRenderPainPoints() {
        try {
            if (painPointsInput && painPointsInput.value) {
                const savedPoints = JSON.parse(painPointsInput.value);
                if (Array.isArray(savedPoints)) {
                    // Convert any legacy pixel coordinates to percentage coordinates with precision
                    painPoints = savedPoints.map(pt => {
                        if (pt.xPercent !== undefined && pt.yPercent !== undefined) {
                            // Already has percentage coordinates - ensure proper precision
                            return {
                                xPercent: Math.round(pt.xPercent * 100) / 100,
                                yPercent: Math.round(pt.yPercent * 100) / 100,
                                label: pt.label
                            };
                        } else if (pt.x !== undefined && pt.y !== undefined) {
                            // Convert legacy pixel coordinates to percentages with high precision
                            // Use a standard reference size for conversion (900x320 - the original diagram size)
                            const refWidth = 900;
                            const refHeight = 320;
                            return {
                                xPercent: Math.round(((pt.x / refWidth) * 100) * 100) / 100,
                                yPercent: Math.round(((pt.y / refHeight) * 100) * 100) / 100,
                                label: pt.label
                            };
                        } else {
                            // Fallback - return as is but with default coordinates
                            return {
                                xPercent: 50.0, // Center with precision
                                yPercent: 50.0,
                                label: pt.label || 'active pain'
                            };
                        }
                    });
                    
                    renderPainPoints();
                }
            }
        } catch (e) { 
            console.warn('Error loading pain points:', e);
            painPoints = [];
        }
    }
    
    // Load pain points when diagram is ready
    if (diagram) {
        if (diagram.complete) {
            // Image already loaded
            loadAndRenderPainPoints();
        } else {
            // Wait for image to load
            diagram.onload = function() {
                loadAndRenderPainPoints();
            };
        }
        
        // Also handle window resize to maintain pixel-perfect positioning
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(function() {
                if (painPoints.length > 0) {
                    // Re-render with percentage-based positioning for perfect consistency
                    renderPainPoints();
                }
            }, 100); // Reduced timeout for faster response
        });
    }
    // --- Pain Scale: Highlight selected labels on load ---
    function initializePainScaleButtons() {
        document.querySelectorAll('.scale-row').forEach(function(row) {
            row.querySelectorAll('input[type="radio"]').forEach(function(radio) {
                var label = document.querySelector('label[for="' + radio.id + '"]');
                if (radio.checked && label) {
                    label.classList.add('selected');
                }
            });
        });
        
        // Also ensure all scale buttons have proper event handlers (both desktop and mobile)
        document.querySelectorAll('.scale-btn').forEach(btn => {
            // Handle both click and touch events for mobile compatibility
            function handleSelection() {
                // Find the associated input
                const input = document.getElementById(btn.getAttribute('for'));
                if (!input) return;
                
                // Get the name of the radio group
                const groupName = input.getAttribute('name');
                
                // Remove selected class from all labels in this group
                document.querySelectorAll('input[name="' + groupName + '"]').forEach(radio => {
                    const label = document.querySelector('label[for="' + radio.id + '"]');
                    if (label) label.classList.remove('selected');
                });
                
                // Add selected class to the clicked one and select the radio
                btn.classList.add('selected');
                input.checked = true;
                
                // Trigger change event for syncing
                input.dispatchEvent(new Event('change'));
            }
            
            // Remove any existing event listeners to avoid duplicates
            btn.removeEventListener('click', handleSelection);
            btn.removeEventListener('touchend', handleSelection);
            
            // Add click event
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                handleSelection();
            });
            
            // Add touch event for mobile
            btn.addEventListener('touchend', function(e) {
                e.preventDefault();
                e.stopPropagation();
                handleSelection();
            });
        });
    }
    
    // Initialize pain scale buttons
    initializePainScaleButtons();
    
    // Sync mobile and desktop pain scale inputs
    function syncPainScaleInputs() {
        // Sync mobile worst to desktop worst
        document.querySelectorAll('input[name="headache_worst_mobile"]').forEach(function(mobileInput) {
            mobileInput.addEventListener('change', function() {
                if (this.checked) {
                    const desktopInput = document.getElementById('headache_worst_' + this.value);
                    if (desktopInput) {
                        desktopInput.checked = true;
                        // Update visual state
                        const desktopLabel = document.querySelector('label[for="headache_worst_' + this.value + '"]');
                        if (desktopLabel) {
                            // Remove selected from other desktop labels
                            document.querySelectorAll('input[name="headache_worst"]').forEach(function(radio) {
                                const label = document.querySelector('label[for="' + radio.id + '"]');
                                if (label) label.classList.remove('selected');
                            });
                            desktopLabel.classList.add('selected');
                        }
                    }
                }
            });
        });
        
        // Sync mobile best to desktop best
        document.querySelectorAll('input[name="headache_best_mobile"]').forEach(function(mobileInput) {
            mobileInput.addEventListener('change', function() {
                if (this.checked) {
                    const desktopInput = document.getElementById('headache_best_' + this.value);
                    if (desktopInput) {
                        desktopInput.checked = true;
                        // Update visual state
                        const desktopLabel = document.querySelector('label[for="headache_best_' + this.value + '"]');
                        if (desktopLabel) {
                            // Remove selected from other desktop labels
                            document.querySelectorAll('input[name="headache_best"]').forEach(function(radio) {
                                const label = document.querySelector('label[for="' + radio.id + '"]');
                                if (label) label.classList.remove('selected');
                            });
                            desktopLabel.classList.add('selected');
                        }
                    }
                }
            });
        });
        
        // Sync desktop to mobile (for initial load)
        document.querySelectorAll('input[name="headache_worst"]').forEach(function(desktopInput) {
            if (desktopInput.checked) {
                const mobileInput = document.getElementById('headache_worst_mobile_' + desktopInput.value);
                if (mobileInput) {
                    mobileInput.checked = true;
                    const mobileLabel = document.querySelector('label[for="headache_worst_mobile_' + desktopInput.value + '"]');
                    if (mobileLabel) mobileLabel.classList.add('selected');
                }
            }
        });
        
        document.querySelectorAll('input[name="headache_best"]').forEach(function(desktopInput) {
            if (desktopInput.checked) {
                const mobileInput = document.getElementById('headache_best_mobile_' + desktopInput.value);
                if (mobileInput) {
                    mobileInput.checked = true;
                    const mobileLabel = document.querySelector('label[for="headache_best_mobile_' + desktopInput.value + '"]');
                    if (mobileLabel) mobileLabel.classList.add('selected');
                }
            }
        });
    }
    
    // Initialize syncing
    syncPainScaleInputs();
    if (questionnaireForm) {
        // Fix submit/save draft button logic
        var submitBtn = document.getElementById('submit-btn');
        var saveDraftBtn = document.getElementById('save-draft');
        if (submitBtn) {
            submitBtn.addEventListener('click', function(e) {
                document.getElementById('form-action-type').value = 'submit';
            });
        }
        if (saveDraftBtn) {
            saveDraftBtn.addEventListener('click', function(e) {
                document.getElementById('form-action-type').value = 'draft';
            });
        }
        questionnaireForm.addEventListener('submit', function(e) {
            // Only use AJAX for patient form, not for admin
            var isAdmin = {{ auth()->user()->isAdmin() ? 'true' : 'false' }};
            if (!isAdmin) {
                e.preventDefault();
                var formData = new FormData(questionnaireForm);
                
                const saveStatusDiv = document.getElementById('save-status');
                
                // Show simple loading message
                saveStatusDiv.innerHTML = `
                    <div style="background: #e3f2fd; border: 1px solid #2196f3; color: #1565c0; padding: 12px 16px; border-radius: 6px; margin: 16px 0; font-size: 1rem; text-align: center;">
                        <div style="display: flex; align-items: center; justify-content: center; gap: 10px;">
                            <div style="width: 20px; height: 20px; border: 2px solid #2196f3; border-top: 2px solid transparent; border-radius: 50%; animation: spin 1s linear infinite;"></div>
                            <span>Processing your submission...</span>
                        </div>
                    </div>
                `;
                
                fetch(questionnaireForm.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.status === 'submitted') {
                            // Professional submission success message
                            saveStatusDiv.innerHTML = `
                                <div style="background: linear-gradient(135deg, #e8f5e8 0%, #c8e6c9 100%); border: 1px solid #4caf50; color: #1b5e20; padding: 24px 28px; border-radius: 12px; margin: 20px 0; font-size: 1rem; box-shadow: 0 6px 16px rgba(76, 175, 80, 0.15);">
                                    <div style="display: flex; align-items: flex-start; gap: 16px;">
                                        <div style="background: #4caf50; color: white; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; font-weight: bold; flex-shrink: 0;">✓</div>
                                        <div style="flex: 1;">
                                            <div style="font-weight: 700; font-size: 1.15rem; margin-bottom: 8px; color: #2e7d32;">
                                                Questionnaire Successfully Submitted
                                            </div>
                                            <div style="margin-bottom: 12px; line-height: 1.5;">
                                                Thank you for completing your headache questionnaire. Your responses have been securely transmitted to <strong>Texas Brain Institute</strong> and will be reviewed by our medical team.
                                            </div>
                                            <div style="background: rgba(255, 255, 255, 0.6); padding: 12px 16px; border-radius: 6px; margin-bottom: 12px;">
                                                <div style="font-weight: 600; color: #2e7d32; margin-bottom: 4px;">📋 What Happens Next:</div>
                                                <ul style="margin: 0; padding-left: 16px; color: #388e3c;">
                                                    <li>Medical team review (within 24-48 hours)</li>
                                                    <li>Appointment scheduling confirmation</li>
                                                    <li>Treatment plan development</li>
                                                </ul>
                                            </div>
                                            <div style="font-size: 0.9rem; color: #388e3c;">
                                                <strong>📞 Questions?</strong> Contact us at <strong>1-888-900-1TBI</strong> or <strong>contact@tbi.clinic</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div style="margin-top: 16px; padding-top: 16px; border-top: 1px solid rgba(76, 175, 80, 0.2); text-align: center;">
                                        <div style="font-size: 0.85rem; color: #388e3c;">
                                            Redirecting to dashboard in <span id="countdown">3</span> seconds...
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            // Countdown and redirect
                            let countdown = 3;
                            const countdownElement = document.getElementById('countdown');
                            const countdownInterval = setInterval(() => {
                                countdown--;
                                if (countdownElement) countdownElement.textContent = countdown;
                                if (countdown <= 0) {
                                    clearInterval(countdownInterval);
                                    window.location.href = '{{ route('dashboard') }}';
                                }
                            }, 1000);
                            
                        } else {
                            // Professional draft saved message
                            saveStatusDiv.innerHTML = `
                                <div style="background: linear-gradient(135deg, #fff8e1 0%, #ffecb3 100%); border: 1px solid #ffa726; color: #e65100; padding: 16px 20px; border-radius: 8px; margin: 16px 0; font-size: 1rem; box-shadow: 0 3px 10px rgba(255, 167, 38, 0.1);">
                                    <div style="display: flex; align-items: center; gap: 12px;">
                                        <div style="background: #ffa726; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem;">💾</div>
                                        <div>
                                            <div style="font-weight: 600; margin-bottom: 4px;">Progress Saved Successfully</div>
                                            <div style="font-size: 0.9rem;">Your responses have been saved. You can return to complete this questionnaire anytime.</div>
                                        </div>
                                    </div>
                                </div>
                            `;
                            
                            setTimeout(() => {
                                saveStatusDiv.innerHTML = '';
                            }, 7000);
                        }
                    } else {
                        // Professional error message
                        saveStatusDiv.innerHTML = `
                            <div style="background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%); border: 1px solid #f44336; color: #b71c1c; padding: 16px 20px; border-radius: 8px; margin: 16px 0; font-size: 1rem; box-shadow: 0 3px 10px rgba(244, 67, 54, 0.1);">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div style="background: #f44336; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem;">⚠</div>
                                    <div>
                                        <div style="font-weight: 600; margin-bottom: 4px;">Submission Error</div>
                                        <div style="font-size: 0.9rem; margin-bottom: 6px;">Unable to submit your questionnaire. Please try again.</div>
                                        <div style="font-size: 0.85rem;">If this issue persists, contact us at <strong>1-888-900-1TBI</strong></div>
                                    </div>
                                </div>
                            </div>
                        `;
                        
                        // Scroll to error message
                        scrollToMessage(saveStatusDiv);
                        
                        // Scroll to error message
                        setTimeout(() => {
                            saveStatusDiv.scrollIntoView({ 
                                behavior: 'smooth', 
                                block: 'center' 
                            });
                        }, 100);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    saveStatusDiv.innerHTML = `
                        <div style="background: linear-gradient(135deg, #ffebee 0%, #ffcdd2 100%); border: 1px solid #f44336; color: #b71c1c; padding: 16px 20px; border-radius: 8px; margin: 16px 0; font-size: 1rem; box-shadow: 0 3px 10px rgba(244, 67, 54, 0.1);">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="background: #f44336; color: white; width: 28px; height: 28px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1rem;">📡</div>
                                <div>
                                    <div style="font-weight: 600; margin-bottom: 4px;">Connection Error</div>
                                    <div style="font-size: 0.9rem; margin-bottom: 6px;">Unable to connect to our servers. Please check your internet connection and try again.</div>
                                    <div style="font-size: 0.85rem;">Need assistance? Call us at <strong>1-888-900-1TBI</strong></div>
                                </div>
                            </div>
                        </div>
                    `;
                });
            }
        });
    }
});

var resetBtn = document.getElementById('reset-btn');
if (resetBtn) {
    resetBtn.addEventListener('click', function() {
        // Unselect all custom pain scale buttons
        setTimeout(function() {
            document.querySelectorAll('.scale-btn.selected').forEach(btn => btn.classList.remove('selected'));
            // Explicitly clear all text and date inputs (including the new patient info fields)
            questionnaireForm.querySelectorAll('input[type="text"], input[type="date"]').forEach(input => input.value = '');
            // Explicitly uncheck all checkboxes and radios
            questionnaireForm.querySelectorAll('input[type="checkbox"], input[type="radio"]').forEach(input => input.checked = false);
        }, 0);

        // Clear signature canvases
        function clearCanvas(canvasId) {
            const canvas = document.getElementById(canvasId);
            if (canvas) {
                const ctx = canvas.getContext('2d');
                ctx.clearRect(0, 0, canvas.width, canvas.height);
            }
        }
        clearCanvas('sig-canvas');
        clearCanvas('assist-sig-canvas');

        // Clear pain diagram markings with new data structure
        if (typeof painPoints !== 'undefined') {
            painPoints = [];
            if (painPointsInput) painPointsInput.value = '';
            if (typeof renderPainPoints === 'function') renderPainPoints();
        }
        
        // Clear selected pain symbol
        if (typeof selectedPainLabel !== 'undefined') {
            selectedPainLabel = null;
            // Remove outline from all pain symbols
            document.querySelectorAll('.pain-symbol').forEach(symbol => {
                symbol.style.outline = '';
            });
        }
        
        // Clear any success/error messages
        const saveStatusDiv = document.getElementById('save-status');
        if (saveStatusDiv) {
            saveStatusDiv.innerHTML = '';
        }
    });
}
</script>
@endsection