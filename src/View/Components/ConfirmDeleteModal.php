<?php

namespace Machec\Contracts\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Generic destructive-action confirmation dialog (D98) — a named
 * `<flux:modal>` triggered by its own button, confirming into a
 * `wire:click`-style method call on the enclosing Livewire component.
 * First consumed by `customer-identity`'s `UserIndex` delete action
 * (Step 2.9), reused as-is by any co-located app's own admin CRUD.
 */
class ConfirmDeleteModal extends Component
{
    public function __construct(
        public string $name,
        public string $heading,
        public string $action,
        public ?string $description = null,
        public string $triggerLabel = 'Delete',
        public string $confirmLabel = 'Delete',
        public string $cancelLabel = 'Cancel',
    ) {}

    public function render(): View
    {
        return view('machec::components.confirm-delete-modal');
    }
}
