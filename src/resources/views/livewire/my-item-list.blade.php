<div>
    <div class="tabs">
        <button
            wire:click="setTab('sell')"
            class="{{ $page === 'sell'
                ? 'tab-btn-active'
                : 'tab-btn' }}">
            出品した商品
        </button>
        <button
            wire:click="setTab('buy')"
            class="{{ $page === 'buy'
                ? 'tab-btn-active'
                : 'tab-btn' }}">
            購入した商品
        </button>
    </div>

    @if($items->isEmpty())
        <p>該当する商品はありません</p>
    @else
        <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-10 px-10">
            @foreach($items as $item)
                <li class="item-card">
                    <a href="{{ route('item.show', $item) }}">
                        <img src="{{ asset('storage/' . $item->item_image_path) }}" alt="{{ $item->name }}" class="item-image">
                        <div>
                            <p class="item-name">{{ $item->name }}</p>
                            @if($page === 'sell' && $item->isSold())
                                <span class="sold-label">SOLD</span>
                            @endif
                        </div>
                    </a>
                </li>
            @endforeach
        </ul>
    @endif
</div>
