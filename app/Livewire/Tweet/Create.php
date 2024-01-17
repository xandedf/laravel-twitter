<?php

namespace App\Livewire\Tweet;

use App\Models\Tweet;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    use AuthorizesRequests;

    public ?string $body = null;

    public function render(): View
    {
        return view('livewire.tweet.create');
    }

    /**
     * @throws AuthorizationException
     */
    public function tweet(): void
    {
        $this->authorize('create', Tweet::class);

        $this->validate([
            'body' => ['required', 'max:140']
        ]);

        Tweet::query()->create([
            'body' => $this->body,
            'created_by' => auth()->id()
        ]);

        $this->dispatch('tweet::created');
    }
}
