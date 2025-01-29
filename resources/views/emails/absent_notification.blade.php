<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('emails.Missed Class Notification') }}</title>
</head>
<body>
    <p>{{ __('emails.Dear :name,', ['name' => $mentee->first_name . ' ' . $mentee->last_name]) }}</p>

    <p>{{ __('emails.You have missed a class on :date from :start_time to :end_time.', ['date' => $classSchedule->schedule_date, 'start_time' => $localstartTime, 'end_time' => $localendTime]) }}</p>

    <p>{{ __('emails.If you have any questions, feel free to contact us.') }}</p>

    <p>{{ __('emails.Best regards,') }}</p>
    <p>{{ __('emails.Your Team') }}</p>
</body>
</html>
