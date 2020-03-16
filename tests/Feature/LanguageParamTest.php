<?php

namespace Tests\Feature;

use App\Fields\Language;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class LanguageParamTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(\ApiUser::class);
    }

    public function testLanguageParam()
    {
        $language = 'fr';
        $order = factory(Order::class)->make();

        $languageData = [
            Language::QUERY_PARAM   =>  $language
        ];

        $data = array_merge($order->toArray(),$languageData);
        $response = $this->postRequest($data);

        $configValue = config('apis.language');

        $this->assertEquals($language,$configValue);
    }

    public function testLanguageParamAllowed()
    {
        $languages = ['nl','fr'];

        foreach ($languages as $language){

            $this->assertTrue(in_array($language,Language::allowed()));
        }
    }
}
