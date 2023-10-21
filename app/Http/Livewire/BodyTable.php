<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Post;

class BodyTable extends Component
{
    use WithPagination;

    protected $paginationTheme = 'tailwind';
    public string $search = '';
    public string $inputSearch = 'all';

    public function updatedSearch()
    {
        $this->gotoPage(1);
    }

    public function inputChange($value)
    {
        $this->inputSearch = $value;
    }

    public function render()
    {
        $search = $this->search;
        $valueData = $this->inputSearch;

        $posts = match ($valueData) {
            'all' => Post::where(function ($query) use ($search) {
                    $query->orWhere('title', 'LIKE', "%{$search}%");
                    $query->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'LIKE', "%{$search}%");
                    });
                    $query->orWhereHas('comments', function ($commentQuery) use ($search) {
                        $commentQuery->where('comment_content', 'LIKE', "%{$search}%");
                    });
                })->orderBy('created_at', 'desc')->paginate(10),

            'title' => Post::where('title', 'LIKE', "%{$search}%")->orderBy('created_at', 'desc')->paginate(10),

            'user' => Post::whereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', "%{$search}%");
                })->orderBy('created_at', 'desc')->paginate(10),

            'comment' => Post::whereHas('comments', function ($commentQuery) use ($search) {
                    $commentQuery->where('comment_content', 'LIKE', "%{$search}%");
                })->orderBy('created_at', 'desc')->paginate(10),

            default => Post::where(function ($query) use ($search) {
                    $query->orWhere('title', 'LIKE', "%{$search}%");
                    $query->orWhereHas('user', function ($userQuery) use ($search) {
                        $userQuery->where('name', 'LIKE', "%{$search}%");
                    });
                    $query->orWhereHas('comments', function ($commentQuery) use ($search) {
                        $commentQuery->where('comment_content', 'LIKE', "%{$search}%");
                    });
                })->orderBy('created_at', 'desc')->paginate(10),
        };

        return view('livewire.body-table', [
            'posts' => $posts
        ]);
    }
}
