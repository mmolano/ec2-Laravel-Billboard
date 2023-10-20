<?php

namespace App\View\Components\Modal;

use App\Models\Post;
use Illuminate\View\Component;

class ModalPostEdit extends Component
{
     public $id;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.modal_post_edit', [
            'post' => Post::where('post_id', $this->id)->first(),
        ]);
    }
}
