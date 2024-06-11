@props(['route' => ''])

<form method="POST" action="{{ $route }}">
    @csrf
    <button type="submit" {{ $attributes->merge(['class' => 'btn btn-primary']) }}>
        {{ $slot }}
    </button>
</form>
