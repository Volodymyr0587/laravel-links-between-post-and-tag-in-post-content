<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 grid-cols-1">


                    <a href="{{ route('posts.create') }}"
                        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                        Create post
                    </a>

                    <p class="my-8 text-lg">{{ __("List of your posts") }}<span class="text-sm ml-2 italic">(To edit a
                            post, click its name in the list)</span></p>

                    <ul class="space-y-4 text-left text-gray-500">
                        @forelse (auth()->user()->posts as $post)
                        <li class="flex items-center space-x-3 rtl:space-x-reverse">
                            <svg class="flex-shrink-0 w-5 h-5 text-indigo-600" fill="currentColor" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 67.025 67.026"
                                xml:space="preserve" transform="rotate(0)matrix(-1, 0, 0, 1, 0, 0)">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <g>
                                        <g>
                                            <g>
                                                <polygon
                                                    points="41.441,29.477 44.576,31.269 50.848,27.685 41.441,22.086 ">
                                                </polygon>
                                                <path
                                                    d="M60.48,18.052l2.24-4.031c1.791-3.137-3.359-6.721-5.824-8.063c-2.465-1.345-8.063-4.257-9.855-0.896l-3.137,5.376 c-3.137-0.672-6.721-1.12-10.304-1.12C15.008,9.317,0,19.398,0,31.718c0,12.318,15.008,22.398,33.6,22.398c0,0,0,0,0.225,0 c0.224,2.688-2.912,7.168-7.393,9.407c17.698,0,25.761-13.216,25.761-13.216c8.959-4.032,14.783-10.752,14.783-18.592 C67.424,26.565,64.736,21.861,60.48,18.052z M15.455,37.99c-1.792,0-3.136-1.346-3.136-3.138c0-1.792,1.344-3.136,3.136-3.136 s3.136,1.344,3.136,3.136C18.591,36.644,17.025,37.99,15.455,37.99z M23.743,37.99c-1.792,0-3.136-1.346-3.136-3.138 c0-1.792,1.344-3.136,3.136-3.136s3.136,1.344,3.136,3.136C26.879,36.644,25.535,37.99,23.743,37.99z M32.032,37.99 c-1.792,0-3.137-1.346-3.137-3.138c0-1.792,1.345-3.136,3.137-3.136s3.136,1.344,3.136,3.136 C35.168,36.644,33.824,37.99,32.032,37.99z M51.969,28.357l-6.496,3.584l-5.377,2.911v-6.047v-7.392l8.961-15.456 c0.447-0.896,3.584,0,6.943,1.792s5.6,4.031,4.928,4.928L51.969,28.357z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                            <p class="group relative">
                                <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                <span
                                    class="absolute -bottom-1 left-1/2 w-0 transition-all h-0.5 bg-indigo-600 group-hover:w-3/6"></span>
                                <span
                                    class="absolute -bottom-1 right-1/2 w-0 transition-all h-0.5 bg-indigo-600 group-hover:w-3/6"></span>
                            </p>
                        </li>
                        @empty
                        No posts
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
