@props(['recipe'])

<div class="rounded-lg bg-white p-5 shadow-sm ring-1 ring-gray-100">
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <h2 class="text-base font-semibold truncate">{{ $recipe->name }}</h2>
            @if($recipe->description)
                <p class="mt-1 text-sm text-gray-500">{{ $recipe->description }}</p>
            @endif
            <p class="mt-2 text-sm text-gray-700"><span class="font-medium">Ingredients :</span> {{ $recipe->ingredients }}</p>
            <p class="mt-1 text-xs text-gray-400">{{ $recipe->duration }} min</p>
        </div>

        <div class="flex shrink-0 gap-2">
            <a href="{{ route('recipes.edit', $recipe) }}" class="rounded-md bg-amber-500 px-2.5 py-1 text-xs font-medium text-white hover:bg-amber-600 transition">Modifier</a>
            <form action="{{ route('recipes.destroy', $recipe) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Supprimer ?')" class="rounded-md bg-red-500 px-2.5 py-1 text-xs font-medium text-white hover:bg-red-600 transition">Supprimer</button>
            </form>
        </div>
    </div>
</div>
