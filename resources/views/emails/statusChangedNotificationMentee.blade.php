<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('emails.class_canceled') }}</title>
</head>
<body>
    <p>{{ __('emails.dear_student', ['name' => $recipient->first_name . ' ' . $recipient->last_name]) }},</p>
    
    <p>{{ __('emails.cancel_notice') }}</p>
    <p>{{ __('emails.cancel_schedule_info', ['date' => $classSchedule->schedule_date, 'start' => $localstartTime, 'end' => $localendTime]) }}</p>
    
    <p>{{ __('emails.teacher_name') }}: {{ $mentor->first_name }} {{ $mentor->last_name }}</p>
    <p>{{ __('emails.cancel_refund_notice') }}</p>
    
    <p>{{ __('emails.contact_support') }}</p>
    <p>{{ __('emails.best_regards') }}</p>
    <p>{{ __('emails.team_name') }}</p>
</body>
</html>
