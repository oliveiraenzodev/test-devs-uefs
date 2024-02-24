<?php

namespace Tests\Unit;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase; // Ensures a clean database for each test

    public function test_a_post_can_be_created()
    {
        $post = Post::create([
            'title' => 'Test Post',
            'description' => 'This is a test post',
            'user_id' => 1, // Replace with actual user ID
        ]);

        $this->assertInstanceOf(Post::class, $post);
        $this->assertEquals('Test Post', $post->title);
        $this->assertEquals('This is a test post', $post->description);
    }

    public function test_a_post_cannot_be_created_with_invalid_data()
    {
        $this->expectException(\Illuminate\Validation\ValidationException::class);

        Post::create([
            'title' => '', // Empty title should be invalid
            'description' => 'This is a test post',
        ]);
    }

    public function test_a_post_can_have_many_tags()
    {
        $post = Post::factory()->create();
        $tag1 = Tag::factory()->create();
        $tag2 = Tag::factory()->create();

        $post->tags()->attach([$tag1->id, $tag2->id]);

        $this->assertCount(2, $post->tags);
        $this->assertTrue($post->tags->contains($tag1));
        $this->assertTrue($post->tags->contains($tag2));
    }

    public function test_a_post_can_be_detached_from_a_tag()
    {
        $post = Post::factory()->create();
        $tag = Tag::factory()->create();

        $post->tags()->attach($tag->id);

        $post->tags()->detach($tag->id);

        $this->assertCount(0, $post->tags);
        $this->assertFalse($post->tags->contains($tag));
    }
}