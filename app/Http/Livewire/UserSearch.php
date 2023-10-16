<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use \Illuminate\Contracts\View\View;

class UserSearch extends Component
{
    use WithPagination;

    public $search;

    /**
     * @return View
     */
    public function render(): View
    {
        return view('livewire.user-search', [
            'users' => User::whereLike('name', $this->search ?? '')->paginate(10),
        ]);
    }
}
