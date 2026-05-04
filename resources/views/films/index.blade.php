<x-app-layout>

    <div class="max-w-7xl mx-auto px-6 py-6">

        <!--dio iznad grida i search bar -->
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold text-gray-900">
                Films
            </h1>

            <form method="GET" action="{{ route('films.index') }}" class="mb-6 flex gap-2 mt-1">
    <input 
        type="text"
        name="search"
        value="{{ request('search') }}"
        placeholder="Search films..."
        class="w-full border-gray-300 rounded"
    >

    <button class="px-4 py-2 bg-gray-900 text-white rounded">
        Search
    </button>
</form>

            <a href="{{ route('films.create') }}"
               class="px-4 py-2 bg-gray-900 text-white text-sm rounded hover:bg-gray-800 ">
                Dodaj Film
            </a>
        </div>

        <!-- Grid sa filmovima -->
    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">

      @foreach ($films as $film)
        <a href="{{ route('films.show', $film) }}"
        class="block bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-lg transition text-center">

    
        <h2 class="text-base font-semibold text-gray-900 pt-4 mb-2">
            {{ $film->title }}
        </h2>

        <!-- Poster ako postoji, ako ne postoji no image -->
        @if ($film->poster)
            <img src="{{ asset('storage/' . $film->poster) }}"
             class="w-full h-82 object-cover">
        @else
            <div class="w-full h-82 bg-gray-200 flex items-center justify-center text-gray-500 text-sm">
                No Image
            </div>
        @endif

        <p class="text-sm text-gray-600 py-3">
            {{ $film->year }} | {{ $film->genre }}
        </p>

    </a>
     @endforeach

        </div>

    </div>

</x-app-layout>