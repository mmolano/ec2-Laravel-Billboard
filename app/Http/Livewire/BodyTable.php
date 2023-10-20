<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;
use \Illuminate\Contracts\View\View;

class BodyTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public string $search = '';
    public string $inputSearch = 'title';
    
    public function updatedSearch()
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        $search = $this->search;

        return view('livewire.body-table', [
            'posts' => Post::where(function ($query) use ($search) {
                $query->orWhere('title', 'LIKE', "%{$search}%");
                $query->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', "%{$search}%");
                });
                $query->orWhereHas('comments', function ($commentQuery) use ($search) {
                    $commentQuery->where('comment_content', 'LIKE', "%{$search}%");
                });
            })->orderBy('created_at', 'desc')->paginate(10)
        ]);
    }
}
