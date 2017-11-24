<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

use App\Post;


class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
           // Post::class => PostPolicy::class,
            Post::class => \App\Policies\PostPolicy::class,
    ];

            // 'App\Model' => 'App\Policies\ModelPolicy',
            // 'App\Post' => \App\Policies\PostPolicy::class,
         // 'App\Model' => 'App\Policies\ModelPolicy',
           // 'App\Post' => 'App\Policies\PostPolicy',
          // \App\Post::class => \App\Policies\PostPolicy::class,

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //$this->registerPostPolicies();



        //Gate::define('posts.update', '\App\Policies\PostPolicy@edit');
        Gate::define('posts-update', '\App\Policies\PostPolicy@update');

    }

    public function registerPostPolicies()
    {

        Gate::define('create-post', function ($user) {
            return $user->hasAccess(['create-post']);
        });

        //Gate::define('posts.update', \App\Policies\PostPolicy::class.'@update');

        /*
        Gate::define('update-post', function ($user, $post) {
            $post = \App\Post::findorfail($post);
            return $user->hasAccess(['update-post']) or $user->id == $post->user_id;
        });
        */
        

        Gate::define('publish-post', function ($user) {
            return $user->hasAccess(['publish-post']);
        });
        Gate::define('see-all-drafts', function ($user) {
            return $user->inRole('editor');
        });
    }

}
