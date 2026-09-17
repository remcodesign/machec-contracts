<?php

namespace Machec\Contracts;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class MachecContractsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'machec');

        Blade::componentNamespace('Machec\\Contracts\\View\\Components', 'machec');
    }
}
