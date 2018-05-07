<?php

namespace Encore\Admin\ManagePlan;
use Illuminate\Support\ServiceProvider;

class ManagePlanServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../views', 'laravel-admin-extension-laraplans');
        ManagePlan::boot();
    }
}