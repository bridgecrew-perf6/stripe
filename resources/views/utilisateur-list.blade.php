<x-app-layout>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 bg-white border-b border-gray-200 font-semibold text-xl text-gray-800 leading-tight">
                Liste des utilisateurs
            </div>
        </div>
    </div>
  </div>

<section class="text-gray-600 body-font">
  
  <div class="container px-5 py-10 mx-auto">

    <div class="flex flex-wrap -mx-4 -my-8 justify-center">
    @foreach ($users as $user)
      <div class="p-6 bg-white border border-gray-300 font-semibold text-xl text-gray-800 text-center leading-tight">

        <div>{{ $user->name }}</div>
        <div>{{ $user->email }}</div>
      
      </div>
    @endforeach
    </div>
  </div>

</section>
</x-app-layout>
