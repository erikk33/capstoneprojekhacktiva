<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendVerificationEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Buat instance pesan baru.
     */
    public function __construct(public User $user)
    {
        //
    }

    /**
     * Dapatkan amplop pesan.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Verifikasi Alamat Email Anda',
        );
    }

    /**
     * Dapatkan konten pesan.
     */
    public function content(): Content
    {
        // Arahkan ke file view untuk template email
        return new Content(
            view: 'emails.verification-email',
        );
    }
}
