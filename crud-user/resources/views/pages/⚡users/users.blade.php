<div class="md:flex md:justify-center md:gap-10">
    <section class=" m-auto w-1/3  my-10">
        <h2 class="text-xl mb-3 flex justify-center font-medium   ">Create New User</h2>
        @if (@session('success'))
            <div class="max-w-sm mx-auto mt-5 p-4 mb-4 text-sm text-fg-success-strong rounded-base bg-success-soft"
                role="alert">
                <span class="font-medium">{{ session('success') }}</span>
            </div>
        @endif
        <form wire:submit='createUser' class="max-w-sm mx-auto mt-4">
            <div class="mb-5">
                <label for="name-alternative" class="block mb-2.5 text-sm font-medium text-heading">Name</label>
                <input wire:model="name" type="name" id="name-alternative"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow placeholder:text-body"
                    placeholder="Input Your Name" required />
                @error('name')
                    <p class="mt-2.5 text-xs text-fg-danger-strong">
                        {{ $message }}.
                    </p>
                @enderror

            </div>
            <div class="mb-5">
                <label for="email-alternative" class="block mb-2.5 text-sm font-medium text-heading">Email</label>
                <input wire:model="email" type="email" id="email-alternative"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow placeholder:text-body"
                    placeholder="Input Your Email" required />
                @error('email')
                    <p class="mt-2.5 text-xs text-fg-danger-strong">
                        {{ $message }}.</p>
                @enderror

            </div>
            <div class="mb-5">
                <label for="password-alternative" class="block mb-2.5 text-sm font-medium text-heading">Password</label>
                <input wire:model="password" type="password" id="password-alternative"
                    class="bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand block w-full px-3 py-2.5 shadow placeholder:text-body"
                    placeholder="••••••••" required />
                @error('password')
                    <p class="mt-2.5 text-xs text-fg-danger-strong">
                        {{ $message }}.</p>
                @enderror
            </div>

            <div class="col-span-full mb-5">
                <label for="avatar" class="block text-sm/6 font-medium text-gray-900">Profile Picture</label>
                <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-6">
                    <div class="text-center">
                        <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                            class="mx-auto size-12 text-gray-300">
                            <path
                                d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                        <div class="mt-4 flex text-sm/6 text-gray-600">
                            <label for="avatar"
                                class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500">
                                <span>Upload a file</span>
                                <input wire:model='avatar' id="avatar" type="file"
                                    accept="image/png, image/jpg, image/jpeg" name="avatar" class="sr-only" />
                            </label>
                            <p class="pl-1">or drag and drop</p>
                        </div>
                        <p class="text-xs/5 text-gray-600">PNG, JPG up to 2MB</p>
                    </div>
                </div>
                @error('avatar')
                    <p class="mt-2.5 text-xs text-fg-danger-strong">
                        {{ $message }}.</p>
                @enderror
            </div>

            <div wire:loading wire:target='avatar'>
                <label for="photo" class="block text-sm/6 font-medium text-gray-900">Photo</label>
                <div
                    class="mb-5 mt-2 flex items-center justify-center bg-neutral-secondary-soft h-16 w-16 border border-default text-fg-brand-strong text-xs font-medium rounded-base">

                    <div role="status">
                        <svg aria-hidden="true" class="w-8 h-8 text-neutral-quaternary animate-spin fill-brand"
                            viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                fill="currentColor" />
                            <path
                                d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                fill="currentFill" />
                        </svg>
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
            </div>

            @if ($avatar)
                <div class="col-span-full">
                    <label for="photo" class="block text-sm/6 font-medium text-gray-900">Photo</label>
                    <div class="mt-2 flex mb-5 items-center gap-x-3">
                        {{-- <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                        class="size-12 text-gray-300">
                        <path
                            d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                            clip-rule="evenodd" fill-rule="evenodd" />
                    </svg> --}}
                        <img src="{{ $avatar->temporaryUrl() }}" alt=""
                            class=" w-16 h-16 block object-cover rounded-full border">
                    </div>
                </div>
            @endif

            <button type="submit"
                class="text-white bg-brand flex box-border border border-transparent hover:bg-brand-strong focus:ring-4 focus:ring-brand-medium shadow-xs font-medium leading-5 rounded-base text-sm px-4 py-2.5 focus:outline-none">


                {{-- <div wire:loading wire:target='submit'> --}}
                <svg wire:loading wire:target='createUser' aria-hidden="true"
                    class="w-4 h-4 text-neutral-quaternary animate-spin fill-brand self-center mr-2"
                    viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                        fill="currentColor" />
                    <path
                        d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                        fill="currentFill" />
                </svg>
                <span class="sr-only">Loading...</span>
                {{-- </div> --}}

                Create New User
            </button>
        </form>
    </section>

    <section class=" m-auto w-1/3  my-10">
        <h2 class="text-xl mb-3 flex justify-center font-medium">List All User</h2>

        @forelse ($users as $user)
            <ul role="list" class="divide-y divide-gray-100">
                <li class="flex justify-between items-center gap-x-6 py-5">
                    <div class="flex min-w-0 gap-x-4">
                        <img src="{{ $user->avatar ?? asset('image/Thumbnail.jpg') }}"
                            class="size-12 object-cover rounded-full bg-gray-50" />
                        <div class="min-w-0 flex-auto">
                            <p class="text-sm/6 font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                        {{-- <p class="text-sm/6 text-gray-900">Co-Founder / CEO</p> --}}
                        <p class="mt-1 text-xs/5 text-gray-500">{{ $user->created_at->diffForHumans() }}</p>
                        </p>
                    </div>
                </li>
            </ul>
        @empty
        @endforelse
        {{ $users->links() }}
    </section>
</div>
