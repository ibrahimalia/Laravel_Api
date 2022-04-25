@component('mail::message')
# Introduction

The body of your message {{$name}}.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
Design House
@endcomponent
