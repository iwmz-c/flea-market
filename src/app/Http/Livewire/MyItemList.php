<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use App\Models\Purchase;
use Illuminate\Support\Facades\Auth;

class MyItemList extends Component
{
    public $page = 'sell';

    protected $queryString = [
        'page' => ['except' => 'sell'],
    ];

    public function mount()
    {
        $this->page = request()->query('page', 'sell');
    }

    public function setTab($page) {
        $this->page = $page;
    }
    
    public function render()
    {
        if ($this->page === 'sell') {
            $items = Item::where('user_id', auth()->id())->get();
        } else {
            $items = Item::whereIn('id', auth()->user()->purchases()->pluck('item_id'))->get();
        }
        
        return view('livewire.my-item-list', compact('items'));
    }
}
