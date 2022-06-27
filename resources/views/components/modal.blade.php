
<div x-data="{
        isModalOpen: false
    }"
     @keydown.escape="isModalOpen = false"
>

        <button type="button" class="p-1 text-white bg-purple-800 hover:bg-purple-600 rounded" @click="isModalOpen = true">
            Edit
        </button>
        <!-- overlay -->
        <div
            class="overflow-auto"
            style="background-color: rgba(0,0,0,0.5)"
            x-show="isModalOpen"
            :class="{ 'absolute inset-0 z-10 flex items-start justify-center': isModalOpen }"
        >
            <!-- dialog -->
            <div
                class="w-6/12 bg-white shadow-2xl m-4 sm:m-8"
                x-show="isModalOpen"
                @click.away="isModalOpen = false"
                x-cloak
            >
                <div class="flex justify-between items-center border-b p-2 text-xl">
                    <h6 class="text-xl font-bold">Edit User: </h6>
                    <button type="button"
                            class="p-2 text-white bg-rose-700 rounded"
                            @click="isModalOpen = false">
                        &times;
                    </button>
                </div>
                <div class="p-2">
                    <!-- content -->
                    <div class="flex-auto px-4 lg:px-10 py-10 pt-6">
                        <form method="POST" wire:submit.prevent="saveUser">
                            @csrf
                            <div wire:key="user-modal-{{ $index }}" class="relative w-full mb-3">
                                <label class="block uppercase text-black-600 text-xs font-bold mb-2" for="name">
                                    Name</label>
                                <input
                                    id="user-modal-name-{{ $index }}"
                                    name="name"
                                    type="text"
                                    class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full @error('name') border-red-600 @enderror"
                                    placeholder="Name"
                                    wire:model="users.{{ $index }}.name">
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-black-600 text-xs font-bold mb-2"
                                       for="username">{{ __('Username') }}</label>
                                <input
                                    id="user-modal-username-{{ $index }}"
                                    name="username"
                                    type="text"
                                    class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:ring w-full @error('username') border-red-600 @enderror"
                                    wire:model="users.{{ $index }}.username">
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-black-600 text-xs font-bold mb-2"
                                       for="email">Email</label>
                                <input
                                    id="user-modal-email-{{ $index }}"
                                    name="email"
                                    type="email"
                                    class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:ring w-full @error('email') border-red-600 @enderror"
                                    placeholder="Email"
                                    wire:model="users.{{ $index }}.email">
                            </div>
                            <div class="relative w-full mb-3">
                                <label class="block uppercase text-black-600 text-xs font-bold mb-2"
                                       for="password">Password</label>
                                <input
                                    id="user-modal-password-{{ $index }}"
                                    name="password"
                                    type="password"
                                    class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full @error('password') border-red-600 @enderror"
                                    placeholder="Password"
                                    wire:model="users.{{ $index }}.password">
                            </div>
                            <div class="text-center mt-6">
                                <button
                                    class="bg-blue-800 text-white active:bg-blue-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                    type="submit">
                                    Save
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>
