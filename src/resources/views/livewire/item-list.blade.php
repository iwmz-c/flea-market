<div>
    <div class="tabs">
        <button wire:click="setTab('recommend')"
            class="{{ $tab === 'recommend'
                ? 'tab-btn-active'
                : 'tab-btn'
            }}">
            おすすめ
        </button>
        <button wire:click="setTab('mylist')"
            class="{{ $tab === 'mylist'
                ? 'tab-btn-active'
                : 'tab-btn'
            }}">
            マイリスト
        </button>
    </div>

    <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 px-10">
        @foreach($items as $item)
            <li class="item-card">
                <a href="{{ route('item.show', $item) }}">
                    <img src="{{ asset('storage/' . $item->item_image_path) }}" alt="{{ $item->name }}" class="item-image">
                    @if($item->purchase)
                        <div class="item-sold-label">SOLD</div>
                    @endif
                    <div>
                        <p class="item-name">{{ $item->name }}</p>
                    </div>
                </a>
            </li>
        @endforeach
    </ul>
</div>