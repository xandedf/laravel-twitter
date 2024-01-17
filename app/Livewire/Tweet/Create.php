<?php

namespace App\Livewire\Tweet;

use App\Models\Tweet;
use Illuminate\View\View;
use Livewire\Component;

class Create extends Component
{
    public ?string $body = null;

    public function render(): View
    {
        return view('livewire.tweet.create');
    }

    public function tweet(): void
    {
        Tweet::query()->create([
            'body' => $this->body,
            'created_by' => auth()->id()
        ]);

        $this->dispatch('tweet::created');
    }
}
