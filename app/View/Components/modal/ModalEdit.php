<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;
use App\Models\Comment;

class ModalEdit extends Component
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
        return view('components.modal.modal_edit', [
            'comment' => Comment::where('comment_id', $this->id)->first(),
        ]);
    }
}
