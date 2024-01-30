<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputControllerTest extends TestCase
{
    public function testInput()
    {
        $this->get('/input/hello?name=Cresent')
            ->assertSeeText('Hello Cresent');

        $this->post('/input/hello?name=Cresent')
            ->assertSeeText('Hello Cresent');
    }

    public function testInputNested()
    {
        $this->post('/input/hello/first', [
            "name"=> [
                "first"=>"Cresent",
                "last"=>"Crush"
            ]
        ])->assertSeeText("Hello Cresent");
    }

    public function testInputAll()
    {
        $this->post('/input/hello/input', [
            "name"=> [
                "first"=>"Cresent",
                "last"=>"Crush"
            ]
        ])->assertSeeText("name")->assertSeeText("first")
            ->assertSeeText("last")->assertSeeText("Cresent")
            ->assertSeeText("Crush");
    }

    public function testInputArray()
    {
        $this->post('/input/hello/array', [
            "products"=> [
                [
                    "name"=>"Apple Mac Book Pro",
                    "price"=>30000000
                ],
                [
                    "name"=>"Samsung Z Fold",
                    "price"=>20000000
                ]
            ]
           
        ])->assertSeeText("Apple Mac Book Pro")
            ->assertSeeText("Samsung Z Fold");
    }

    public function testInputType()
    {
        $this->post('/input/type', [
            'name'=>'Cryshy',
            'married'=> 'true',
            'birth_date'=>'2000-09-01'
        ])->assertSeeText('Cryshy')->assertSeeText('true')->assertSeeText('2000-09-01');
    }

    public function testInputOnly()
    {
        $this->post('/input/filter/only', [
            "name"=> [
                "first"=>"Cresent",
                "middle"=>"Crysy",
                "last"=>"Crushy"
            ]
        ])->assertSeeText("Cresent")->assertDontSeeText("Crysy")->assertSeeText("Crushy");
    }

    public function testFilterExcept()
    {
        $this->post('/input/filter/except', [
            "username"=>"Cresent",
            "password"=>"secret",
            "admin"=>"true"
        ])->assertSeeText("Cresent")->assertSeeText("secret")->assertDontSeeText("admin");
    }

    public function testFilterMerge()
    {
        $this->post('/input/filter/merge', [
            "username"=>"Cresent",
            "password"=>"secret",
            "admin"=>"true"
        ])->assertSeeText("Cresent")->assertSeeText("secret")->assertSeeText("admin")->assertSeeText("false");
        
    }
}
