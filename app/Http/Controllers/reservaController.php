<?php

namespace App\Http\Controllers;

use App\Models\cubiculos;
use App\Models\guarderia;
use App\Models\reserva;
use Illuminate\Http\Request;

class reservaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(empty($request->fechainicio)){
            return response()->json(['error'=>true,'mensaje'=>'Ingrese una fecha de inicio para la reserva']);
        }
        if(empty($request->dias)){
            return response()->json(['error'=>true,'mensaje'=>'Ingrese una fecha fin para la reserva']);
        }
        if(empty($request->mascota)){
            return response()->json(['error'=>true,'mensaje'=>'Ingrese / seleccione una mascota']);
        }

        $idGuarderia=$request->session()->get('guarderiaId');
        $idMascota=1;
        $idPersona=1;
        $cubiculosDisponibles=cubiculos::query()->where('idguarderia',$idGuarderia)->select('idcubiculo')->get();
        $cubiculosDisponibles = $cubiculosDisponibles->toArray();
        $fechaInicio = date("Y-m-d",strtotime($request->fechainicio));
        $dias=$fechaInicio." + ".$request->dias." days" ;
        $fechaFin= date("Y-m-d",strtotime($dias));
        $reservaValidate=reserva::query()
            ->where('idguarderia',$idGuarderia)
            ->whereIn('idcubiculo',$cubiculosDisponibles)
            ->where('fechainicio','=', $fechaInicio)
            ->where('fechafin','<=', $fechaFin)
            ->where('estado',0)
            ->select('idcubiculo')
            ->get();

        $reservaValidate = $reservaValidate->toArray();
        $cubiculosDisponibles=cubiculos::query()->where('idguarderia',$idGuarderia)->whereNotIn('idcubiculo',$reservaValidate)->get();
        if($cubiculosDisponibles->isEmpty()){
            return response()->json(['error'=>true,'mensaje'=>'No existen reservas disponibles']);
        }
        $cubilolibre=$cubiculosDisponibles->first();
        //inicia proceso de insertar reservas

        $precioReserva=$request->dias*$cubilolibre->precio;
        $reserva= new reserva();
        $reserva->idguarderia=$idGuarderia;
        $reserva->idcubiculo=$cubilolibre->idcubiculo;
        $reserva->fechainicio=$fechaInicio;
        $reserva->fechafin=$fechaFin;
        $reserva->idmascota=$idMascota;
        $reserva->idpersona=$idPersona;
        $reserva->precio=$precioReserva;
        $reserva->observaciones=$request->message;
        $reserva->fecharegistro=date('Y-m-d h:i:s');
        $reserva->save();
        return response()->json(['error'=>false,'mensaje'=>'Su reserva fue registrada existosamente,sera direccionado al metodo de pagos']);
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guarderia=guarderia::query()->where("idguarderia",$id)->first();
        session(['guarderiaId' => $id]);
        return view('reserva')->with("dataguarderia",$guarderia);
    }
}
