<flux:select {{ $attributes }} :label="$label">
    <flux:select.option value="">{{ __('Select a role') }}</flux:select.option>

    @foreach ($roles as $role)
        <flux:select.option value="{{ $role->value }}">{{ $role->value }}</flux:select.option>
    @endforeach
</flux:select>
