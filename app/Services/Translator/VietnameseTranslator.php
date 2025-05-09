<?php

namespace App\Services\Translator;

use App\Contracts\TranslatorInterface;

class VietnameseTranslator implements TranslatorInterface
{
    private array $translations = [
        'greeting' => 'Xin chào, quản trị viên'
    ];

    public function translate(string $key): string
    {
        return $this->translations[$key] ?? $key;
    }
} 