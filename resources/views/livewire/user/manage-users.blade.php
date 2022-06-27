<div>
        <div class="w-full px-4 mx-auto pt-6">
            <div class="relative">
                <div class="flex items-center justify-between mb-1">
                    <!-- searchbox -->
                    <div class="flex items-center h-10">
                        @error('*')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div x-data>
                        <button type="button"
                                class="p-1 text-black bg-lime-800 hover:bg-lime-400"
                                @click="$wire.resetFilters()">
                            Reset
                        </button>
                        @foreach($emailDomains as $key => $value)
                            <button type="button"
                                    class="p-1 text-black bg-sky-700"
                                    @click="$wire.filterDomain('{{ $value }}')"
                                    wire:key="{{ $key }}">
                                {{ $value }}
                            </button>
                        @endforeach
                    </div>
                    <!-- right side loading -->
                    <div class="flex flex-wrap items-center space-x-1">
                        <x-icons.cog wire:loading wire:target="users" class="text-gray-400 h-9 w-9 animate-spin"/>
                    </div>
                </div>
            </div>
            <!-- table -->
            <div wire:loading.class="opacity-50" wire:target="users" class="rounded-lg">
                <div x-data="{
                        open: @entangle('newUserInputFieldOpen'),
                        fields: @entangle('newUsers').defer,
                        users: @entangle('users'),
                        addNewField() {
                            this.fields.push({
                                name: '',
                                username: '',
                                email: '',
                                password: '',
                            })
                        },
                        removeField(index) {
                            this.fields.splice(index, 1)
                        },
                        toggle() {
                            if (this.open && !this.fields.length > 0) {
                                return this.close()
                            }
                            this.open = true
                        },
                        close() {
                            if (! this.open) return
                            this.open = false
                        }
                    }">
                    <div class="w-full px-4 pt-6">
                        <table class="table-auto">
                            <thead class="align-middle">
                            <tr class="divide-x divide-blue-300">
                                <th class="w-1/12 h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left leading-4 font-medium text-gray-500 uppercase focus:outline-none">
                                    {{ __('ID') }}
                                </th>
                                <th class="w-4/12 h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left leading-4 font-medium text-gray-500 uppercase focus:outline-none">
                                    {{ __('Name') }}
                                </th>
                                <th class="w-4/12 h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left leading-4 font-medium text-gray-500 uppercase focus:outline-none">
                                    {{ __('Username') }}
                                </th>
                                <th class="w-4/12 h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left leading-4 font-medium text-gray-500 uppercase focus:outline-none">
                                    {{ __('Email') }}
                                </th>
                                <th class="w-4/12 h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left leading-4 font-medium text-gray-500 uppercase focus:outline-none">
                                    {{ __('Password') }}
                                </th>
                                <th class="w-1/12 h-full px-6 py-3 border-b border-gray-200 bg-gray-50 text-left leading-4 font-medium text-gray-500 uppercase focus:outline-none">
                                    {{ __('Action') }}
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $index => $user)
                                <tr class="divide-x divide-blue-300 divide-y divide-teal-600"
                                    wire:key="user-row-{{ $index }}"
                                    id="user-row-{{ $index }}"
                                >
                                    <td class="px-6 py-2 bg-blue-200 text-left text-black">
                                        {{ $user['id'] }}
                                    </td>
                                    <td class="px-6 py-2 bg-blue-200 text-left text-black">
                                        {{ $user['name'] }}
                                    </td>
                                    <td class="px-6 py-2 bg-blue-200 text-left text-black">
                                        {{ $user['username'] }}
                                    </td>
                                    <td class="px-6 py-2 bg-blue-200 text-left text-black">
                                        {{ $user['email'] }}
                                    </td>
                                    <td class="px-6 py-2 bg-blue-200 text-left text-black">
                                        {{ $user['password'] }}
                                    </td>
                                    <td class="px-4 bg-blue-200 text-left text-black">
                                        <div class="flex flex-auto">
                                            <div class="pr-3">
                                                <!-- Edit Model -->
                                                <x-modal :index="$index" :user="$user" />
                                            </div>

                                            <div>
                                                <button wire:click="deleteUser('{{ $user->id }}')"
                                                        class="p-1 text-white bg-red-800 hover:bg-red-600 rounded">
                                                    {{ __('Delete') }}
                                                </button>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach

                            <template x-for="(field, index) in fields" :key="index" wire:key="index">
                                <tr class="divide-x divide-blue-300 divide-y divide-teal-600">
                                    <td class="px-6 py-2 bg-blue-200 text-left text-black"
                                        x-id="['user-input']"
                                        x-text="index + 1">
                                    </td>
                                    <td class="relative px-4 py-2 bg-blue-200 text-left text-black"
                                        x-id="['user-input']"
                                    >
                                        <div class="flex flex-col items-start">
                                            <input :id="$id('user-input')"
                                                   class="peer w-full placeholder-transparent"
                                                   x-model="field.name"
                                                   type="text"
                                                   placeholder="{{ __('Name') }}"
                                                   autocomplete="off"
                                            />
                                            <label :for="$id('user-input')"
                                                   class="absolute ml-2 mt-0 text-xs text-blue-800
                                                       peer-placeholder-shown:ml-4
                                                       peer-placeholder-shown:mt-2.5
                                                       peer-placeholder-shown:text-base
                                                       peer-placeholder-shown:text-gray-400
                                                       peer-focus:ml-2
                                                       peer-focus:text-xs
                                                       peer-focus:mt-0
                                                       peer-focus:text-blue-800
                                                       transition-all
                                                       duration-500">
                                                {{ __('Name') }}
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 bg-blue-200 text-left text-black"
                                        x-id="['user-input']"
                                    >
                                        <div class="flex flex-col items-start">
                                            <input :id="$id('user-input')"
                                                   class="peer w-full placeholder-transparent"
                                                   x-model="field.username"
                                                   type="text"
                                                   placeholder="{{ __('Username') }}"
                                                   autocomplete="off"
                                            />
                                            <label :for="$id('user-input')"
                                                   class="absolute ml-2 mt-0 text-xs text-blue-800
                                                       peer-placeholder-shown:ml-4
                                                       peer-placeholder-shown:mt-2.5
                                                       peer-placeholder-shown:text-base
                                                       peer-placeholder-shown:text-gray-400
                                                       peer-focus:ml-2
                                                       peer-focus:text-xs
                                                       peer-focus:mt-0
                                                       peer-focus:text-blue-800
                                                       transition-all
                                                       duration-500">
                                                {{ __('Username') }}
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 bg-blue-200 text-left text-black"
                                        x-id="['user-input']"
                                    >
                                        <div class="flex flex-col items-start">
                                            <input :id="$id('user-input')"
                                                   class="peer w-full placeholder-transparent"
                                                   x-model="field.email"
                                                   type="text"
                                                   placeholder="{{ __('Email') }}"
                                                   autocomplete="off"
                                            />
                                            <label :for="$id('user-input')"
                                                   class="absolute ml-2 mt-0 text-xs text-blue-800
                                                       peer-placeholder-shown:ml-4
                                                       peer-placeholder-shown:mt-2.5
                                                       peer-placeholder-shown:text-base
                                                       peer-placeholder-shown:text-gray-400
                                                       peer-focus:ml-2
                                                       peer-focus:text-xs
                                                       peer-focus:mt-0
                                                       peer-focus:text-blue-800
                                                       transition-all
                                                       duration-500">
                                                {{ __('Email') }}
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 bg-blue-200 text-left text-black"
                                        x-id="['user-input']"
                                    >
                                        <div class="flex flex-col items-start">
                                            <input :id="$id('user-input')"
                                                   class="peer w-full placeholder-transparent"
                                                   x-model="field.password"
                                                   type="text"
                                                   name="password[]"
                                                   placeholder="{{ __('Password') }}"
                                                   autocomplete="off"
                                            />
                                            <label :for="$id('user-input')"
                                                   class="absolute ml-2 mt-0 text-xs text-blue-800
                                                       peer-placeholder-shown:ml-4
                                                       peer-placeholder-shown:mt-2.5
                                                       peer-placeholder-shown:text-base
                                                       peer-placeholder-shown:text-gray-400
                                                       peer-focus:ml-2
                                                       peer-focus:text-xs
                                                       peer-focus:mt-0
                                                       peer-focus:text-blue-800
                                                       transition-all
                                                       duration-500">
                                                {{ __('Password') }}
                                            </label>
                                        </div>
                                    </td>
                                    <td class="px-4 py-2 bg-blue-200 text-left text-black"
                                        x-id="['user-input']"
                                    >
                                        <button :id="$id('user-input')"
                                                type="button"
                                                class="p-1 text-white bg-rose-700 hover:bg-rose-400 rounded"
                                                @click="removeField(index); toggle();">
                                            &times;
                                        </button>
                                    </td>
                                </tr>
                            </template>
                            </tbody>
                            <tfoot class="border-t-2 border-t-blue-300 p-3">
                            <tr class="bg-blue-200">
                                <td colspan="6" class="text-right pt-3 pb-3 pr-1">

                                    <div class="justify-between">
                                        <button x-show="open" type="button" class="p-1 text-white bg-sky-700 hover:bg-sky-400"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-0"
                                                x-transition:enter-end="opacity-100 translate-y-0"
                                                x-transition:leave="transition ease-in duration-300"
                                                x-transition:leave-start="opacity-100 translate-y-10"
                                                x-transition:leave-end="opacity-0 translate-y-0"
                                                x-cloak
                                        wire:click="storeUser">
                                            {{ __('Save') }}
                                        </button>
                                        <button type="button" class="p-1 text-white bg-teal-700 hover:bg-teal-400"
                                                @click="addNewField(); toggle()">
                                            {{ __('+ Add User') }}
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>

</div>
