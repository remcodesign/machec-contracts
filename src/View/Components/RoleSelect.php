<?php

namespace Machec\Contracts\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Machec\Contracts\Enums\RoleName;

/**
 * `RoleName`-bound dropdown (D98) — each consuming app passes its own
 * subset of `RoleName` cases via `$roles` (e.g. `customer-identity`'s
 * Step 2.9 scopes it to `Customer`/`CustomerAdmin`/`DataAdmin`, never the
 * other two apps' cases even though the enum itself is shared, D12).
 * Binds like a native Flux select — `wire:model` forwards through
 * `$attributes` onto the underlying `<flux:select>`.
 */
class RoleSelect extends Component
{
    /**
     * @param  array<int, RoleName>  $roles
     */
    public function __construct(
        public array $roles,
        public string $label = 'Role',
    ) {}

    public function render(): View
    {
        return view('machec::components.role-select');
    }
}
