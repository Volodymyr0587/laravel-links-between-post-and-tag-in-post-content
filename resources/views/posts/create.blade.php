<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Post Information</h2>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="sm:col-span-4">
                                        <label for="title"
                                            class="block text-sm/6 font-medium text-gray-900">Title</label>
                                        <div class="mt-2">
                                            <input id="title" name="title" type="text" autocomplete="title" value="{{ old('title') }}"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('title')
                                            <p class="mt-2 text-sm text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="content"
                                            class="block text-sm/6 font-medium text-gray-900">Content</label>
                                        <div class="mt-2">
                                            <textarea name="content" id="content" rows="3"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('content') }}</textarea>
                                        </div>
                                        @error('content')
                                            <p class="mt-2 text-sm text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="tags"
                                            class="block text-sm/6 font-medium text-gray-900">Tags (separated by commas)</label>
                                        <div class="mt-2">
                                            <input id="tags" name="tags" type="text" placeholder="Enter tags separated by commas" value="{{ old('tags') }}"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('tags')
                                            <p class="mt-2 text-sm text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="col-span-full">
                                        <label for="image" class="block text-sm/6 font-medium text-gray-900">Image</label>
                                        <div class="mt-2 flex items-center gap-x-3">
                                            <input type="file" name="image" id="image">
                                            @error('image')
                                                <span class="text-sm font-bold text-red-500 mt-2">{{ $message }}</span>
                                            @enderror
                                          {{-- <svg class="size-12 text-gray-300" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true" data-slot="icon">
                                            <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                                          </svg>
                                          <button type="button" class="rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50">Change</button> --}}
                                        </div>
                                      </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('dashboard') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                            <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>
