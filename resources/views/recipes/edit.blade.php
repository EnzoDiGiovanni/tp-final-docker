<x-layout title="Modifier Recette">
    <a href="{{ route('recipes.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Retour</a>

    <h1 class="mt-4 text-xl font-bold">Modifier : {{ $recipe->name }}</h1>

    <form action="{{ route('recipes.update', $recipe) }}" method="POST" class="mt-6 space-y-4">
        @csrf
        @method('PUT')
        <x-form-field name="name" label="Nom du plat" :value="$recipe->name" :required="true" />
        <x-form-field name="description" label="Description" type="textarea" :value="$recipe->description" />
        <x-form-field name="ingredients" label="Ingredients" type="textarea" :value="$recipe->ingredients" :required="true" />
        <x-form-field name="duration" label="Duree (minutes)" type="number" :value="$recipe->duration" :required="true" />

        <button type="submit" class="rounded-md bg-amber-500 px-4 py-2 text-sm font-medium text-white hover:bg-amber-600 transition">
            Mettre a jour
        </button>
    </form>
</x-layout>
