@component('mail::message')
    Dear {{$email}},

    Current BTC rate for this moment is:  <i> {{$rate}} </i>

    with best regards,<br>
    {{ config('app.name') }} Team
@endcomponent
