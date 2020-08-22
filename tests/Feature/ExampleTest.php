<?php

declare(strict_types=1);

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class ExampleTest
 * @package Tests\Feature
 */
class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Server side rendered header with vue meta
        $response->assertSee(
            '<meta data-vue-meta="ssr" data-hid="description" name="description" content="Hello World">'
        );

        // Server side rendered body
        $response->assertSee('<div id="app" data-server-rendered="true">');
        $response->assertSeeText('I\'m an example component.');
    }
}
