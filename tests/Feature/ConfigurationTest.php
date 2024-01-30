<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
    
    public function test_example()
    {
        $firstname = config('contoh.author.first');
        $lastname = config('contoh.author.last');
        $email = config('contoh.email');
        $web = config('contoh.web');

        self::assertEquals('eko', $firstname);
        self::assertEquals('masuk', $lastname);
        self::assertEquals('emangeak.@gmail.com', $email);
        self::assertEquals('www.youtube.com', $web);
    }
}
