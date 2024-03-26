<x-filament::page>
    <form wire:submit.prevent="submit">
        {{ $this->form }}

        <x-filament::button
            class="mt-6"
            type="submit">
            Send Message
        </x-filament::button>
    </form>
</x-filament::page>
