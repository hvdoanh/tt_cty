<?php

namespace Tests\Feature;

use Tests\TestCase;

class GreetingTest extends TestCase
{
    public function test_greeting_returns_vietnamese_message_when_locale_is_vi(): void
    {
        config(['app.locale' => 'vi']);
        
        $response = $this->get('/greeting');
        
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Xin chào, quản trị viên'
            ]);
    }

    public function test_greeting_returns_english_message_when_locale_is_en(): void
    {
        config(['app.locale' => 'en']);
        
        $response = $this->get('/greeting');
        
        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Hello, admin'
            ]);
    }
} 