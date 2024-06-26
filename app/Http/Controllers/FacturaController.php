<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Clientes;
use App\Models\FormasPago;
use App\Models\EstadosFacturas;
use App\Models\Facturas; 

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$perfiles = DB::table('perfiles')->get();


        //$facturas = Factura::with('cliente')->get();
        $facturas = Facturas::Buscador($request->numero)->orderBy('numero', 'asc')->simplepaginate(2);
        $clientes = Clientes::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = FormasPago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = EstadosFacturas::orderBy('nombre', 'asc')->pluck('nombre', 'id');
      
        return view ('facturas.index',compact('facturas','clientes','formas','estados'));
    }

    public function create()    
    {
        //$clientes = Cliente::all();
        //$formas = Formaspago::all();
        //$estados = Estadofactura::all();

        //Con la funcion pluck solo traemos el nombre y el id y ordenamos por nombre en forma
        $clientes = Clientes::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $formas = FormasPago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        $estados = EstadosFacturas::orderBy('nombre', 'asc')->pluck('nombre', 'id');
        

        return view ('facturas.crear',compact('clientes','formas','estados'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'numero' => 'required|numeric',
            'valor' => 'required|numeric',
            'detalles' => 'required',
            'idcliente' => 'required',
            'idestado' => 'required',
            'idforma' => 'required',
            'archivo' => 'mimes:jpeg,png'
        ]);
        $now = new \Datetime();
        $fecha = $now->format('Ymd-His');
        $numero = $request->get('numero');
        $archivo = $request->file('archivo');
        $nombre = "";

        if($archivo){
            $extension = $archivo->getClientOriginalExtension();
            $nombre = "factura-".$numero."-".$fecha.".".$extension;
            \Storage::disk('local')->put($nombre, \File::get($archivo));
        }

        //insertar la informacion a la tabla
        $factura = Facturas::create([
            'numero'=>$request->get('numero'),
            'detalles'=>$request->get('detalles'),
            'valor'=>$request->get('valor'),
            'archivo'=>$nombre,
            'idcliente'=>$request->get('idcliente'),
            'idestado'=>$request->get('idestado'),
            'idforma'=>$request->get('idforma'),
        ]);

        return redirect()->route('facturas.index')->with('mensaje', 'Factura creada exitosamente');

    }
    
    public function update(Request $request, $id)
{
    // Validate the incoming request data
    $this->validate($request, [
        'numero' => 'required|numeric',
        'valor' => 'required|numeric',
        'detalles' => 'required',
        'idcliente' => 'required',
        'idestado' => 'required',
        'idforma' => 'required',
        'archivo' => 'mimes:jpeg,png'
    ]);

    // Find the invoice by ID
    $factura = Facturas::findOrFail($id);

    // Update the invoice details
    $factura->numero = $request->get('numero');
    $factura->valor = $request->get('valor');
    $factura->detalles = $request->get('detalles');
    $factura->idcliente = $request->get('idcliente');
    $factura->idestado = $request->get('idestado');
    $factura->idforma = $request->get('idforma');

    // Handle the uploaded file if any
    if ($request->hasFile('archivo')) {
        $now = new \Datetime();
        $fecha = $now->format('Ymd-His');
        $numero = $request->get('numero');
        $archivo = $request->file('archivo');
        $extension = $archivo->getClientOriginalExtension();
        $nombre = "factura-" . $numero . "-" . $fecha . "." . $extension;
        \Storage::disk('local')->put($nombre, \File::get($archivo));
        $factura->archivo = $nombre;
    }

    // Save the updated invoice
    $factura->save();

    // Redirect back to the index page with a success message
    return redirect()->route('facturas.index')->with('mensaje', 'Factura actualizada exitosamente');
}

    public function edit($id)
{
    // Find the invoice by ID
    $factura = Facturas::findOrFail($id);
    
    // Retrieve lists of clients, payment methods, and invoice states
    $clientes = Clientes::orderBy('nombre', 'asc')->pluck('nombre', 'id');
    $formas = FormasPago::orderBy('nombre', 'asc')->pluck('nombre', 'id');
    $estados = EstadosFacturas::orderBy('nombre', 'asc')->pluck('nombre', 'id');
    
    // Pass the invoice and related data to the view for editing
    return view('facturas.index', compact('factura', 'clientes', 'formas', 'estados'));
}

public function destroy(string $id)
    {
        $factura = Facturas::find($id);
        $factura->delete();

        return redirect()->route('facturas.index');
}

}

