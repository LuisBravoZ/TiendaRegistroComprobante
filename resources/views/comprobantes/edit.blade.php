<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Comprobante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('comprobantes.update', $comprobante->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Número de Comprobante -->
                        <div class="mb-4">
                            <label for="numero_comprobante" class="block text-sm font-medium text-gray-700">Número de Comprobante</label>
                            <input type="text" id="numero_comprobante" name="numero_comprobante" value="{{ $comprobante->numero_comprobante }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Banco -->
                        <div class="mb-4">
                            <label for="banco" class="block text-sm font-medium text-gray-700">Banco</label>
                            <select id="banco" name="banco"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Selecciona un banco</option>
                                <option value="Banco Pichincha" {{ $comprobante->banco == 'Banco Pichincha' ? 'selected' : '' }}>Banco Pichincha</option>
                                <option value="Banco Pacifico" {{ $comprobante->banco == 'Banco Pacifico' ? 'selected' : '' }}>Banco Pacifico</option>
                            </select>
                        </div>

                        <!-- Monto -->
                        <div class="mb-4">
                            <label for="monto" class="block text-sm font-medium text-gray-700">Monto</label>
                            <input type="number" id="monto" name="monto" value="{{ $comprobante->monto }}" step="0.01"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Tipo de Transacción -->
                        <div class="mb-4">
                            <label for="tipo_transaccion" class="block text-sm font-medium text-gray-700">Tipo de Transacción</label>
                            <select id="tipo_transaccion" name="tipo_transaccion"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <option value="">Selecciona un tipo</option>
                                <option value="Retiro" {{ $comprobante->tipo_transaccion == 'Retiro' ? 'selected' : '' }}>Retiro</option>
                                <option value="Deposito" {{ $comprobante->tipo_transaccion == 'Deposito' ? 'selected' : '' }}>Deposito</option>
                            </select>
                        </div>

                        <!-- Fecha de Transferencia -->
                        <div class="mb-4">
                            <label for="fecha_transferencia" class="block text-sm font-medium text-gray-700">Fecha de Transferencia</label>
                            <input type="date" id="fecha_transferencia" name="fecha_transferencia" value="{{ $comprobante->fecha_transferencia }}"
                                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </div>

                        <!-- Botón de envío -->
                        <div class="ms-3 mt-6 flex justify-center">
                            <x-primary-button type="submit" class="bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                                Actualizar Comprobante
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>