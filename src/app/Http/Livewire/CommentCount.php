<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class CommentCount extends Component
{
    public $item;
    public $count;

    protected $listeners = ['commentAdded' => 'refreshCount'];

    public function mount(Item $item)
    {
        $this->item = $item;
        $this->count = $item->comments()->count();
    }

    public function refreshCount()
    {
        $this->count = $this->item->comments()->count();
    }
    
    public function render()
    {
        return view('livewire.comment-count');
    }
}
