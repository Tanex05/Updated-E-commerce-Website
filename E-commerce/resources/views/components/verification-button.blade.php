@props(['url' => '#'])

<button {{ $attributes->merge(['class' => 'btn btn-primary']) }}>
    <a href="{{ $url }}" style="color: white; text-decoration: none;">
        {{ $slot }}
    </a>
</button>
