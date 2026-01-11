<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Item;

class CommentSection extends Component
{
    public $item;
    public $content = '';

    protected function rules()
    {
        return [
        'content' => ['required', 'string', 'max:255'],
        ];
    }

    public function messages() {
        return [
            'content.required' => 'コメントを入力してください',
            'content.max' => 'コメントは255文字以内で入力してください',
        ];
    }

    public function submit()
    {
        $this->validate();

        auth()->user()->comments()->create([
            'item_id' => $this->item->id,
            'content' => $this->content,
        ]);

        $this->content = '';

        $this->emit('commentAdded');
    }
    
    public function render()
    {
        return view('livewire.comment-section', [
            'comments' => $this->item->comments()->latest()->get(),
        ]);
    }
}
