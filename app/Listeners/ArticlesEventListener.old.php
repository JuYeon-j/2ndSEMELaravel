<?php

namespace App\Listeners;

// use App\Events\article.created;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ArticlesEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  article.created  $event
     * @return void
     */
    // public function handle(\App\Article $article) //article.created $event)
    public function handle(\App\Events\ArticleCreated $e)
    {
        var_dump('이벤트 수령');
        var_dump($e->article->toArray());
                  // e는 ArticleCreated.php의 article가지고있음
    }
}
