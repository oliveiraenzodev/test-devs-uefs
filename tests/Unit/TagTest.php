<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagTest extends TestCase
{
    use RefreshDatabase; // Ensures a clean database for each test

    public function test_a_tag_can_be_created()
    {
        $tag = Tag::create(['name' => 'Laravel']);

        $this->assertInstanceOf(Tag::class, $tag);
        $this->assertEquals('Laravel', $tag->name);
    }

    public function test_a_tag_can_have_many_posts()
    {
        $tag = Tag::factory()->create();
        $post1 = Post::factory()->create();
        $post2 = Post::factory()->create();

        $tag->posts()->attach([$post1->id, $post2->id]);

        $this->assertCount(2, $tag->posts);
        $this->assertTrue($tag->posts->contains($post1));
        $this->assertTrue($tag->posts->contains($post2));
    }
}