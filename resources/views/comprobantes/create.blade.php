<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear Comprobante') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form action="{{ route('comprobantes.store') }}" method="POST">
                        @csrf
                        <!-- Número de Comprobante -->
                        <div class="mb-4">
                            <label for="numero_comprobante" class="block text-gray-700 font-bold mb-2">Número de Comprobante:</label>
                            <input 
                                type="text" 
                                name="numero_comprobante" 
                                id="numero_comprobante"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                                value="{{ old('numero_comprobante') }}" 
                                required>
                            @error('numero_comprobante')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Banco -->
                        <div class="mb-4">
                            <label for="banco" class="block text-gray-700 font-bold mb-2">Banco:</label>
                            <select 
                                name="banco" 
                                id="banco"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                                required>
                                <option value="">Selecciona un banco</option>
                                <option value="Banco Pichincha" {{ old('banco') == 'Banco Pichincha' ? 'selected' : '' }}>Banco Pichincha</option>
                                <option value="Banco Pacifico" {{ old('banco') == 'Banco Pacifico' ? 'selected' : '' }}>Banco Pacifico</option>
                            </select>
                            @error('banco')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Monto -->
                        <div class="mb-4">
                            <label for="monto" class="block text-gray-700 font-bold mb-2">Monto:</label>
                            <input 
                                type="number" 
                                name="monto" 
                                id="monto" 
                                step="0.01"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                                value="{{ old('monto') }}" 
                                required>
                            @error('monto')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo de Transacción -->
                        <div class="mb-4">
                            <label for="tipo_transaccion" class="block text-gray-700 font-bold mb-2">Tipo de Transacción:</label>
                            <select 
                                name="tipo_transaccion" 
                                id="tipo_transaccion"
                                class="w-full border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:outline-none"
                                required>
                                <option value="">Selecciona un tipo</option>
                                <option value="Retiro" {{ old('tipo_transaccion') == 'Retiro' ? 'selected' : '' }}>Retiro</option>
                                <option value="Deposito" {{ old('tipo_transaccion') == 'Deposito' ? 'selected' : '' }}>Deposito</option>
                            </select>
                            @error('tipo_transaccion')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha de transferencia (Automática, oculta al usuario) -->
                        <input 
                            type="hidden" 
                            name="fecha_transferencia" 
                            value="{{ \Carbon\Carbon::now('America/Guayaquil')->toDateString() }}">

                        <!-- Botón de envío -->
                        <div class=" mt-6 flex justify-center">
                            <x-primary-button type="submit" class="ms-3 bg-black hover:bg-gray-800 text-white font-bold py-2 px-4 rounded">
                                Registrar Comprobante
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>