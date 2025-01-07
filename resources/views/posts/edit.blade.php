<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }} - {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="space-y-12">
                            <div class="border-b border-gray-900/10 pb-12">
                                <h2 class="text-base/7 font-semibold text-gray-900">Post Information</h2>

                                <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">

                                    <div class="sm:col-span-4">
                                        <label for="title"
                                            class="block text-sm/6 font-medium text-gray-900">Title</label>
                                        <div class="mt-2">
                                            <input id="title" name="title" type="text" autocomplete="title" value="{{ old('title', $post->title) }}"
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
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">{{ old('content', $post->content) }}</textarea>
                                        </div>
                                        @error('content')
                                            <p class="mt-2 text-sm text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="sm:col-span-4">
                                        <label for="tags"
                                            class="block text-sm/6 font-medium text-gray-900">Tags (separated by commas)</label>
                                        <div class="mt-2">
                                            <input id="tags" name="tags" type="text" value="{{ old('tags', $post->tags->pluck('name')->implode(',')) }}" placeholder="Enter tags separated by commas"
                                                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                                        </div>
                                        @error('tags')
                                            <p class="mt-2 text-sm text-red-500 font-semibold">{{ $message }}</p>
                                        @enderror
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="mt-6 flex items-center justify-end gap-x-6">
                            <a href="{{ route('dashboard') }}" class="text-sm/6 font-semibold text-gray-900">Cancel</a>
                            <button type="submit"
                                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Update</button>
                        </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
</x-app-layout>

