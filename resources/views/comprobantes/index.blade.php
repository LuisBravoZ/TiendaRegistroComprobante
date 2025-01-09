<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Comprobantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto sm:px-6 lg:px-8"> <!-- Cambié max-w-7xl por max-w-full para que ocupe todo el ancho -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-center font-black">COMPROBANTES REGISTRADOS</h1>
                    <x-primary-button class="ms-3 mt-4 mb-4">
                        <a href="{{ route('comprobantes.create') }}"
                            class="bg-black hover:bg-gray-800 text-white font-bold rounded">
                            Crear Comprobante
                        </a>
                    </x-primary-button>
                    @if ($comprobantes->isEmpty())
                        <p class="text-red-500">No hay comprobantes registrados.</p>
                    @else
                        <div class="overflow-x-auto mt-4"> 
                            <table class="min-w-full table-auto w-full border-collapse">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">#</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Número Comprobante</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Banco</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Monto</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Fecha</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Tipo de Transacción</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($comprobantes as $comprobante)
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $loop->iteration }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $comprobante->numero_comprobante }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $comprobante->banco }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $comprobante->monto }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $comprobante->fecha_transferencia }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $comprobante->tipo_transaccion }}</td>
                                        <td class="px-6 py-4 text-sm font-medium">
                                            <a href="{{ route('comprobantes.edit', $comprobante) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                            <form action="{{ route('comprobantes.destroy', $comprobante) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 ml-4" onclick="return confirm('¿Estás seguro de que deseas eliminar este comprobante?');">
                                                    Eliminar
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Paginación -->
                        <div class="mt-4">
                            {{ $comprobantes->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    
</x-app-layout>
