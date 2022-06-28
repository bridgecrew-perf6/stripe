<x-app-layout :user="$user">
  <div class="py-10">
    <div class="mt-10 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 font-semibold text-xl text-gray-800 leading-tight">
                Les utilisateurs
            </div>
        </div>
    </div>
  </div>

<section class="text-gray-600 body-font">
  
  <div class="container px-5 py-10 mx-auto">

    <div class="flex flex-wrap -mx-4 -my-8 justify-center">
    @foreach ($users as $user)
      <div class="rounded-lg mb-2 mr-2 p-6 bg-white border border-gray-300 font-semibold text-base text-gray-800 text-center hover:bg-yellow-500 hover:shadow-2xl leading-tight">
        <a href="{{ route('user-events', [$user]) }}" class="hover:text-white font-bold"><img alt="blog" src="https://dummyimage.com/103x103" class="w-8 h-8 rounded-full object-cover object-center inline mb-2">
        {{ $user->name }}</a>
        <div class="text-sm">{{ $user->email }}</div>
      
      </div>
    @endforeach
    </div>
  </div>

</section>
</x-app-layout>
