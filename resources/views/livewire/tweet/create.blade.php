<div>
    <div>
        <label>
            <textarea wire:model="body" placeholder="Write your tweet!!"></textarea>
        </label>
        @error('body') <span class="text-red-200 font-bold">{{ $message }}</span> @enderror
    </div>

    <x-primary-button wire:click="tweet">Tweet 🐦</x-primary-button>
</div>
