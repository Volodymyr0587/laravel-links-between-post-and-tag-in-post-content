<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="my-4">
                        <p>Author: {{ $post->user->name }}</p>
                        <p>Publication date: {{ $post->created_at->format('Y-m-d') }}</p>
                        <p>Data and time of the last update: {{ $post->updated_at }}</p>
                    </div>

                    <div class="mt-8">
                        <div class="mb-4">
                            <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/an-ornithologist-rings-a-migratory-warbler-bird.jpeg') }}" alt="">
                        </div>
                        <p
                            class="mb-3 text-gray-500 first-line:uppercase first-line:tracking-widest first-letter:text-7xl first-letter:font-bold first-letter:text-gray-900 first-letter:me-3 first-letter:float-start">
                        {!! $post->content !!}
                        </p>

                    </div>

                    @can('editPost', $post)
                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        <a href="{{ route('posts.edit', $post) }}" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Edit
                        </a>
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?');"
                                class="rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-600">
                                Delete
                            </button>
                        </form>
                    </div>
                    @endcan
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
