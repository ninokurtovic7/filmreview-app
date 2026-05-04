<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-2">
        <div class="flex justify-between items-center h-14">

            <!-- Lijevi dio headera -->
            <div class="flex items-center space-x-8">

                
                <a href="{{ route('films.index') }}">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-700 
                    hover:text-red-500" />
                </a>

                <!-- Link za pocetnu stranicu -->
                <a href="{{ route('films.index') }}"
                   class="text-xl text-gray-700 hover:text-red-500">
                    Films
                </a>

            </div>

            <!-- desna strana headera -->
            <div class="flex items-center space-x-8 ml-auto">

    @guest
        <a href="{{ route('login') }}" class="text-xl text-gray-700 hover:text-red-500">
            Log in
        </a>

        <a href="{{ route('register') }}" class="text-xl text-gray-700 hover:text-red-500">
            Register
        </a>
    @endguest

    @auth
        <x-dropdown align="right" width="48">
            <x-slot name="trigger">
                <button class="text-xl text-gray-700 hover:text-red-500">
                    {{ Auth::user()->name }}
                </button>
            </x-slot>

            <x-slot name="content">
                <x-dropdown-link :href="route('profile.edit')">
                    Profile
                </x-dropdown-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-dropdown-link>
                </form>
            </x-slot>
        </x-dropdown>
    @endauth

</div>

        </div>
    </div>

    <!-- DEFAULTNI MOBILNI MENU GENERATAN OD BREEZE-->
    <div :class="{ 'block': open, 'hidden': ! open }" class="hidden sm:hidden">

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')">
                Dashboard
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('films.index')">
                Films
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">

            @auth
                <div class="px-4 text-sm text-gray-800">
                    {{ Auth::user()->name }}
                </div>
            @endauth

            <div class="mt-3 space-y-1">

                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Log Out
                        </x-responsive-nav-link>
                    </form>
                @endauth

            </div>

        </div>

    </div>

</nav>