<x-app-layout>

    <div class="max-w-2xl mx-auto py-8">

        <h1 class="text-2xl font-bold mb-6">
            Dodaj Film
        </h1>

        <form action="{{ route('films.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <input name="title" placeholder="Title"
                class="w-full border-gray-300 rounded">

            <input name="year" placeholder="Year"
                class="w-full border-gray-300 rounded">

            <input name="director" placeholder="Director"
                class="w-full border-gray-300 rounded">

            <textarea name="description" placeholder="Description"
                class="w-full border-gray-300 rounded"></textarea>

            <input name="genre" placeholder="Genre"
                class="w-full border-gray-300 rounded">

            <input type="file" name="poster"
                class="w-full">

            <button class="px-4 py-2 bg-gray-900 text-white rounded">
                Save
            </button>

        </form>

    </div>

</x-app-layout>