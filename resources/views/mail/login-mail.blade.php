@component('mail::message')
# From Spinel System

<p style="color: red; direction: rtl;"> عن {{$email_data['name']}} </p>

<span style="direction: rtl;">{!! $email_data['msg'] !!}</span>

@endcomponent
