<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200">

                    <h3 class="text-lg font-bold mb-4">Lista de Comprobantes</h3>
                    
                    @if($comprobantes->isEmpty())
                        <p class="text-gray-400">No hay comprobantes registrados.</p>
                    @else
                        <ul class="list-disc pl-5">
                            @foreach($comprobantes as $comprobante)
                                <li>{{ $comprobante->nombre }}</li>
                            @endforeach
                        </ul>
                    @endif

                    <div class="mt-4">
                        <a href="{{ route('comprobantes.create') }}" 
                           class="bg-blue-600 hover:bg-blue-700 text-black font-bold py-2 px-4 rounded shadow-lg">
                            Crear Comprobante
                        </a>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
