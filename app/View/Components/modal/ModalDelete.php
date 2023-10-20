<?php

namespace App\View\Components\Modal;

use Illuminate\View\Component;
use App\Models\Comment;

class ModalDelete extends Component
{
     public $id;
     public $url;
     public $title;
     public $value;
    
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id, $url, $title, $value)
    {
        $this->id = $id;
        $this->url = $url;
        $this->title = $title;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.modal.modal_delete');
    }
}
