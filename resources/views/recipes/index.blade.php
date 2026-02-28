<x-layout title="Mes Recettes">
    <div class="space-y-4">
        @forelse($recipes as $recipe)
            <x-recipe-card :recipe="$recipe" />
        @empty
            <p class="text-sm italic text-gray-400">Aucune recette pour le moment.</p>
        @endforelse
    </div>
</x-layout>
