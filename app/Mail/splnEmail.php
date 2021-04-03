<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class splnemail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($path)
    {
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('layanan@spln.co.id')
            ->view('emailku')
            ->attach(public_path('pdf/permohonan_pendaftaran_slo_030421205805.pdf'), [
                'as' => 'sample.pdf',
                'mime' => 'application/pdf',
            ])
            ->with(
                [
                    'nama' => 'Diki Alfarabi Hadi',
                    'website' => 'www.malasngoding.com',
                ]
            );
    }
}
