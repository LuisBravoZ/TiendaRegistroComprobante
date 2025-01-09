<?php

namespace App\Http\Controllers;

use App\Models\Comprobante;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;


class ComprobanteController extends Controller
{
    // Método para mostrar la lista de comprobantes (Dashboard)
    public function index(Request $request)
    {
        $hoy = Carbon::now('America/Guayaquil')->toDateString();

        $comprobantes = Comprobante::query()
            ->whereDate('fecha_transferencia', $hoy)
            ->when($request->banco, function ($query) use ($request) {
                $query->where('banco', $request->banco);
            })
            ->paginate(10);

        // Obtener los bancos únicos de la tabla de comprobantes
        $bancos = Comprobante::distinct()->pluck('banco');

        return view('comprobantes.index', compact('comprobantes', 'bancos'));
    }



    // Método para mostrar el formulario de creación de comprobantes
    public function create()
    {
        return view('comprobantes.create');
    }

    // Método para almacenar un nuevo comprobante
    public function store(Request $request)
    {
        $request->validate([
            'numero_comprobante' => 'required|unique:comprobantes',
            'banco' => 'required|in:Banco Pichincha,Banco Pacifico',
            'monto' => 'required|numeric',
            'fecha_transferencia' => 'required|date',
            'tipo_transaccion' => 'required|in:Retiro,Deposito',
        ]);

        $fecha_transferencia = Carbon::createFromFormat('Y-m-d', $request->fecha_transferencia, 'America/Guayaquil')->startOfDay();

        Comprobante::create([
            'numero_comprobante' => $request->numero_comprobante,
            'banco' => $request->banco,
            'monto' => $request->monto,
            'fecha_transferencia' => $fecha_transferencia,
            'tipo_transaccion' => $request->tipo_transaccion,
        ]);

        return redirect()->route('comprobantes.index')->with('success', 'Comprobante creado correctamente.');
    }
    
    public function edit($id)
    {
        $comprobante = Comprobante::findOrFail($id);
        return view('comprobantes.edit', compact('comprobante'));
    }

    public function update(Request $request, $id)
    {
        $comprobante = Comprobante::findOrFail($id);
        $comprobante->update($request->all());
        return redirect()->route('comprobantes.index')->with('success', 'Comprobante actualizado correctamente');
    }


    public function destroy($id)
{
    $comprobante = Comprobante::findOrFail($id);
    $comprobante->delete();

    return redirect()->route('comprobantes.index')->with('success', 'Comprobante eliminado con éxito.');
}


    public function exportarPdf(Request $request)
    {
        $comprobantes = Comprobante::query()
            ->when($request->fecha_inicio && $request->fecha_fin, function ($query) use ($request) {
                $query->whereBetween('fecha_transferencia', [$request->fecha_inicio, $request->fecha_fin]);
            })
            ->when($request->banco, function ($query) use ($request) {
                $query->where('banco', $request->banco);
            })
            ->get();

        $pdf = Pdf::loadView('comprobantes.pdf', compact('comprobantes'));

        return $pdf->download('comprobantes.pdf');
    }

    public function buscar(Request $request)
    {
        $query = Comprobante::query();

        if ($request->filled('fecha_inicio')) {
            $fecha_inicio = Carbon::createFromFormat('Y-m-d', $request->fecha_inicio, 'America/Guayaquil')->startOfDay();
            $query->where('fecha_transferencia', '>=', $fecha_inicio);
        }

        if ($request->filled('fecha_fin')) {
            $fecha_fin = Carbon::createFromFormat('Y-m-d', $request->fecha_fin, 'America/Guayaquil')->endOfDay();
            $query->where('fecha_transferencia', '<=', $fecha_fin);
        }

        if ($request->filled('banco')) {
            $query->where('banco', $request->banco);
        }

        if ($request->filled('tipo_transaccion')) {
            $query->where('tipo_transaccion', $request->tipo_transaccion);
        }

        $comprobantes = $query->get();
        $bancos = ['Banco Pichincha', 'Banco Pacifico'];
        $tipos_transaccion = ['Retiro', 'Deposito'];

        return view('comprobantes.buscar', compact('comprobantes', 'bancos', 'tipos_transaccion'));
    }
}
