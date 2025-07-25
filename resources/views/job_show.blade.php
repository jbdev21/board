<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $position->title }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            h1{
                font-weight:bold;
            }
        </style>
    </head>
    <body>
        <div class="mx-auto w-1/2 py-5">
            <main>
                    <div class="mb-5">
                        <a href="{{ route("home") }}" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm">Back to List</a>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow mb-4 w-full">
                        <div class="flex justify-between items-start">
                            <div>
                                <h2 class="text-xl font-semibold text-gray-800">{{ $position->title }}</h2>
                                <p class="text-gray-600">{{ $position->company }} · {{ $position->is_remote ? "Remote" : $position->office }} </p>
                                <p class="text-sm text-gray-500 mt-1">{{ $position->employment_type->label() }} · {{ $position->seniority->label() }}</p>
                                @if($position->salary_min)
                                    <p class="text-sm text-green-600 font-medium mt-2">{{ Number::currency($position->salary_min, $position->salary_currency_code->value) }} @if($position->salary_max) - {{  Number::currency($position->salary_max, $position->salary_currency_code->value) }} @endif / {{ $position->salary_type->label() }}</p>
                                @endif
                                <div class="py-5">
                                    {!!  $position->description !!}
                                </div>
                                <a href="#" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-lg text-sm">Quick Apply</a>
                            </div>
                        </div>
                    </div>
            </main>
        </div>
    </body>
</html>
