<?php

namespace App\Http\Controllers;

use App\Empleado;
use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EmpleadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function show(Empleado $empleado)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function edit(Empleado $empleado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Empleado $empleado)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Empleado  $empleado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Empleado $empleado)
    {
        //
    }
    public function login(Request $request){
        $empleado=DB::table('empleados')
            ->where('nombre','=',$request->nombre)
            ->where('password','=',$request->password)
            ->get();
        return $empleado;
    }
    public function atender(Request $request){
        $ticket=DB::table('tickets')
            ->where('unit_id','=',$request->unit_id)
            ->where('estado','=','CREADO')
            ->first();
//        return $ticket->numero;
        $ticket=Ticket::find($ticket->id);
        $ticket->estado='ATENDIDO';
        $ticket->empleado=$request->nombrecaja;
        $ticket->save();
//        return "a";
    }
    public function ultificha(Request $request){
        $ticket=DB::table('tickets')
            ->where('unit_id','=',$request->unit_id)
            ->where('estado','=','ATENDIDO')
            ->orderByDesc('id')
            ->first();
        return Ticket::find($ticket->id);
    }
    public function datosatender(Request $request){
        return DB::table('tickets')
            ->where('empleado','=',$request->nombrecaja)
            ->whereDate('updated_at','=',date('Y-m-d'))
            ->get();
    }
}
