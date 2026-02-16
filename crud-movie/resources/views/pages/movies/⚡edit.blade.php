<?php

use App\Models\Movie;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

new class extends Component
{
    use WithFileUploads;

    public Movie $movie;

    #[Validate('nullable|image|max:2048')]
    public $image;

    #[Validate('required')]
    public $title;

    #[Validate('required')]
    public $description;

    public function mount($id)
    {
        $this->movie = Movie::findOrFail($id);

        // set default value from database
        $this->title = $this->movie->title;
        $this->description = $this->movie->description;
    }

    public function update()
    {
        $this->validate();

        // if upload new image, replace image
        if ($this->image) {

            // delete old image
            Storage::disk('public')->delete('movies/'.$this->movie->image);
            
            // store image
            $this->image->storeAs('movies', $this->image->hashName(), 'public');

            // get image name
            $imageName = $this->image->hashName();

        } else {
            $imageName = $this->movie->image;
        }

        // update to database
        $this->movie->update([
            'image'   => $imageName,
            'title'   => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('message', 'Data Movie Berhasil Diupdate.');

        return redirect()->route('movies.index');
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts::app')
            ->title('Edit Movie');
    }
};
?>

<div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">

            <div class="card border-0 rounded shadow-sm">
                <div class="card-body">

                    <form wire:submit.prevent="update" enctype="multipart/form-data">

                        <div class="mb-3 text-center">
                            <label class="form-label">Image</label><br>
                            <img src="{{ asset('/storage/movies/'.$movie->image) }}" class="rounded mb-2" width="150">
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

                        <button type="submit" class="btn btn-md btn-primary">UPDATE</button>
                        <a href="/" wire:navigate class="btn btn-md btn-secondary">BACK</a>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
