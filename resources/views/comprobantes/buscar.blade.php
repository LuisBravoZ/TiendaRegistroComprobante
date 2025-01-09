<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Buscar Comprobantes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('buscar') }}" method="GET">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="fecha_inicio" class="block text-sm font-medium text-gray-700">Fecha Inicio</label>
                                <input type="date" id="fecha_inicio" name="fecha_inicio"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    value="{{ request()->fecha_inicio }}">
                            </div>
                            <div>
                                <label for="fecha_fin" class="block text-sm font-medium text-gray-700">Fecha Fin</label>
                                <input type="date" id="fecha_fin" name="fecha_fin"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                    value="{{ request()->fecha_fin }}">
                            </div>
                            <div>
                                <label for="banco" class="block text-sm font-medium text-gray-700">Banco</label>
                                <select id="banco" name="banco"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Selecciona un banco</option>
                                    @foreach ($bancos as $banco)
                                        <option value="{{ $banco }}"
                                            {{ request()->banco == $banco ? 'selected' : '' }}>
                                            {{ $banco }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="tipo_transaccion" class="block text-sm font-medium text-gray-700">Tipo de Transacción</label>
                                <select id="tipo_transaccion" name="tipo_transaccion"
                                    class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option value="">Selecciona un tipo</option>
                                    @foreach ($tipos_transaccion as $tipo)
                                        <option value="{{ $tipo }}"
                                            {{ request()->tipo_transaccion == $tipo ? 'selected' : '' }}>
                                            {{ $tipo }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mt-4">

                            
                            <x-primary-button class="ms-3" type="submit"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buscar
                            </x-primary-button>
                        </div>
                    </form>

                    <!-- Formulario independiente para Exportar PDF -->
                    <form action="{{ route('comprobantes.exportarPdf') }}" method="GET" target="_blank" class="mt-4">
                        <input type="hidden" name="fecha_inicio" value="{{ request()->fecha_inicio }}">
                        <input type="hidden" name="fecha_fin" value="{{ request()->fecha_fin }}">
                        <input type="hidden" name="banco" value="{{ request()->banco }}">
                        <input type="hidden" name="tipo_transaccion" value="{{ request()->tipo_transaccion }}">
                        <button type="submit" class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded">
                            Exportar PDF
                        </button>
                    </form>

                    <!-- Resultados de la búsqueda -->
                    @if(request()->has('fecha_inicio') || request()->has('fecha_fin') || request()->has('banco') || request()->has('tipo_transaccion'))
                        @if($comprobantes->isEmpty())
                            <p class="text-red-500 mt-4">No hay comprobantes registrados.</p>
                        @else
                        <div class="overflow-x-auto mt-4">
                            <table class="min-w-full table-auto w-full border-collapse">
                                <thead class="bg-gray-200">
                                    <tr>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-900 border-b">#</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-900 border-b">Número de Comprobante</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Banco</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Monto</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Fecha</th>
                                        <th class="px-6 py-4 text-sm font-semibold text-gray-700 border-b">Tipo de Transacción</th>
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
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>