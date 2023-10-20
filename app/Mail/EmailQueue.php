<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailQueue extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $name;
    public $subject;
    public $content;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($url, $name, $subject, $content)
    {
        $this->url = $url;
        $this->name = $name;
        $this->subject = $subject;
        $this->content = $content;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Fwd: ' . $this->subject,
        );
    }


    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'mails.email',
            with: [
                'url' => $this->url,
                'name' => $this->name,
                'content' => $this->content,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
