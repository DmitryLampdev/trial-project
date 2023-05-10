<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ isset($user) ? 'Edit' : 'Create' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="post" action="{{ isset($user) ? route('user.update', $user->id) : route('user.store') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <x-label for="name" value="Name" />
                            <x-input id="name" name="name" type="text" class="mt-1 block w-full" :value="$user->name ?? old('name')" required autofocus />
                        </div>
                        <div>
                            <x-label for="email" value="Email" />
                            <x-input id="email" name="email" type="text" class="mt-1 block w-full" :value="$user->email ?? old('email')" required autofocus />
                        </div>
                        <div>
                            <x-label for="title" value="Title" />
                        <x-input id="title" name="title" type="text" class="mt-1 block w-full" :value="isset($user) ? $user->getMeta('user_title') : ''" required autofocus />
                        </div>
                        <div>
                            <x-label for="role" value="Role" />
                            <x-input id="role" name="role" type="text" class="mt-1 block w-full" :value="isset($user) ? $user->getMeta('user_role') : ''" required autofocus />
                        </div>
                        <div class="flex items-center gap-4">
                            <x-button>{{ __('Save') }}</x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>