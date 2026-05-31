@extends('layouts.app')

@section('content')
<div class="min-h-screen pt-24 flex flex-col items-center justify-center px-4">
    
    {{-- INTERFAZ WEB: Lo que el cliente ve en su pantalla --}}
    <div class="max-w-2xl w-full tarjeta-cristal p-8 border border-green-500/30 text-center space-y-6 rounded-3xl shadow-2xl shadow-green-500/5 print:hidden">
        <div class="w-20 h-20 bg-green-500/10 text-green-400 rounded-full flex items-center justify-center mx-auto shadow-lg shadow-green-500/20">
            <span class="material-symbols-outlined text-4xl">verified</span>
        </div>
        
        <div>
            <h2 class="text-3xl font-black text-white italic tracking-tighter uppercase">¡Expedición Autorizada!</h2>
            <p class="text-gray-400 mt-2">Tu pedido <span class="text-coral-electrico font-mono font-bold">#EXP-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</span> ha sido procesado con éxito.</p>
            <p class="text-xs text-gray-500 mt-1">Las compuertas de extracción se han abierto. Tu tripulación está en camino.</p>
        </div>

        <div class="border-t border-white/10 pt-6 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('productos.index') }}" class="bg-white/5 hover:bg-white/10 text-white px-6 py-3 rounded-xl font-bold transition-all text-sm">
                Volver al catalogo
            </a>
            {{-- Dispara la misma lógica global de impresión --}}
            <button 
                onclick="window.AbyssalApp.imprimirRecibo()" 
                class="bg-coral-electrico hover:bg-orange-600 text-black px-6 py-3 rounded-xl font-black transition-all text-sm flex items-center justify-center gap-2 shadow-lg shadow-coral-electrico/25 cursor-pointer">
                <span class="material-symbols-outlined text-sm">print</span>
                Imprimir Comprobante
            </button>
        </div>
    </div>

    {{-- Recibo para imprimir del cliente --}}
    <div class="hidden print:block bg-white text-black p-8 w-full font-sans text-sm">
        <style>
            @media print { @page { size: landscape; margin: 10mm; } }
        </style>

        <div class="flex justify-between items-start border-b-4 border-black pb-4 mb-6">
            <div>
                <h1 class="text-2xl font-black tracking-tighter">ABYSSAL CATCH CO.</h1>
                <p class="text-xs text-gray-600">Comprobante Oficial de Adquisición B2C</p>
            </div>
            <div class="text-right">
                <h2 class="text-xl font-bold tracking-tight">ORDEN: #EXP-{{ str_pad($pedido->id, 4, '0', STR_PAD_LEFT) }}</h2>
                <p class="text-xs text-gray-600">Fecha: {{ $pedido->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-2 gap-8 mb-8">
            <div class="border border-black p-4 rounded">
                <p class="text-[10px] uppercase font-black tracking-wider text-gray-500 mb-1">Cliente Receptor</p>
                <p class="font-bold text-base">{{ $pedido->user->name }}</p>
                <p class="text-gray-700">{{ $pedido->user->email }}</p>
            </div>
            <div class="border border-black p-4 rounded">
                <p class="text-[10px] uppercase font-black tracking-wider text-gray-500 mb-1">Estatus del Despacho</p>
                <p class="font-bold uppercase text-green-700">{{ $pedido->estado }}</p>
                <p class="text-gray-600 text-xs">Pago verificado mediante pasarela interna.</p>
            </div>
        </div>

        <table class="w-full text-left border-collapse mb-8">
            <thead>
                <tr class="border-b-2 border-black text-[11px] uppercase font-bold tracking-wider">
                    <th class="py-2">Especie</th>
                    <th class="py-2">Categoría</th>
                    <th class="py-2 text-center">Cant.</th>
                    <th class="py-2 text-right">P. Unitario</th>
                    <th class="py-2 text-right">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pedido->detalles as $detalle)
                    <tr class="border-b border-gray-300 text-xs">
                        <td class="py-3 font-bold">{{ $detalle->producto->nombre_comun }}</td>
                        <td class="py-3 text-gray-700">{{ $detalle->producto->categoria }}</td>
                        <td class="py-3 text-center font-medium">{{ $detalle->cantidad }}</td>
                        <td class="py-3 text-right">${{ number_format($detalle->precio_unitario, 2) }}</td>
                        <td class="py-3 text-right font-bold">${{ number_format($detalle->cantidad * $detalle->precio_unitario, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="flex justify-end">
            <div class="w-1/3 border-t-2 border-black pt-4 text-right">
                <div class="flex justify-between items-center font-black text-lg">
                    <span>TOTAL PAGADO:</span>
                    <span class="text-xl">${{ number_format($pedido->total, 2) }}</span>
                </div>
                <p class="text-[9px] text-gray-500 mt-2 italic">Gracias por confiar en las flotas de Abyssal Catch Co. Conserva este PDF para reclamos de logística.</p>
            </div>
        </div>
    </div>

</div>
@endsection