<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailQueue extends Mailable
{
    use Queueable, SerializesModels;

    public $url;
    public $nameOwner;
    public $subject;
    public $postUser;
    public $postDate;
    public $content;

    /**
     * Create a new EmailQueue instance.
     *
     * @param array $details An associative array with the following keys:
     *     - 'url' (string): The URL for the email.
     *     - 'nameOwner' (string): The name of the person who own the post/message.
     *     - 'postUser' (string): The name of the user who posted.
     *     - 'postDate' (string): The date of post.
     *     - 'subject' (string): The email subject.
     *     - 'content' (string): The email content.
     */
    public function __construct(array $details)
    {
        $this->nameOwner = $details['nameOwner'];
        $this->subject = $details['subject'];
        $this->postUser = $details['postUser'];
        $this->postDate = $details['postDate'];
        $this->content = $details['content'];
        $this->url = $details['url'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->subject,
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
                'nameOwner' => $this->nameOwner,
                'subject' => $this->subject,
                'postUser' => $this->postUser,
                'postDate' => $this->postDate,
                'content' => $this->content,
                'url' => $this->url,
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
