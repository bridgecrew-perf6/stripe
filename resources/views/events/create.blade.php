<x-app-layout>
    <div class="container mx-auto">
        <form action="{{ route('event.store') }}" method="post">
            @csrf

            <x-label for="title" value="Titre" />
            <x-input id="title" name="title" type="text" :value="old('title')"/>

            <x-label for="content" value="Contenu" />
            <textarea id="content" name="content" :value="old('content')"></textarea>

            <x-label for="premium" value="Premium ?" />
            <x-input id="premium" name="premium" type="checkbox" :value="old('premium')"/>

            <x-label for="starts_at" value="Date de démarrage" />
            <x-input id="starts_at" name="starts_at" type="date" :value="old('starts_at')"/>

            <x-label for="ends_at" value="Date de fin" />
            <x-input id="ends_at" name="ends_at" type="date" :value="old('ends_at')"/>

            <x-label for="tags" value="Les tags (séparés par une virgule)" />
            <x-input id="tags" name="tags" type="text" :value="old('tags')"/>

            <div class="block mt-3">
                <x-button type="submit" class="block">Créer mon évènement</x-button>
            </div>

        </form>
    </div>  
</x-app-layout>