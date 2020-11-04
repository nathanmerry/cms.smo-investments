<x-app-layout>
    <x-slot name="header">
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="h-32 flex items-center justify-center bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <h1 class="text-3xl">Welcome <span class="capitalize">{{Auth::user()->name}}</span></h1>
            </div>
        </div>
    </div>
</x-app-layout>