<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
use \Illuminate\Contracts\View\View;

class CardSearch extends Component
{
    use WithPagination;

    public $search;
    public $searchTitle;
    public $searchRegistrant = false;
    public $searchComment = false;

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.card-search', [
            'posts' => Post::whereLike('title', $this->search ?? '')->paginate(10),
        ]);
    }
}