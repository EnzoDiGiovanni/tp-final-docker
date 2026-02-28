<x-layout title="Nouvelle Recette">
    <a href="{{ route('recipes.index') }}" class="text-sm text-blue-600 hover:underline">&larr; Retour</a>

    <h1 class="mt-4 text-xl font-bold">Nouvelle Recette</h1>

    <form action="{{ route('recipes.store') }}" method="POST" class="mt-6 space-y-4">
        @csrf
        <x-form-field name="name" label="Nom du plat" :required="true" />
        <x-form-field name="description" label="Description" type="textarea" />
        <x-form-field name="ingredients" label="Ingredients" type="textarea" :required="true" />
        <x-form-field name="duration" label="Duree (minutes)" type="number" :required="true" />

        <button type="submit" class="rounded-md bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 transition">
            Enregistrer
        </button>
    </form>
</x-layout>
