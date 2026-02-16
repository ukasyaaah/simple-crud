<?php

use App\Models\Movie;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component
{
    use WithFileUploads;

    #[Validate('required|image|max:2048')]
    public $image;

    #[Validate('required')]
    public $title;

    #[Validate('required')]
    public $description;

    public function store()
    {
        $this->validate();

        // store image
        $this->image->storeAs('movies', $this->image->hashName(), 'public');

        // get image name
        $imageName = $this->image->hashName();

        // insert data
        Movie::create([
            'image'   => $imageName,
            'title'   => $this->title,
            'description' => $this->description,
        ]);

        // flash message
        session()->flash('message', 'Data Movie Berhasil Disimpan.');

        // redirect to index
        return redirect()->route('movies.index');
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::app')
            ->title('Create Movie');
    }
};
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card border-0 rounded shadow-sm">
                <div class="card-body">

                    <form wire:submit.prevent="store" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" wire:model="image">
                            @error('image')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" wire:model="title">
                            @error('title')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>
                            <textarea class="form-control" wire:model="description" rows="5"></textarea>
                            @error('description')
                                <div class="alert alert-danger mt-2">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-md btn-primary">SAVE</button>
                        <a href="/" wire:navigate class="btn btn-md btn-secondary">BACK</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
