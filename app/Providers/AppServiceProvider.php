<?php

namespace App\Providers;

use App\View\Components\Table\Row;
use App\View\Components\Layouts\Authenticate;
use App\View\Components\Layouts\Post_id;
use App\View\Components\Layouts\Header;
use App\View\Components\Modal\ModalEdit;
use App\View\Components\Modal\ModalDelete;
use App\View\Components\Modal\ModalNew;
use App\View\Components\Modal\ModalPostEdit;
use Blade;
use Illuminate\Database\Query\Builder;
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
        Builder::macro('whereLike', function ($attributes, string $searchTerm) {
            $this->where(function (Builder $query) use ($attributes, $searchTerm) {
                foreach (array_wrap($attributes) as $attribute) {
                    $query->when(
                        str_contains($attribute, '.'),
                        function (Builder $query) use ($attribute, $searchTerm) {
                            [$relationName, $relationAttribute] = explode('.', $attribute);

                            $query->orWhereHas('comments', function (Builder $query) use ($relationAttribute, $searchTerm) {
                                $query->where($relationAttribute, 'LIKE', "%{$searchTerm}%");
                            });
                        },
                        function (Builder $query) use ($attribute, $searchTerm) {
                            $query->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
                        }
                    );
                }
            });

            return $this;
        });
        Blade::component('layouts-authenticate', Authenticate::class);
        Blade::component('table-row', Row::class);
        Blade::component('layouts-header', Header::class);
        Blade::component('layouts-post', Post_id::class);
        Blade::component('modal-edit', ModalEdit::class);
        Blade::component('modal-delete', ModalDelete::class);
        Blade::component('modal-new', ModalNew::class);
        Blade::component('modal-post-edit', ModalPostEdit::class);
    }
}