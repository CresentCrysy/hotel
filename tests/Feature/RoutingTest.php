<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoutingTest extends TestCase
{
   public function testGet()
   {
    $this->get('/pzn')
        ->assertStatus(200)
        ->assertSeeText('Hello Programmer Zaman Now');
   }

   public function testRedirect()
   {
    $this->get('/youtube')
        ->assertRedirect('/pzn');
   }

   public function testFallback()
   {
    $this->get('/tidakada')
        ->assertSeeText('404 by Programmer Zaman Now');
   }

   public function testRouteParameter()
    {
    $this->get('/products/1')
        ->assertSeeText('Product 1');

    $this->get('/products/2')
        ->assertSeeText('Product 2');

    $this->get('/products/1/items/XXX')
        ->assertSeeText('Product 1, Item XXX');

    $this->get('/products/2/items/YYY')
        ->assertSeeText('Product 2, Item YYY');

    }

    public function testRouteParameterRegex()
    {
        $this->get('/categories/100')
            ->assertSeetext('Category 100');

        
        $this->get('/categories/eko')
            ->assertSeetext('404 by Programmer Zaman Now');
    }

    public function testRouteParameterOptional()
    {
        $this->get('/users/Cresent')
            ->assertSeeText('User Cresent');

    
        $this->get('/users/')
            ->assertSeeText('User 404');
    }

    public function testRouteParameterConflict()
    {
        $this->get('/conflict/Cresent')
            ->assertSeeText('Conflict Cresent');
        
        $this->get('/conflict/eko')
            ->assertSeeText('Conflict Eko Ju');          
    }

    public function testNamedRoute()
    {
        $this->get('/produk/12345')
            ->assertSeeText('Link http://localhost/products/12345');
    }
}