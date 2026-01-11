<div class="reaction-item">
    <button type="button" wire:click="toggleLike" class="reaction-icon">
        <span class="{{ $liked ? 'liked' : '' }}">♡</span>
    </button>
    <span class="reaction-count">{{ $count }}</span>
</div>

