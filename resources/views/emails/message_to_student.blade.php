@component('mail::message')

    #{{__('app.mail.message_to_student.title')}}

    {{$text_message}}

    @component('mail::button', ['url' => url('/')])
        {{__('app.mail.message_to_student.body', ['app' => env('APP_NAME')])}}
        @endcomponent

    {{__('app.mail.new_student.thanks')}}
    {{config('app.name')}}

@endcomponent
