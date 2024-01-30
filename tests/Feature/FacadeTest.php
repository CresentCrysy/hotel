<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class FacadeTest extends TestCase
{
    public function testConfig()
    {
        $firstName1=config('contoh.author.first');
        $firstName2=config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
    }

    public function testConfigDependency()
    {
        $config = $this->app->make('config');
        $firstName3 =$config->get('contoh.author.first');

        $firstName1=config('contoh.author.first');
        $firstName2=config::get('contoh.author.first');

        self::assertEquals($firstName1, $firstName2);
        self::assertEquals($firstName1, $firstName3);
    }

    public function testFacadeMock()
    {
        Config::shouldReceive('get')
            ->with('contoh.author.first')
            ->andReturn('Eko Keren');

        $firstName=Config::get('contoh.author.first');

        self::assertEquals('Eko Keren', $firstName);
    }
}
