<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \App\Events\ArticlesEvent::class=>
                        [\App\Listeners\ArticlesEventListener::class],
        \Illuminate\Auth\Event\Login::class=>
                        [\App\Listeners\UsersEventListener::class],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        /* Event::listen('article.created', function($article){ 
            var_dump('이벤트 수령');
            var_dump($article->toArray());
        }); */

        // \Event::listen('article.created', \App\Listeners\ArticlesEventListener::class);
         
       /*                 // 앞에께 들어오면 뒤에껄 하자
        \Event::listen(\App\Events\ArticleCreated::class, 
                       \App\Listeners\ArticlesEventListener::class); */
        // 이벤트 리스너들을 작성해 나감

    }
}
