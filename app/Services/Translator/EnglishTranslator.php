<?php

namespace App\Services\Translator;

use App\Contracts\TranslatorInterface;

class EnglishTranslator implements TranslatorInterface
{
    private array $translations = [
        'greeting' => 'Hello, admin'
    ];

    public function translate(string $key): string
    {
        return $this->translations[$key] ?? $key;
    }
} 