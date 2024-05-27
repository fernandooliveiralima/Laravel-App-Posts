<x-layout>

    <section>
        <div class="flex">
            <div class="flex mt-10">

                <a href="{{ route('posts.edit', $post->id) }}" 
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800 mt-5">Edit Post
                </a>

                {{-- <a href="{{ route('posts.destroy', $post->id) }}" 
                    class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 mt-5">Delete Post
                </a> --}}
                <form action="{{ route('posts.destroy', $post->id) }}" method="post">
                    @csrf
                    @method('DELETE')

                    <button class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800 mt-5" type="submit">Delete Post</button>
                </form>

            </div>
            
        </div>
    </section>

    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 mt-8 bg-slate-500 rounded-lg">
        <h1 class="text-4xl text-white font-semibold">{{ $post->title }}</h1>
        <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
            <p class=" text-indigo-700 text-lg font-semibold p-2">{{ $post->content}}</p>
        </main>
    </div>
</x-layout>