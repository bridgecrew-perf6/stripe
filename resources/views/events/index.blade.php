<x-app-layout>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 font-semibold text-xl text-gray-800 leading-tight">
                @if(request()->routeIs('event.index')) Liste des évènements
                @endif
                @if(request()->routeIs('encours')) Liste des évènements en cours
                @endif
                @if(request()->routeIs('termine')) Liste des évènements terminés
                @endif
                @if(request()->routeIs('accueil')) Publier vos évènements : Prix 10€ - Premium 15€
                @endif
            </div>
        </div>
    </div>
</div>

<section class="text-gray-600 body-font">
  <div class="container px-5 py-10 mx-auto">
    <div class="flex flex-wrap -mx-4 -my-8">
    @foreach ($events as $event)
    <div class="py-8 px-4 lg:w-1/3 sm:w-1/2 w-full {{ $event->premium ? 'border bg-yellow-100' : 'border bg-gray-100' }}">
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
        <a class="inline-flex items-center">
            <img alt="blog" src="https://dummyimage.com/103x103" class="w-8 h-8 rounded-full flex-shrink-0 object-cover object-center">
            <span class="flex-grow flex flex-col pl-3">
            <span class="title-font font-medium text-gray-900">{{ $event->user->name }}</span>
            </span>
        </a>
        </div>
    </div>
    </div>
    @endforeach
    </div>
  </div>
</section>
</x-app-layout>
