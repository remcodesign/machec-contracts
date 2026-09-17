@foreach ($links as $link)
    <flux:sidebar.item icon="arrow-top-right-on-square" href="{{ $link['url'] }}">
        {{ $link['label'] }}
    </flux:sidebar.item>
@endforeach
