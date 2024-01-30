<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Services\HelloService;

class HelloControllerTest extends TestCase
{

    protected function setUp(): void
{
    parent::setUp();

    // Bind a mock instance of HelloService
    $this->app->bind(HelloService::class, function ($app) {
        return \Mockery::mock(HelloService::class);
    });
}

    public function testHello()
    {
        $this->get('/controller/hello/Cresent')
            ->assertSeeText("Halo Cresent");
    }

    public function testRequest()
    {
        $this->get('/controller/hello/request', [
            "Accept"=>"plain/text"
        ])->assertSeeText("controller/hello/request")
                ->assertSeeText("http://localhost/controller/hello/request")
                ->assertSeeText("GET")
                ->assertSeeText("plain/text");
    }
}
