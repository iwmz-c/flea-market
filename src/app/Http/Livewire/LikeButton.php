<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LikeButton extends Component
{
    public $item;
    public $liked;
    public $count;

    public function mount($item)
    {
        $this->item = $item;
        $this->count = $item->favorites()->count();
        $this->liked = $item->isLikedBy(auth()->user());
    }

    public function toggleLike()
    {
        $user = auth()->user();

        if ($this->liked) {
            $user->favorites()->where('item_id', $this->item->id)->delete();
            $this->count--;
        } else {
            $user->favorites()->create([
                'item_id' => $this->item->id,
            ]);
            $this->count++;
        }

        $this->liked = !$this->liked;
    }
    
    public function render()
    {
        return view('livewire.like-button');
    }
}
