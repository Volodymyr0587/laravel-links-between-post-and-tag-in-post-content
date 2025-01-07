<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="relative flex flex-col rounded-lg">
                        <nav class="flex min-w-[240px] flex-col gap-1">
                            @forelse ($posts as $post)
                            <a href="{{ route('posts.show', $post) }}"
                                class="text-slate-800 flex w-full items-center rounded-md py-3 transition-all hover:bg-slate-100 focus:bg-slate-100 active:bg-slate-100">
                                @can('editPost', $post)
                                <span class="px-3 text-xs font-extrabold m-2 bg-lime-400 rounded-md">Your post</span>
                                @endcan
                                <span  class="ml-4">{{ $post->title }}</span>
                            </a>
                            @empty
                            <div>No content yet</div>
                            @endforelse
                        </nav>
                    </div>
                </div>
            </div>
            <div class="mt-2">
                {{ $posts->links() }}
            </div>
        </div>

    </div>
</x-app-layout>
