<x-app-layout :user="$user">
  <div class="py-10">
    <div class="mt-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 font-semibold text-xl text-gray-800 leading-tight">
                @if(request()->routeIs('user-events'))
                  <div class="flex justify-between items-center">
                    <div class="p-1">Les évènements de l'utilisateur</div>
                  <div class=" border bg-yellow-500 py-1 px-5 rounded-lg">
                    <div class="text-base font-bold">{{ $user->name }}</div>
                  </div>
                  </div>
                @endif

                @if(request()->routeIs('event.index'))
                <div class="p-1">Les évènements</div>
                @endif

                @if(request()->routeIs('user-encours'))
                <div class="flex justify-between items-center">
                    <div class="p-1">Les évènements en cours de l'utilisateur</div>
                  <div class=" border bg-yellow-500 py-1 px-5 rounded-lg">
                    <div class="text-base font-bold">{{ $user->name }}</div>
                  </div>
                  </div>
                @endif

                @if(request()->routeIs('encours'))
                <div class="p-1">Les évènements en cours</div>
                @endif

                @if(request()->routeIs('termine'))
                <div class="flex justify-between items-center">
                  <div>Les évènements terminés</div>
                  <div class="flex items-center">
                    <div>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 items-center text-red-500 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                        </svg>
                    </div>
                    <div class="text-sm">Supprimer</div>
                  </div>
                </div>
                @endif

                @if(request()->routeIs('user-termine'))
                <div class="flex justify-between items-center">
                    <div>Les évènements terminés de l'utilisateur</div>
                    <div class="flex">
                        <div class="flex border bg-yellow-500 py-1 px-5 rounded-lg">
                            <div class="text-base font-bold">{{ $user->name }}</div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 items-center text-red-500 ml-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                    </div>
                </div>
                @endif

                @if(request()->routeIs('accueil')) Publier vos évènements : Prix 10€ - Premium 15€
                @endif
            </div>
        </div>
    </div>
</div>

<section class="text-gray-600 body-font">
  
  <div class="container px-5 py-10 mx-auto">
    <div class="flex flex-wrap -mx-4 -my-8 justify-center">
    @foreach ($events as $event)
    @auth
    @if((request()->routeIs('user-termine') or request()->routeIs('termine'))and (Auth::user()->id == $event->user->id))
    
    <form method="POST" action="{{ route('supprimer',[$event]) }}" onclick="event.preventDefault(); this.closest('form').submit();" class="py-8 px-4 lg:w-1/3 sm:w-1/2 w-full {{ $event->premium ? 'border bg-yellow-100' : 'border bg-gray-100' }} hover:border-red-500 cursor-pointer">
      @csrf
    
    @else
                                 
     <div class="py-8 px-4 lg:w-1/3 sm:w-1/2 w-full {{ $event->premium ? 'border bg-yellow-100' : 'border bg-gray-100' }} hover:border-lime-500">
     
      @endif
      @endauth

      @guest
      <div class="py-8 px-4 lg:w-1/3 sm:w-1/2 w-full {{ $event->premium ? 'border bg-yellow-100' : 'border bg-gray-100' }} hover:border-lime-500">
      @endguest
    <div class="h-full flex items-start">
        <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
        <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">{{ $event->starts_at->translatedFormat('M') }}</span>
        <span class="font-medium text-lg text-gray-800 title-font leading-none">{{ $event->starts_at->translatedFormat('d') }}</span>
        </div>
        <div class="w-12 flex-shrink-0 flex flex-col text-center leading-none">
        <span class="text-gray-500 pb-2 mb-2 border-b-2 border-gray-200">{{ $event->ends_at->translatedFormat('M') }}</span>
        <span class="font-medium text-lg text-gray-800 title-font leading-none">{{ $event->ends_at->translatedFormat('d') }}</span>
        </div>
        <div class="flex-grow pl-6">
          @foreach ($event->tags as $tag)
          <h2 class="tracking-widest text-xs title-font font-medium text-indigo-500 inline-block mb-1">
            {{ $tag->name }}{{ !$loop->last ? ', ' : '' }}
          </h2>
          @endforeach
        <h1 class="title-font text-xl font-medium text-gray-900 mb-3">{{ $event->title }}</h1>
        <p class="leading-relaxed mb-5">{{ $event->content }}</p>
        <a class="inline-flex items-center" href="#">
            <img alt="blog" src="https://dummyimage.com/103x103" class="w-8 h-8 rounded-full flex-shrink-0 object-cover object-center">
            <span class="flex-grow flex flex-col pl-3">
            <span class="title-font font-medium text-gray-900">{{ $event->user->name }}</span>
            </span>
        </a>
        </div>
    </div>
    @auth
    @if((request()->routeIs('user-termine')  or request()->routeIs('termine'))and (Auth::user()->id == $event->user->id))

 </form>

 @else
   </div>
   @endif
   @endauth
   @guest
</div>
   @endguest
    @endforeach
    </div>
  </div>
</section>
</x-app-layout>
