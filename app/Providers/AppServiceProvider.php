<?php

namespace App\Providers;

use App\View\Components\Search;
use App\View\Components\Show\Comments;
use App\View\Components\Table\Row;
use App\View\Components\Layouts\Authenticate;
use App\View\Components\Layouts\Post_id;
use App\View\Components\Layouts\Header;
use App\View\Components\Modal\ModalEdit;
use App\View\Components\Modal\ModalDelete;
use App\View\Components\Modal\ModalNew;
use App\View\Components\Modal\ModalPostEdit;
use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('layouts-authenticate', Authenticate::class);
        Blade::component('table-row', Row::class);
        Blade::component('layouts-header', Header::class);
        Blade::component('layouts-post', Post_id::class);
        Blade::component('modal-edit', ModalEdit::class);
        Blade::component('modal-delete', ModalDelete::class);
        Blade::component('modal-new', ModalNew::class);
        Blade::component('modal-post-edit', ModalPostEdit::class);
        Blade::component('search', Search::class);
        Blade::component('show-comments', Comments::class);
    }
}