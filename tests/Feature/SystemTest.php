<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SystemTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     * Solo los usuarios logueados puedan crear posts
     * @test
     */
    public function only_users_auth_can_create_posts()
    {
        $user = factory(User::class)->create();

        Auth::login($user);

        $post = factory(Post::class)->create([
            'user_id' => Auth::user()->id
        ]);

        Log::info($user);
        Log::info($post);

        $this->assertDatabaseHas('posts', [
            'user_id' => Auth::user()->id
        ]);
    }

    /**
     * A basic test example.
     * Solo los usuarios logueados puedan ver la vista de crear posts
     * @test
     */

    public function only_users_auth_can_see_view_posts_create()
    {
        $response = $this->get('/posts/create');
        $response->assertRedirect('/login');
    }

    /**
     * A basic test example.
     * Solo los usuarios logueados puedan ver la vista de posts
     * @test
     */

    public function only_users_auth_can_see_view_posts()
    {
        $response = $this->get('/posts');
        $response->assertRedirect('/login');
    }

    /**
     * A basic test example.
     * Solo los usuarios logueados puedan ver el home
     * @test
     */

    public function only_users_auth_can_see_panel_home()
    {
        $user = factory(User::class)->create();

        Auth::login($user);

        $response = $this->get('/home');

        $response->assertSee('Dashboard');

    }

    /**
     * A basic test example.
     * Un usuario no puede editar el post de otro usuario
     * @test
     */

    public function a_user_cannot_update_post_of_another_user()
    {
        // first user
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create([
            'user_id' => $user->id
        ]);

        $contentOriginal = $post->content;

        // second user
        $second_user = factory(User::class)->create();
        Auth::login($second_user);
        $response = $this->post('/posts/update', [
            'id' =>  $post->id,
            'content' => 'edited'
        ]);

        //$response->assertStatus(403);
        $this->assertDatabaseHas('posts',[
           'id'=> $post->id,
            'name' => $contentOriginal
        ]);

    }


}
