<?php

namespace Machec\Contracts\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * A labelled number, no chart, no JS (D87) — the shared admin-dashboard
 * building block used by every co-located app's `AdminDashboard` (D87/D89).
 */
class StatTile extends Component
{
    public function __construct(
        public string $label,
        public int|string $value,
    ) {}

    public function render(): View
    {
        return view('machec::components.stat-tile');
    }
}
