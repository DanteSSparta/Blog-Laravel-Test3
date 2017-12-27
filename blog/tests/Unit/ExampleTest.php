<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $first = factory(Post::class)->create();

        $second = factory(Post::class)->create([
            'create_at' => \Carbon\Carbon::now()->subMonth()
        ]);

        Post::archives();


        $this->assertCount(2,$posts);
    }
}
