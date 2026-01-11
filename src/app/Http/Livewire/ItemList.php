<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;

class ItemList extends Component
{
    public $tab = 'recommend';

    protected $queryString = [
        'tab' => ['except' => 'recommend']
    ];

    public function setTab($tab)
    {
        $this->tab = $tab;
    }

    public function render()
    {
        $userId = Auth::id();

        if ($this->tab === 'recommend') {
            $items =Item::when($userId, function ($query) use ($userId) {
                $query->where('user_id', '!=', $userId);
            })
            ->latest()->get();
        }

        if ($this->tab === 'mylist') {
            if (!$userId) {
                $items =collect();
            } else {
                $items = Item::whereIn('id',
                Auth::user()->favorites()->pluck('item_id'))->latest()->get();
            }
        }

        return view('livewire.item-list',[
            'items' => $items,
        ]);
    }
}
