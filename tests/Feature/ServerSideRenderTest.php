<?php

declare(strict_types=1);

namespace Tests\Feature;

use Tests\TestCase;

/**
 * Class ServerSideRenderTest
 * @package Tests\Feature
 */
class ServerSideRenderTest extends TestCase
{
    /**
     * @return void
     */
    public function testHomeTest(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);

        // Server side rendered header with vue meta
        $response->assertSee('<title>Home</title>');
        $response->assertSee(
            '<meta data-vue-meta="ssr" data-hid="description" name="description" content="Hello World">'
        );

        // Server side rendered body
        $response->assertSee('<div id="app" data-server-rendered="true">');
        $response->assertSeeText('Hello from the Home page');
    }

    /**
     * @return void
     */
    public function testAboutTest(): void
    {
        $response = $this->get('/about');

        $response->assertStatus(200);

        // Server side rendered header with vue meta
        $response->assertSee('<title>About</title>');
        $response->assertSee(
            '<meta data-vue-meta="ssr" data-hid="description" name="description" content="Hello World">'
        );

        // Server side rendered body
        $response->assertSee('<div id="app" data-server-rendered="true">');
        $response->assertSeeText('Hello from the About page');
    }

    /**
     * @return void
     */
    public function testContactTest(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);

        // Server side rendered header with vue meta
        $response->assertSee('<title>Contact</title>');
        $response->assertSee(
            '<meta data-vue-meta="ssr" data-hid="description" name="description" content="Hello World">'
        );

        // Server side rendered body
        $response->assertSee('<div id="app" data-server-rendered="true">');
        $response->assertSeeText('Hello from the Contact page');
    }
}
