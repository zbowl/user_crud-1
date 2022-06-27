<x-main-layout>
    <x-slot name="title">
        {{ __('Registration') }}
    </x-slot>
    <x-slot name="slot">

        <div class="w-full lg:w-4/12 px-4 mx-auto pt-6">

            <div class="relative flex flex-col min-w-0 break-words w-full mb-6 shadow-lg rounded-lg bg-blue-200 border-0">

                <div class="flex-auto px-4 lg:px-10 py-10 pt-6">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-black-600 text-xs font-bold mb-2" for="name">
                                Name</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full @error('name') border-red-600 @enderror"
                                placeholder="Name">
                        </div>

                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-black-600 text-xs font-bold mb-2" for="username">Username</label>
                            <input
                                id="username"
                                name="username"
                                type="text"
                                class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:ring w-full @error('username') border-red-600 @enderror"
                                placeholder="Email">
                        </div>

                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-black-600 text-xs font-bold mb-2" for="email">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:ring w-full @error('email') border-red-600 @enderror"
                                placeholder="Email">
                        </div>

                        <div class="relative w-full mb-3">
                            <label class="block uppercase text-black-600 text-xs font-bold mb-2" for="password">Password</label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="border-0 px-3 py-3 text-black-600 bg-white rounded text-sm shadow focus:outline-none focus:ring w-full @error('password') border-red-600 @enderror"
                                placeholder="Password">
                        </div>

                        <div class="text-center mt-6">
                            <button
                                class="bg-blue-800 text-white active:bg-blue-600 text-sm font-bold uppercase px-6 py-3 rounded shadow hover:shadow-lg outline-none focus:outline-none mr-1 mb-1 w-full"
                                type="button">
                                Create Account
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </x-slot>
</x-main-layout>
