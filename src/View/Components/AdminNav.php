<?php

namespace Machec\Contracts\View\Components;

use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Switcher links between the three co-located admin apps
 * (`customer-identity`/`commercial-core`/`logistics-wms`, D20). Each link
 * is a plain `<a href>` to the target app's own `/login` page — this
 * component never grants access, it only decides which links to show.
 * `pim-core` is deliberately excluded (D51) and never renders this.
 */
class AdminNav extends Component
{
    /**
     * @param  array<int, array{label: string, url: string}>  $links
     */
    public function __construct(
        public array $links,
    ) {}

    public function render(): View
    {
        return view('machec::components.admin-nav');
    }
}
