<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('emails.class_canceled') }}</title>
</head>
<body>
    <p>{{ __('emails.dear_teacher', ['name' => $recipient->first_name . ' ' . $recipient->last_name]) }},</p>
    
    <p>{{ __('emails.cancel_notice') }}</p>
    <p>{{ __('emails.cancel_schedule_info', ['date' => $classSchedule->schedule_date, 'start' => $localstartTime, 'end' => $localendTime]) }}</p>
    
    @if ($mentee)
        <p>{{ __('emails.student_name') }}: {{ $mentee->first_name }} {{ $mentee->last_name }}</p>
    @endif
    
    <p>{{ __('emails.contact_support') }}</p>
    <p>{{ __('emails.best_regards') }}</p>
    <p>{{ __('emails.team_name') }}</p>
</body>
</html>
