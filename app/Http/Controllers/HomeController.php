<?php

namespace App\Http\Controllers;

use App\Contracts\TranslatorInterface;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function __construct(
        private readonly TranslatorInterface $translator
    ) {}

    public function index(): JsonResponse
    {
        return response()->json([
            'message' => $this->translator->translate('greeting')
        ]);
    }
} 