<x-app-layout>

    <div class="max-w-2xl mx-auto py-8">

        <h1 class="text-2xl font-bold mb-6">
            Edit Film
        </h1>

        <form action="{{ route('films.update', $film) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <input name="title" value="{{ old('title', $film->title) }}"
                class="w-full border-gray-300 rounded">

            <input name="year" value="{{ old('year', $film->year) }}"
                class="w-full border-gray-300 rounded">

            <input name="director" value="{{ old('director', $film->director) }}"
                class="w-full border-gray-300 rounded">

            <textarea name="description"
                class="w-full border-gray-300 rounded">{{ old('description', $film->description) }}</textarea>

            <input name="genre" value="{{ old('genre', $film->genre) }}"
                class="w-full border-gray-300 rounded">

            <input type="file" name="poster"
                class="w-full">

            <button class="px-4 py-2 bg-gray-900 text-white rounded">
                Update
            </button>

        </form>

    </div>

</x-app-layout>