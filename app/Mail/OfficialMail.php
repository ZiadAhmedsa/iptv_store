<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OfficialMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $subjectLine;
    public $bodyText;
    public $userName;

    public function __construct($subjectLine, $bodyText, $userName = 'عميلنا العزيز')
    {
        $this->subjectLine = $subjectLine;
        $this->bodyText = $bodyText;
        $this->userName = $userName ?: 'عميلنا العزيز';
    }

    public function build()
    {
        return $this->subject($this->subjectLine)
                    ->view('emails.official');
    }
}
