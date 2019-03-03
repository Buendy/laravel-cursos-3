<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MessageToStudent extends Mailable
{
    private $teacher;
    private $text_message;

    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @param $teacher
     * @param $text_message
     *
     */
    public function __construct($teacher, $text_message)
    {
        $this->teacher = $teacher;
        $this->text_message = $text_message;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(__('app.mail.message_to_student.subject',[
            'teacher' => $this->teacher
        ]))
            ->markdown('email.message_to-student')
            ->with('text_message', $this->text_message);
    }
}
