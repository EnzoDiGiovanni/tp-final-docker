<!DOCTYPE html>
<html lang="fr" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Mes Recettes' }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full text-gray-900 antialiased">
    <nav class="bg-white shadow-sm">
        <div class="mx-auto max-w-3xl px-4 py-4 flex items-center justify-between">
            <a href="{{ route('recipes.index') }}" class="text-lg font-bold tracking-tight">Mes Recettes</a>
            <a href="{{ route('recipes.create') }}" class="rounded-md bg-blue-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-blue-700 transition">+ Nouvelle</a>
        </div>
    </nav>

    <main class="mx-auto max-w-3xl px-4 py-8">
        {{ $slot }}
    </main>
</body>
</html>
