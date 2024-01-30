<?php

namespace Tests\Feature;

use App\data\bar;
use App\data\foo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DependencyInjectionTest extends TestCase
{
    
    public function testDependencyInjection()
    {
       $foo = new Foo();
       $bar = new Bar($foo);

       self::assertEquals('foo and bar', $bar->bar());
    }
}
