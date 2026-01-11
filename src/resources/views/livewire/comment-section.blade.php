<div class="comment-area">

    <p class="item-data__title-comment">
        コメント（{{ $comments->count() }}）
    </p>

    <ul class="comment-list">
        @foreach ($comments as $comment)
            @php
                $commentUser = $comment->user;
                $profile = $commentUser->profile;

                $profileImage = $profile?->profile_image_path
                    ? asset('storage/' . $profile->profile_image_path)
                    : null;
            @endphp
            
            <li class="comment-item">
                <div class="comment-profile__image" style="{{ $profileImage ? "background-image: url('$profileImage')" : '' }}"></div>
                <div class="comment-profile__name">
                    {{ $profile->profile_name ?? $commentUser->name }}
                </div>
            </li>
            <p class="comment-content">
                {{ $comment->content }}
            </p>
        @endforeach
    </ul>

    <p class="comment-form__title">商品へのコメント</p>

    @auth
        <form wire:submit.prevent="submit">
            <textarea class="comment-form" wire:model.defer="content"></textarea>
            @error('content')
                <p>{{ $message }}</p>
            @enderror
            <button class="comment-form__submit" type="submit">コメントを送信する</button>
        </form>
    @else
        <p>
            <a href="{{ route('login') }}">ログイン</a>してコメントできます
        </p>
    @endauth
</div>
