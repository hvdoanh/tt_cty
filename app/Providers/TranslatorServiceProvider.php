<?php

namespace App\Providers;

use App\Contracts\TranslatorInterface;
use App\Services\Translator\EnglishTranslator;
use App\Services\Translator\VietnameseTranslator;
use Illuminate\Support\ServiceProvider;

class TranslatorServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TranslatorInterface::class, function ($app) {
            return match ($app['config']['app.locale']) {
                'vi' => new VietnameseTranslator(),
                'en' => new EnglishTranslator(),
                default => new EnglishTranslator(),
            };
        });
    }
} 