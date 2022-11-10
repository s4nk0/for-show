@props(['submit'])
<div class="card">
    <x-jet-section-title>
        <x-slot name="title">@isset($title){{ $title }}@endisset</x-slot>
    </x-jet-section-title>
    <div class="card-body">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="form-row">
                    {{ $form }}
            @if (isset($actions))
                <div class="col-12 d-flex align-items-center">
                    {{ $actions }}
                </div>
            @endif
            </div>
        </form>

    </div>
</div>

