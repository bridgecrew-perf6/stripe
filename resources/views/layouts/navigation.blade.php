<nav x-data="{ open: false }" class="w-full bg-white border-b border-gray-100 fixed">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center min-w-600">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('accueil') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden sm:flex sm:items-center">
                    <div class="space-x-8 sm:-my-px sm:ml-10 sm:flex items-center justify-between ">
                        @if(!empty($user))
                        <x-nav-link :href="route('user-events',[$user])" :active="request()->routeIs('user-events')">
                        {{ __('Events') }}
                        </x-nav-link>
                        @else
                        <x-nav-link :href="route('event.index')" :active="request()->routeIs('event.index')">
                        {{ __('Events') }}
                        </x-nav-link>
                        @endif

                        @if(!empty($user))
                        <x-nav-link :href="route('user-encours',[$user])" :active="request()->routeIs('user-encours')">
                        {{ __('Events En cours') }}
                        </x-nav-link>
                        @else
                        <x-nav-link :href="route('encours')" :active="request()->routeIs('encours')">
                        {{ __('Events En cours') }}
                        </x-nav-link>
                        @endif

                        @if(!empty($user))
                        <x-nav-link :href="route('user-termine', [$user])" :active="request()->routeIs('user-termine')">
                        {{ __('Events terminés') }}
                        </x-nav-link>
                        @else
                        <x-nav-link :href="route('termine')" :active="request()->routeIs('termine')">
                        {{ __('Events terminés') }}
                        </x-nav-link>
                        @endif

                        <x-nav-link :href="route('event.create')" :active="request()->routeIs('event.create')">
                        {{ __('Ajouter un Event') }}
                        </x-nav-link>

                        <x-nav-link :href="route('user-list')" :active="request()->routeIs('user-list')">
                        {{ __('Utilisateurs') }}
                        </x-nav-link>
                    </div>
                </div>
            </div>

            <div class="relative">
            @guest  
            <div class="hidden top-0 right-0 px-6 py-4 sm:block">
                <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline mr-5">Login</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                @endif
            </div>
            @endguest
        
        

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                @auth
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>
                    @endauth
                    <x-slot name="content">
                        <!-- Authentication -->
                        <a class="ml-4" href="{{ route('user-events',[Auth::user()]) }}">Mes Events</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>


    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">

        <!-- Responsive Settings Options -->
        <div class="pt-4 border-t border-gray-200 bg-gray-600 pb-4">
            @auth
            <div class="px-4">
                <div class="font-medium text-lg text-green-500">{{ Auth::user()->name }}</div>
                <div class="font-medium text-base text-gray-400">{{ Auth::user()->email }}</div>
            </div>


            <div class="mt-3 space-y-1">
                <!-- Authentication -->
                <div class="mt-3 px-4 text-center h-10">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('user-events', [Auth::user()]) }}" class="text-sm text-gray-400 mr-5 hover:text-white">Mes Events</a>
                        <a class="font-medium text-sm mb-10 text-gray-400 underline hover:text-white" href="{{ route('logout')}}"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('logout') }}
                        </a>
                    </form>
                </div>
            </div>
            @endauth

            <div class="mt-3 space-y-1">
                @if(empty($user))
                    <x-responsive-nav-link class="text-white" :href="route('event.index')" :active="request()->routeIs('event.index')">
                        {{ __('Events') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link class="text-white" :href="route('user-events', [$user])" :active="request()->routeIs('user-events', [$user])">
                        {{ __('Events') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                @if(empty($user))
                    <x-responsive-nav-link class="text-white" :href="route('encours')"     :active="request()->routeIs('encours')">
                        {{ __('Events en cours') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link class="text-white" :href="route('user-encours', [$user])" :active="request()->routeIs('user-encours', [$user])">
                        {{ __('Events en cours') }}
                    </x-responsive-nav-link>
                 @endif
            </div>

            <div class="mt-3 space-y-1">
                @if(empty($user))
                    <x-responsive-nav-link class="text-white" :href="route('termine')" :active="request()->routeIs('termine')"> 
                        {{ __('Events terminé') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link class="text-white" :href="route('user-termine', [$user])" :active="request()->routeIs('user-termine', [$user])"> 
                        {{ __('Events terminé') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                @if(request()->routeIs('event.create'))
                    <x-responsive-nav-link class="text-white" :active="request()->routeIs('event.create')">
                        {{ __('Ajouter un Event') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link class="text-white" :href="route('event.create')">
                        {{ __('Ajouter un Event') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            <div class="mt-3 space-y-1">
                @if(request()->routeIs('user-list'))
                    <x-responsive-nav-link class="text-white" :active="request()->routeIs('user-list')">
                        {{ __('Utilisateurs') }}
                    </x-responsive-nav-link>
                @else
                    <x-responsive-nav-link class="text-white" :href="route('user-list')">
                        {{ __('Utilisateurs') }}
                    </x-responsive-nav-link>
                @endif
            </div>

            @guest
            <div class="mt-3 px-4 text-center h-10">
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline mr-5 text-white">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-sm text-gray-700 underline text-white">Register</a>
                @endif
            </div>
            @endguest

        </div>
    </div>
</nav>
