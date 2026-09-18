<?php

namespace Machec\Contracts\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Plaintext-secret display panel (D103) — a copy button plus an explicit
 * "I've copied it, close" confirmation, never re-openable once dismissed.
 * First consumed by `customer-identity`'s `ServiceClientCreate` (Step
 * 2.10), showing a freshly-minted Sanctum token's plaintext exactly once.
 * The caller is responsible for never storing that plaintext anywhere it
 * would survive a page refresh (D103) — this component only ever renders
 * whatever it's handed, for as long as it's handed it.
 *
 * `$secret` is deliberately non-nullable: this component's whole reason to
 * exist is that its content must never appear except the one deliberate
 * time a caller passes the freshly-minted plaintext in, so the caller must
 * wrap its own `<x-machec::reveal-once-secret>` tag in an `@if`/`@unless`
 * rather than this component silently rendering blank on a missing prop.
 */
class RevealOnceSecret extends Component
{
    public function __construct(
        public string $name,
        public string $secret,
        public string $dismissAction,
        public string $heading = 'Copy this token now',
        public ?string $description = null,
    ) {}

    public function render(): View
    {
        return view('machec::components.reveal-once-secret');
    }
}
