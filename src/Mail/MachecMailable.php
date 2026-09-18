<?php

namespace Machec\Contracts\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

/**
 * Shared branded base for every outbound email across the Machec apps that
 * use this package (`customer-identity`, `commercial-core`, `logistics-wms`
 * — never `pim-core`, D51/D53). A concrete Mailable supplies its own
 * subject and inner Blade view; this base wraps that view in one shared
 * layout (`machec::mail.layout`) so the branding lives in exactly one
 * place. First consumer: `customer-identity`'s password-reset placeholder
 * (Step 2.7, D79); Domain 9's order-confirmation mail becomes the second.
 */
abstract class MachecMailable extends Mailable
{
    public function envelope(): Envelope
    {
        return new Envelope(subject: $this->subject());
    }

    public function content(): Content
    {
        return new Content(
            view: 'machec::mail.layout',
            with: [
                'innerView' => $this->view(),
                'innerData' => $this->data(),
            ],
        );
    }

    abstract protected function subject(): string;

    abstract protected function view(): string;

    /**
     * @return array<string, mixed>
     */
    protected function data(): array
    {
        return [];
    }
}
