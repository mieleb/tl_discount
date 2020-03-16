<?php

namespace Tests\Feature;

use App\Traits\NumberSpeller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class NumberSpellerTest extends TestCase
{
    use NumberSpeller;

    public function testSpeller()
    {
        $number = 5;
        $expected  = 'vijf';

        config('apis.language','nl');

        $spelled = $this->spellOutNumber($number);

        $this->assertEquals($spelled,$expected);
    }
}
