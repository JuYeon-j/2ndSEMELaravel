<?php

namespace App\Listeners;

use App\Events\ArticlesEvent;
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
     * @param  ArticlesEvent  $event
     * @return void
     */

                          // use로 import시켜서 ArticlesEvent만 적어도 됨.
    public function handle(ArticlesEvent $e)
    {
        if($e->action==='created'){
            \Log::info(
                sprintf(
                    '새글이 등록되었습니다. 확인바랍니다. 글 제목: %s',
                    $e->article->title
                )
            );
        }
    }
}
