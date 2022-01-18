@component('mail::message')
# From Kiki Riki System

<p style="color: red; direction: rtl;"> عن {{$email_data['name']}} </p>

<span style="direction: rtl;">{!! $email_data['msg'] !!}</span>

@endcomponent
