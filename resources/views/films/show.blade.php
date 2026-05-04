<x-app-layout>

    <div class="max-w-5xl mx-auto px-6 py-8">

        <!-- TITLE -->
        <h1 class="text-3xl font-bold text-gray-900 mb-6">
            {{ $film->title }}
        </h1>

        <!-- Main-->
        <div class="flex flex-col md:flex-row gap-6">

            <!-- poster -->
            <div class="w-full md:w-1/3">
                @if ($film->poster)
                    <img src="{{ asset('storage/' . $film->poster) }}"
                         class="w-full h-auto rounded shadow">
                @endif
            </div>

            <!-- detalji  -->
            <div class="w-full md:w-2/3 space-y-4">

                <p class="text-gray-700">
                    <span class="font-semibold">Year:</span> {{ $film->year }}
                </p>

                <p class="text-gray-700">
                    <span class="font-semibold">Director:</span> {{ $film->director }}
                </p>

                <p class="text-gray-700">
                    <span class="font-semibold">Genre:</span> {{ $film->genre }}
                </p>

                <p class="text-gray-700">
                    {{ $film->description }}
                </p>
              
                <p class="text-lg font-semibold text-red-700 "> Average User Score:
                  {{ number_format($film->reviews->avg('score'), 1) }}/10
                </p>
                  <button>  <a href="https://stremio.com"
                       class="px-4 py-2 bg-blue-700 text-white rounded text-sm ">
                        Watch this movie
                    </a>
                        </button>
               

                <!-- edit i delete dugmad, delete se pojavljuje samo ako je user admin -->
                <div class="flex gap-3 pt-4">

                    <a href="{{ route('films.edit', $film) }}"
                       class="px-4 py-2 bg-gray-900 text-white rounded text-sm">
                        Edit
                    </a>
                    @auth
                    @if (auth()->user()->is_admin)
                    <form action="{{ route('films.destroy', $film) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="px-4 py-2 bg-red-600 text-white rounded text-sm">
                            Delete
                        </button>
                    </form>
                    @endif
                    @endauth
                </div>

            </div>

        </div>

        <!-- Svi reviewovi -->
        <div class="mt-10">

            <h2 class="text-xl font-semibold mb-4">
                Reviews
            </h2>

            @foreach ($film->reviews as $review)
                <div class="border-b py-3">

                    <p class="font-semibold">
                        {{ $review->user->name }}
                    </p>

                    <p class="text-sm text-gray-600">
                        {{ $review->score }}/10
                    </p>

                    <p class="text-gray-700">
                        {{ $review->comment }}
                    </p>
                    
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="mt-2">
                        @csrf
                        @method('DELETE')

                        <button class="text-sm text-red-600">
                            Delete
                        </button>
                    </form>

                </div>
            @endforeach

        </div>

        <!-- Add review -->
        <div class="mt-8">

            <h2 class="text-xl font-semibold mb-4">
                Add Review
            </h2>

            <form action="{{ route('reviews.store', $film) }}" method="POST" class="space-y-3">
                @csrf

                <select name="score" class="w-full border-gray-300 rounded">
                    @for ($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endfor
                </select>

                <textarea name="comment" class="w-full border-gray-300 rounded"></textarea>

                <button class="px-4 py-2 bg-gray-900 text-white rounded">
                    Add Review
                </button>

            </form>

        </div>

    </div>

</x-app-layout>