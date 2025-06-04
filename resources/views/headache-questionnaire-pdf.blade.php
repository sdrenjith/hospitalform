<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Headache Questionnaire</title>
    <style>
        body, .pdf-form-container, .pdf-header-row, .pdf-header-col, .pdf-header-logo, .pdf-header-title, .pdf-header-sub, .pdf-important, .pdf-form-section, .pdf-form-table, .pdf-form-label, .pdf-form-input, .pdf-form-logo, .pdf-form-diagram {
            font-family: Arial, Helvetica, sans-serif !important;
            font-size: 0.75rem;
        }
        .pdf-form-container {
            background: #fff;
            border: none;
            padding: 0 0 32px 0;
            margin: 0 0.8rem 0 0.8rem;
            width: 97%;
            min-width: 340px;
            max-width: 1200px;
        }
        .pdf-header-row { width: 100%; border-collapse:collapse; }
        .pdf-header-col, .pdf-header-logo { vertical-align: middle; padding: 0 8px; font-size: 0.85rem; }
        .pdf-header-logo img { height: 70px; width: auto; margin-bottom: 0; margin-top: 0; display: block; }
        .pdf-header-title { font-size: 1.05rem; font-weight: bold; margin-bottom: 0; margin-top: 32px; letter-spacing: 0.5px; }
        .pdf-header-sub { font-size: 0.9rem; margin-bottom: 10px; }
        .pdf-important { background: #e3f3fa; border: 1.5px solid #b5d6e6; color: #222; padding: 10px 14px; border-radius: 4px; margin: 18px 0 18px 0; font-size: 0.98rem; }
        .pdf-form-label { font-weight: bold; margin-bottom: 6px; display: block; }
        .pdf-form-table td, .pdf-form-table th { padding: 6px 4px !important; line-height: 1.5; border: 1px solid #333; font-size: 0.98rem; }
        .pdf-form-table { border-collapse:collapse; width:100%; margin-bottom:20px; }
        .scale-btn { min-width: 28px; height: 28px; line-height: 28px; font-size: 1rem; border-radius: 5px; margin: 0 2px; padding: 0 0.3em; border: 1px solid #888; display: inline-block; text-align: center; }
        .pdf-form-section { margin-bottom: 18px; }
        .pdf-patient-info-table td { font-size: 0.82rem; padding: 2px 2px; vertical-align: bottom; }
        .pdf-patient-info-label { white-space:nowrap; font-weight:normal; padding-right:2px; }
        .pdf-patient-info-value { border-bottom:1px solid #222; font-weight:bold; min-width:48px; display:inline-block; font-size:0.82rem; margin-right:18px; }
        .pdf-patient-info-label-value { white-space:nowrap; font-size:0.82rem; }
        .pdf-patient-info-value-inline { border-bottom:1px solid #222; font-weight:bold; min-width:48px; display:inline-block; font-size:0.82rem; margin-left:3px; vertical-align:baseline; }
        .pdf-header-col div[style*='font-weight:bold'] { font-size: 0.93rem !important; }
        .pdf-checkbox { font-size: 1.2em; vertical-align: middle; }
        .pdf-radio { font-size: 1.2em; vertical-align: middle; }
        .pdf-signature { border: 1.5px solid #888; border-radius: 4px; background: #fafafa; width: 480px; height: 80px; object-fit: contain; }
        .pdf-pain-diagram { position: relative; display: inline-block; width: 100%; }
        .pdf-pain-label { position: absolute; background: none; color: #222; border-radius: 4px; font-size: 12px; pointer-events: none; }
    </style>
</head>
<body>
<div class="pdf-form-container pdf-font" style="margin-top:18px;">
    <table class="pdf-header-row" style="margin-bottom:10px;">
        <tr>
            <td class="pdf-header-col" style="text-align:left;line-height:1.5;">
                <div style="font-weight:bold;font-size:1.1rem;">Houston Medical Center</div>
                <div>7205 Fannin<br>Suite 110B<br>Houston, TX 77030</div>
            </td>
            <td class="pdf-header-col" style="text-align:left;line-height:1.5;">
                <div style="font-weight:bold;font-size:1.1rem;">Dallas-Fort Worth</div>
                <div>405 State Highway 121<br>Bldg. A, Suite 150<br>Lewisville, TX 75067</div>
            </td>
            <td class="pdf-header-col" style="text-align:left;line-height:1.5;min-width:180px;">
                <div><span style="font-weight:bold;">Phone</span> 1-888-900-1TBI</div>
                <div><span style="font-weight:bold;">Fax</span> 713-779-3400</div>
                <div><span style="font-weight:bold;">Email</span> contact@tbi.clinic</div>
            </td>
            <td class="pdf-header-logo">
                <img src="{{ public_path('logo.png') }}" />
            </td>
        </tr>
    </table>
    <div style="text-align:center;margin-bottom:30px;margin-top:50px;">
        <div style="font-size:1.5rem;font-weight:400;letter-spacing:1px;">HEADACHE QUESTIONNAIRE</div>
        <div style="font-size:0.92rem;letter-spacing:0.5px;">APPROVED BY TEXAS BRAIN INSTITUTE LLC: FORM TBI042125HEADACHE</div>
    </div>
    <div class="pdf-important">
        <b>IMPORTANT:</b> We understand suffering from a brain injury can be very difficult and we sympathize with you. Please try and answer the questions below to the best of your ability to help us to fully understand your brain injury and headaches. These questions relate to if <b style="font-weight:bold;color:#1976d2;">the symptoms are NEW</b> after your accident.
    </div>
    <!-- Patient Info Table -->
    <table class="pdf-patient-info-table" style="width:100%; max-width:100%; margin-top:18px; margin-bottom:18px; border-collapse:collapse; table-layout:fixed; font-size:1.18rem;">
        <tr>
            <td class="pdf-patient-info-label-value">First Name: <span class="pdf-patient-info-value-inline">{{ $data['patient_first_name'] ?? '' }}</span></td>
            <td class="pdf-patient-info-label-value">Last Name: <span class="pdf-patient-info-value-inline">{{ $data['patient_last_name'] ?? '' }}</span></td>
            <td class="pdf-patient-info-label-value">DOB: <span class="pdf-patient-info-value-inline">{{ $data['patient_dob'] ?? '' }}</span></td>
            <td class="pdf-patient-info-label-value">MRN#: <span class="pdf-patient-info-value-inline">{{ $data['patient_mrn'] ?? '' }}</span></td>
        </tr>
    </table>
    <!-- Questions 1-11 Table -->
    <table class="pdf-form-table" style="width:100%;border-collapse:collapse;margin-bottom:24px;">
        <tbody>
            <tr>
                <td>1</td>
                <td>Are you experiencing any headaches:</td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q1'] ?? '') === 'Y' ? '☑' : '☐' }}</span> Y
                </td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q1'] ?? '') === 'N' ? '☑' : '☐' }}</span> N
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Did the headaches start or worsen after the accident/incident described above</td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q2'] ?? '') === 'Y' ? '☑' : '☐' }}</span> Y
                </td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q2'] ?? '') === 'N' ? '☑' : '☐' }}</span> N
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Were the headaches caused by the above accident?</td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q3'] ?? '') === 'Y' ? '☑' : '☐' }}</span> Y
                </td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q3'] ?? '') === 'N' ? '☑' : '☐' }}</span> N
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>When did the headaches start?</td>
                <td colspan="2">Date: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['q4'] ?? '' }}</span></td>
            </tr>
            <tr>
                <td>5</td>
                <td>When did the headaches get worse?</td>
                <td colspan="2">Date: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['q5'] ?? '' }}</span></td>
            </tr>
            <tr>
                <td>6</td>
                <td colspan="3">
                    Where are the headaches located?
                    @if(!empty($data['headache_location_front']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> In the front</span>@endif
                    @if(!empty($data['headache_location_back']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> In the back</span>@endif
                    @if(!empty($data['headache_location_sides']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> On the sides (temples)</span>@endif
                    @if(!empty($data['headache_location_top']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> On the top</span>@endif
                    @if(!empty($data['headache_location_left']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> On the left side</span>@endif
                    @if(!empty($data['headache_location_right']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> On the right side</span>@endif
                    @if(!empty($data['headache_location_left_eye']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> Behind the left eye</span>@endif
                    @if(!empty($data['headache_location_right_eye']))<span style="margin-left:12px;"><span class="pdf-checkbox">☑</span> Behind the right eye</span>@endif
                </td>
            </tr>
            <tr>
                <td>7</td>
                <td colspan="3">
                    Headaches occurs with the following frequency
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_frequency_occasionally']) ? '☑' : '☐' }}</span> occasionally</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_frequency_on_off']) ? '☑' : '☐' }}</span> on and off</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_frequency_all_time']) ? '☑' : '☐' }}</span> all the time</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_frequency_throughout_day']) ? '☑' : '☐' }}</span> throughout the day</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_frequency_at_night']) ? '☑' : '☐' }}</span> at night</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_frequency_no_difference']) ? '☑' : '☐' }}</span> no difference</span>
                </td>
            </tr>
            <tr>
                <td>8</td>
                <td colspan="3">
                    Each episode of headache usually lasts:
                    <span style="border-bottom:1px solid #888;min-width:80px;display:inline-block;">{{ $data['q8_duration'] ?? '' }}</span><br>
                    <span><span class="pdf-checkbox">{{ !empty($data['headache_duration_seconds']) ? '☑' : '☐' }}</span> seconds</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_duration_minutes']) ? '☑' : '☐' }}</span> minutes</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_duration_hours']) ? '☑' : '☐' }}</span> hours</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_duration_days']) ? '☑' : '☐' }}</span> days</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_duration_week']) ? '☑' : '☐' }}</span> week</span>
                </td>
            </tr>
            <tr>
                <td>9</td>
                <td colspan="3">
                    Headaches feels like
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_dull_aching']) ? '☑' : '☐' }}</span> a dull aching</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_sharp']) ? '☑' : '☐' }}</span> sharp</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_stabbing']) ? '☑' : '☐' }}</span> stabbing</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_burning']) ? '☑' : '☐' }}</span> burning</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_cramping']) ? '☑' : '☐' }}</span> cramping</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_throbbing']) ? '☑' : '☐' }}</span> throbbing</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_pressure']) ? '☑' : '☐' }}</span> pressure</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_squeezing']) ? '☑' : '☐' }}</span> squeezing</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_dull']) ? '☑' : '☐' }}</span> dull</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_other']) ? '☑' : '☐' }}</span> other: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['headache_intensity_other_details'] ?? '' }}</span></span>
                </td>
            </tr>
            <tr>
                <td>10</td>
                <td colspan="3">
                    Intensity of Headache (scale of 1-10):
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_0']) ? '☑' : '☐' }}</span> no pain (0)</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_1_2']) ? '☑' : '☐' }}</span> mild pain (1-2)</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_3_4']) ? '☑' : '☐' }}</span> moderate pain (3-4)</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_5_6']) ? '☑' : '☐' }}</span> severe pain (5-6)</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_7_8']) ? '☑' : '☐' }}</span> very severe pain (7-8)</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_intensity_9_10']) ? '☑' : '☐' }}</span> worst possible pain (9-10)</span>
                </td>
            </tr>
            <tr>
                <td>11</td>
                <td>There is associated pain or tension in the neck:</td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q11'] ?? '') === 'Y' ? '☑' : '☐' }}</span> Y
                </td>
                <td style="text-align:center;vertical-align:middle;">
                    <span class="pdf-checkbox">{{ ($data['q11'] ?? '') === 'N' ? '☑' : '☐' }}</span> N
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Activities Table (Q12) -->
    <table style="width:100%;border-collapse:collapse;margin-bottom:0;">
        <tr><td style="font-weight:bold;font-size:1.25rem;background:#e3f3fa;padding:10px 0 10px 8px;" colspan="5">12. Activities Affecting Headaches</td></tr>
    </table>
    <table class="pdf-form-table" style="width:100%;border-collapse:collapse;margin-bottom:24px;">
        <thead>
            <tr>
                <th style="width:5%;text-align:center;">&nbsp;</th>
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
                <td style="text-align:center;"><span class="pdf-checkbox">{{ ($data['activity_'.$label] ?? '') === 'better' ? '☑' : '☐' }}</span></td>
                <td style="text-align:center;"><span class="pdf-checkbox">{{ ($data['activity_'.$label] ?? '') === 'worse' ? '☑' : '☐' }}</span></td>
                <td style="text-align:center;"><span class="pdf-checkbox">{{ ($data['activity_'.$label] ?? '') === 'not_applicable' ? '☑' : '☐' }}</span></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Associated Symptoms Table (Q13) -->
    <table class="pdf-form-table" style="width:100%;border-collapse:collapse;margin-bottom:24px;margin-top:48px;">
        <tr><td colspan="3" style="font-weight:bold;font-size:1.25rem;background:#e3f3fa;">13. Associated Symptoms</td></tr>
        <tbody>
            <tr>
                <td class="question-num" style="vertical-align:top;width:36px;">a</td>
                <td style="font-weight:bold;vertical-align:top;width:15%;">General:</td>
                <td>
                    <span><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_nausea']) ? '☑' : '☐' }}</span> nausea</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_vomiting']) ? '☑' : '☐' }}</span> vomiting</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_dizziness']) ? '☑' : '☐' }}</span> dizziness</span>
                    <div style="margin-top:4px;">
                        Details: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['headache_associated_symptoms_details_a'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="question-num" style="vertical-align:top;width:36px;">b</td>
                <td style="font-weight:bold;vertical-align:top;width:15%;">Vision:</td>
                <td>
                    <span><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_blind_spots']) ? '☑' : '☐' }}</span> blind spots</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_sensitivity_to_light']) ? '☑' : '☐' }}</span> sensitivity to light</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_blurred_vision']) ? '☑' : '☐' }}</span> blurred vision</span>
                    <div style="margin-top:4px;">
                        Details: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['headache_associated_symptoms_details_b'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="question-num" style="vertical-align:top;width:36px;">c</td>
                <td style="font-weight:bold;vertical-align:top;width:15%;">Sensory:</td>
                <td>
                    <span><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_head_pain']) ? '☑' : '☐' }}</span> head pain</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_head_numbness']) ? '☑' : '☐' }}</span> head numbness</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_head_tingling']) ? '☑' : '☐' }}</span> head tingling</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_sensitivity_to_sound']) ? '☑' : '☐' }}</span> sensitivity to sound</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_loss_of_taste']) ? '☑' : '☐' }}</span> loss of sense of taste</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_loss_of_smell']) ? '☑' : '☐' }}</span> loss of sense of smell</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_arm_or_leg_numbness']) ? '☑' : '☐' }}</span> arm or leg numbness</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_arm_or_leg_tingling']) ? '☑' : '☐' }}</span> arm or leg tingling</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_insomnia']) ? '☑' : '☐' }}</span> insomnia</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_drowsiness']) ? '☑' : '☐' }}</span> drowsiness</span>
                    <div style="margin-top:4px;">
                        Details: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['headache_associated_symptoms_details_c'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="question-num" style="vertical-align:top;width:36px;">d</td>
                <td style="font-weight:bold;vertical-align:top;width:15%;">Cognitive:</td>
                <td>
                    <span><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_memory_difficulties']) ? '☑' : '☐' }}</span> memory difficulties</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_concentration_problems']) ? '☑' : '☐' }}</span> concentration problems</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_mental_fogginess']) ? '☑' : '☐' }}</span> mental fogginess</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_learning_disabilities']) ? '☑' : '☐' }}</span> learning disabilities</span>
                    <div style="margin-top:4px;">
                        Details: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['headache_associated_symptoms_details_d'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="question-num" style="vertical-align:top;width:36px;">e</td>
                <td style="font-weight:bold;vertical-align:top;width:15%;">Psychological:</td>
                <td>
                    <span><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_irritability']) ? '☑' : '☐' }}</span> irritability</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_depression']) ? '☑' : '☐' }}</span> depression</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_anxiety']) ? '☑' : '☐' }}</span> anxiety</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_mood_changes']) ? '☑' : '☐' }}</span> mood changes</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_attention_deficit']) ? '☑' : '☐' }}</span> attention deficit</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_hyperactivity']) ? '☑' : '☐' }}</span> hyperactivity</span>
                    <span style="margin-left:12px;"><span class="pdf-checkbox">{{ !empty($data['headache_associated_symptoms_anger']) ? '☑' : '☐' }}</span> anger</span>
                    <div style="margin-top:4px;">
                        Details: <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['headache_associated_symptoms_details_e'] ?? '' }}</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <!-- Signature and Consent Section (single page, improved spacing and font) -->
    <div style="page-break-before: always;"></div>
    <table style="width:100%;border-collapse:collapse;margin-bottom:32px;font-family:Arial,Helvetica,sans-serif;font-size:1.08rem;line-height:1.6;margin-top:40px;">
        <tr>
            <td colspan="3" style="padding-bottom:10px;padding-top:18px;">
                <span style="font-size:1.05rem;">Patient's Name: <span style="border-bottom:1px solid #888;min-width:220px;display:inline-block;vertical-align:bottom;">{{ $data['sig_patient_name'] ?? '' }}</span></span>
                <span style="margin-left:18px;font-size:1.05rem;">Date of Birth: <span style="border-bottom:1px solid #888;min-width:100px;display:inline-block;vertical-align:bottom;">{{ $data['dob'] ?? '' }}</span></span>
                <span style="margin-left:18px;font-size:1.05rem;">Date of Service: <span style="border-bottom:1px solid #888;min-width:100px;display:inline-block;vertical-align:bottom;">{{ $data['sig_date'] ?? '' }}</span></span>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:18px;padding-top:36px;">
                <span style="font-size:1.15em;vertical-align:middle;margin-right:6px;">{!! !empty($data['agree_signature']) ? '☑' : '☐' !!}</span>
                <b style="font-size:1.08rem;"> Electronic Signature Disclosure and Consent:</b><br>
                <span style="font-size:1.01rem;">By selecting the "I agree" button, I am signing this document electronically. I agree that my electronic signature is the legal equivalent of my manual/handwritten signature on this document. By selecting "I agree" using any device, means, or action, I consent to the legally binding terms and conditions of this document. I further agree that my signature on this document is as valid as if I signed the document in writing.</span>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:18px;">
                <span style="font-size:1.15em;vertical-align:middle;margin-right:6px;">{!! !empty($data['authentication']) ? '☑' : '☐' !!}</span>
                <b style="font-size:1.08rem;"> Authentication/Endorsement:</b><br>
                <span style="font-size:1.01rem;">I confirm that the information given above is correct to the best of my knowledge. I have read and understood the contents of this form and I take full responsibility for the information given above. I have had the opportunity to ask questions regarding the Headache Questionnaire. By signing my name electronically on this form, I am agreeing that my electronic signature is the legal equivalent of my manual signature.</span>
            </td>
        </tr>
        <tr>
            <td style="width:40%;padding-bottom:10px;vertical-align:bottom;">Patient's Name : <span style="border-bottom:1px solid #888;min-width:180px;display:inline-block;">{{ $data['sig_patient_name'] ?? '' }}</span></td>
            <td style="width:30%;padding-bottom:10px;vertical-align:bottom;">Date : <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['sig_date'] ?? '' }}</span></td>
            <td style="width:30%;padding-bottom:0;vertical-align:bottom;"></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:24px;padding-top:0;">
                <span style="font-size:1.05rem;font-weight:bold;">Signature :</span><br>
                @if(!empty($data['sig_image']))<img src="{{ $data['sig_image'] }}" alt="Signature" style="border:1.5px solid #888;border-radius:4px;background:#fafafa;width:320px;height:60px;object-fit:contain;margin-top:4px;" />@endif
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:18px;padding-top:10px; font-size:1.05rem; font-weight:bold;">If you have been assisted in filling out the questions above, please provide name and signature below:</td>
        </tr>
        <tr>
            <td style="width:40%;padding-bottom:10px;vertical-align:bottom;">Name : <span style="border-bottom:1px solid #888;min-width:180px;display:inline-block;">{{ $data['assist_name'] ?? '' }}</span></td>
            <td style="width:30%;padding-bottom:10px;vertical-align:bottom;">Date : <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['assist_date'] ?? '' }}</span></td>
            <td style="width:30%;padding-bottom:0;vertical-align:bottom;"></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:10px;padding-top:0; font-size:1.02rem;">Relationship : <span style="border-bottom:1px solid #888;min-width:120px;display:inline-block;">{{ $data['assist_relationship'] ?? '' }}</span></td>
        </tr>
        <tr>
            <td colspan="3" style="padding-bottom:28px;padding-top:0;">
                <span style="font-size:1.05rem;font-weight:bold;">Signature :</span><br>
                @if(!empty($data['assist_sig_image']))<img src="{{ $data['assist_sig_image'] }}" alt="Assistant Signature" style="border:1.5px solid #888;border-radius:4px;background:#fafafa;width:320px;height:60px;object-fit:contain;margin-top:6px;" />@endif
            </td>
        </tr>
    </table>
    <!-- Headache Diagram and Pain Scale Section (last page) -->
    <div style="page-break-before: always;"></div>
    <!-- Headache Diagram Section -->
    <table style="width:100%;border-collapse:collapse;margin-bottom:24px;margin-top:56px;">
        <tr>
            <td colspan="2" style="padding-bottom:40px;">
                <span style="font-size:0.9rem;">Patient's Name:</span><span style="border-bottom:1px solid #888;min-width:220px;display:inline-block;vertical-align:bottom;">{{ $data['pain_patient_name'] ?? '' }}</span>
                <span style="margin-left:18px;font-size:0.9rem;">Date of Birth:</span><span style="border-bottom:1px solid #888;min-width:100px;display:inline-block;vertical-align:bottom;">{{ $data['dob'] ?? '' }}</span>
                <span style="margin-left:18px;font-size:0.9rem;">Date of Service:</span><span style="border-bottom:1px solid #888;min-width:100px;display:inline-block;vertical-align:bottom;">{{ $data['pain_date'] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-bottom:0;">
                <div style="background:#e3e6ea;font-weight:bold;font-size:1.25rem;text-align:center;padding:12px 0 12px 0;margin-bottom:16px;">HEADACHE DIAGRAM</div>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-bottom:8px;">
                <span style="font-size:0.9rem;">Patient Name:</span> <span style="border-bottom:1px solid #888;min-width:180px;display:inline-block;vertical-align:bottom;">{{ $data['pain_patient_name'] ?? '' }}</span>
                <span style="margin-left:18px;font-size:0.9rem;">Date:</span> <span style="border-bottom:1px solid #888;min-width:100px;display:inline-block;vertical-align:bottom;">{{ $data['pain_date'] ?? '' }}</span>
                <span style="margin-left:18px;font-size:0.9rem;">Age:</span> <span style="border-bottom:1px solid #888;min-width:50px;display:inline-block;vertical-align:bottom;">{{ $data['pain_age'] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-bottom:8px;">
                <span style="font-weight:bold;">Where is your pain now?</span> Please mark the areas of pain using the symbols indicated below.<br>
                <span style="font-size:0.92em;">(please take some time and be as accurate as possible):</span>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding-bottom:12px;">
                <!-- Legend -->
                <table style="width:100%;border-collapse:collapse;background:#f6fafd;">
                    <tr>
                        <td style="padding:6px 12px;text-align:center;">
                            <svg width="38" height="18"><polyline points="2,16 10,4 18,16 26,4 34,16" fill="none" stroke="#e53935" stroke-width="2.5"/></svg><br>
                            <span style="font-size:0.85em;">active<br>pain</span>
                        </td>
                        <td style="padding:6px 12px;text-align:center;">
                            <svg width="38" height="18"><g>
                                <circle cx="8" cy="9" r="6" fill="none" stroke="#43a047" stroke-width="2"/>
                                <circle cx="30" cy="9" r="6" fill="none" stroke="#43a047" stroke-width="2"/>
                            </g></svg><br>
                            <span style="font-size:0.85em;">numbness</span>
                        </td>
                        <td style="padding:6px 12px;text-align:center;">
                            <svg width="38" height="18"><g>
                                <line x1="8" y1="4" x2="8" y2="14" stroke="#1e88e5" stroke-width="2.5"/>
                                <line x1="30" y1="4" x2="30" y2="14" stroke="#1e88e5" stroke-width="2.5"/>
                            </g></svg><br>
                            <span style="font-size:0.85em;">pins &<br>needles</span>
                        </td>
                        <td style="padding:6px 12px;text-align:center;">
                            <svg width="38" height="18"><rect x="10" y="5" width="8" height="8" rx="2" fill="#fbc02d"/></svg><br>
                            <span style="font-size:0.85em;">burning</span>
                        </td>
                        <td style="padding:6px 12px;text-align:center;">
                            <svg width="38" height="18"><g>
                                <line x1="10" y1="10" x2="30" y2="22" stroke="#ab47bc" stroke-width="3"/>
                            </g></svg><br>
                            <span style="font-size:0.85em;">radiating<br>pain</span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center; position:relative; height:320px;">
                <div style="display:inline-block; position:relative; width:900px; height:300px; border:1.5px solid #888; background:#fff;">
                    <img src="{{ public_path('storage/headache-diagram.png') }}" alt="Pain Diagram" style="width:900px; height:300px; display:block;" />
                    @if(!empty($data['pain_points']))
                        <svg style="position:absolute;top:0;left:0;width:900px;height:300px;pointer-events:none;">
                            @php $painPoints = json_decode($data['pain_points'], true); @endphp
                            @foreach($painPoints as $pt)
                                @php
                                    // Use percentage coordinates if available, otherwise fallback to pixel coordinates
                                    if (isset($pt['xPercent']) && isset($pt['yPercent'])) {
                                        $x = ($pt['xPercent'] / 100) * 900;
                                        $y = ($pt['yPercent'] / 100) * 300;
                                    } else {
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
            </td>
        </tr>
    </table>
    <!-- Pain Scale Section -->
    <table style="width:100%;border:1.5px solid #b5d6e6;border-collapse:collapse;text-align:center;font-size:1.18rem;background:#fff;margin-top:24px;margin-bottom:32px;">
        <tr><td colspan="11" style="color:#2196f3;font-weight:bold;padding:12px 0 12px 0;font-size:1.15rem;">How bad is your headache right now? ( 0 = no pain , 10 = worst pain )</td></tr>
        <tr>
            <td colspan="11" style="padding:8px 0;">
                @for ($i = 0; $i <= 10; $i++)
                    @if(isset($data['headache_now']) && $data['headache_now'] == $i)
                        <span style="display:inline-block;width:28px;height:28px;line-height:28px;background:#111;color:#fff;border-radius:5px;font-weight:bold;margin:0 2px;">{{ $i }}</span>
                    @else
                        <span style="display:inline-block;width:28px;height:28px;line-height:28px;background:transparent;color:#111;border-radius:5px;font-weight:normal;margin:0 2px;">{{ $i }}</span>
                    @endif
                @endfor
            </td>
        </tr>
        <tr>
            <td colspan="5" style="color:#2196f3;font-weight:bold;padding:10px 0 10px 0;border-right:1.5px solid #b5d6e6;font-size:1.08rem;">How bad is your headache at its worst?</td><td colspan="6" style="color:#2196f3;font-weight:bold;padding:10px 0 10px 0;font-size:1.08rem;">How bad is your headache at its best?</td>
        </tr>
        <tr>
            <td colspan="5" style="padding:8px 0;">
                @for ($i = 0; $i <= 10; $i++)
                    @if(isset($data['headache_worst']) && $data['headache_worst'] == $i)
                        <span style="display:inline-block;width:24px;height:24px;line-height:24px;background:#111;color:#fff;border-radius:5px;font-weight:bold;margin:0 2px;">{{ $i }}</span>
                    @else
                        <span style="display:inline-block;width:24px;height:24px;line-height:24px;background:transparent;color:#111;border-radius:5px;font-weight:normal;margin:0 2px;">{{ $i }}</span>
                    @endif
                @endfor
            </td>
            <td colspan="6" style="padding:8px 0;">
                @for ($i = 0; $i <= 10; $i++)
                    @if(isset($data['headache_best']) && $data['headache_best'] == $i)
                        <span style="display:inline-block;width:24px;height:24px;line-height:24px;background:#111;color:#fff;border-radius:5px;font-weight:bold;margin:0 2px;">{{ $i }}</span>
                    @else
                        <span style="display:inline-block;width:24px;height:24px;line-height:24px;background:transparent;color:#111;border-radius:5px;font-weight:normal;margin:0 2px;">{{ $i }}</span>
                    @endif
                @endfor
            </td>
        </tr>
        <tr><td colspan="11" style="color:#2196f3;font-weight:bold;padding:10px 0 10px 0;font-size:1.08rem;">How consistent is your headache as now?</td></tr>
        <tr>
            <td colspan="11" style="text-align:center;padding:12px 0;">
                <span style="margin:0 18px;display:inline-block;min-width:120px;">
                    <span class="pdf-checkbox">@if(!empty($data['headache_consistency_continuous']))☑@else☐@endif</span> Continuous
                </span>
                <span style="margin:0 18px;display:inline-block;min-width:120px;">
                    <span class="pdf-checkbox">@if(!empty($data['headache_consistency_positional']))☑@else☐@endif</span> Positional
                </span>
                <span style="margin:0 18px;display:inline-block;min-width:160px;">
                    <span class="pdf-checkbox">@if(!empty($data['headache_consistency_intermittent']))☑@else☐@endif</span> Intermittent (on/off)
                </span>
                <span style="margin:0 18px;display:inline-block;min-width:120px;">
                    <span class="pdf-checkbox">@if(!empty($data['headache_consistency_unable']))☑@else☐@endif</span> unable to rate
                </span>
            </td>
        </tr>
    </table>
</div>
</body>
</html> 