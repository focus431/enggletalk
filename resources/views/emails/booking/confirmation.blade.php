@extends('emails.layouts.app')

@section('title', __('emails.booking_confirmation'))

@section('content')

<div style="text-align: center; margin-bottom: 20px;"></div></div>
@if($isMentor)
    <h2 style="color: #2c3e50; font-size: 24px; margin-bottom: 20px;">{{ __('emails.dear_teacher', ['name' => $mentor->first_name . ' ' . $mentor->last_name]) }}</h2>
@else
    <h2 style="color: #2c3e50; font-size: 24px; margin-bottom: 20px;">{{ __('emails.dear_student', ['name' => $mentee->first_name . ' ' . $mentee->last_name]) }}</h2>
@endif

<div style="background: #ffffff; border: 1px solid #e9ecef; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); margin: 20px 0;">
    <p style="margin: 10px 0; font-size: 16px; color: #333;">
        <strong>{{ __('emails.class_time') }}：</strong> {{ $classSchedule->schedule_date }} {{ $localstartTime }} - {{ $localendTime }}
    </p>
    <p style="margin: 10px 0; font-size: 16px; color: #333;">
        <strong>{{ __('emails.timezone') }}：</strong> {{ $timezoneLabel }}
    </p>
    @if($isMentor)
        <p style="margin: 10px 0; font-size: 16px; color: #333;">
            <strong>{{ __('emails.student_name') }}：</strong> {{ $mentee->last_name . ' ' . $mentee->first_name }}
        </p>
    @else
        <p style="margin: 10px 0; font-size: 16px; color: #333;">
            <strong>{{ __('emails.teacher_name') }}：</strong> {{ $mentor->last_name . ' ' . $mentor->first_name }}
        </p>
    @endif
    <p style="margin: 10px 0; font-size: 16px; color: #333;">
        <strong>{{ __('emails.class_duration') }}：</strong> 50分鐘
    </p>
</div>



<p style="margin-top: 30px; font-size: 14px; color: #6c757d;">
    {{ __('emails.thank_you') }} <br>
    {{ __('emails.team_name') }}
</p>
@endsection
