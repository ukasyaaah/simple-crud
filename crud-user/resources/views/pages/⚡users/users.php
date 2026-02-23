<?php

use App\Models\User;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

new class extends Component
{
    use WithPagination, WithFileUploads;

    #[Validate('required|min:3|string')]
    public $name = '';

    #[Validate('required|email:dns|unique:users')]
    public $email = '';

    #[Validate('required|min:3')]
    public $password = '';

    #[Validate('image|max:2048')]
    public $avatar;

    public function createUser()
    {

        $validated = $this->validate();

        if ($this->avatar) {
            $validated['avatar'] = $this->avatar->store('avatar', 'public');
        }
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'avatar' => $validated['avatar']
        ]);

        session()->flash('success', 'User berhasil dibuat');
        return redirect()->to('/users');
    }

    public function render()
    {
        return $this->view([
            'users' => User::latest()->paginate(6),
        ])
            ->layout('layouts::app')
            ->title('User List');
    }
};
