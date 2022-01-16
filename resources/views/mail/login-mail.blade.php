@component('mail::message')
# From Kiki Riki System

{{$email_data['name']}}

{!! $email_data['msg'] !!}

@endcomponent
