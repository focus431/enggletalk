<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('emails.class_schedule_booked') }}</title>
</head>
<body>
    <h1>{{ __('emails.class_schedule_booked') }}</h1>
    <p>{{ __('emails.dear') }} {{ $mentor->first_name }},</p>
    <p>{{ __('emails.your_class_schedule', ['date' => $classSchedule->schedule_date, 'start_time' => $localstartTime, 'end_time' => $localendTime]) }}</p>
    <p>{{ __('emails.please_check') }}</p>
    <p>{{ __('emails.thank_you') }}</p>
</body>
</html>
