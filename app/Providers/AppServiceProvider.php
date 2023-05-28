<?php

namespace App\Providers;

use App\Service\RateService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Service\EmailService;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(EmailService::class, function ($app) {
            return new EmailService();
        });

        $this->app->bind(RateService::class, function ($app) {
            return new RateService();
        });
    }

    /**
     * Bootstrap any application services.
     */

    public function boot(): void
    {
        Validator::extend('unique_emails', function ($attribute, $value, $parameters, $validator) {
            $es = new EmailService();
            return !$es->isEmailInDB($value);
        });
    }
}
