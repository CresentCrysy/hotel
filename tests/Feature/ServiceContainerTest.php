<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Bar;
use App\Data\person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    public function testDependency()
    {
         $foo1 = $this->app->make(Foo::class);
         $foo2 = $this->app->make(Foo::class);

         self::assertEquals('Foo', $foo1->foo());
         self::assertEquals('Foo', $foo2->foo());
         self::assertNotSame($foo1, $foo2);
    }

     public function testSingleton()
     {
          $this->app->singleton(person::class, function ($app) {
              return new person("eko", "masuk");
          });

          $person1 = $this->app->make(person::class);
          $person2 = $this->app->make(person::class);

          self::assertEquals('eko', $person1->firstname);
          self::assertEquals('eko', $person2->firstname);
          self::assertSame($person1, $person2);
     }

     public function testInstance()
     {
          $person = new person("eko", "masuk");
          $this->app->instance(person::class, $person);

          $person1 = $this->app->make(person::class);
          $person2 = $this->app->make(person::class);

          self::assertEquals('eko', $person1->firstname);
          self::assertEquals('eko', $person2->firstname);
          self::assertSame($person1, $person2);
     }

     public function testDependencyInjection()
    {
        $this->app->singleton(Foo::class, function ($app){
            return new Foo();
        });

        $this->app->singleton(Bar::class, function ($app){
            $foo=$app->make(Foo::class);
            return new Bar($foo);
        });

        $foo = $this->app->make(Foo::class);
        $bar1 = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertSame($foo, $bar1->foo);
        self::assertSame($bar1, $bar2);
        
    }

    public function testInterfaceToClass()
    {
        //$this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $this->app->singleton(HelloService::class, function ($app){
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertEquals('Halo eko', $helloService->hello('eko'));
    }
}
