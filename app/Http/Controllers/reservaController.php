<?php

namespace App\Http\Controllers;

use App\Mail\reservaEmail;
use App\Models\cubiculos;
use App\Models\guarderia;
use App\Models\mascotasPersonas;
use App\Models\personas;
use App\Models\reserva;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use mysql_xdevapi\Exception;

class reservaController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (empty($request->fechainicio)) {
            return response()->json(['error' => true, 'mensaje' => 'Ingrese una fecha de inicio para la reserva']);
        }
        if (empty($request->dias)) {
            return response()->json(['error' => true, 'mensaje' => 'Ingrese una fecha fin para la reserva']);
        }
        if (empty($request->mascota)) {
            return response()->json(['error' => true, 'mensaje' => 'Ingrese / seleccione una mascota']);
        }
        DB::beginTransaction();
        try {
            $idGuarderia = $request->session()->get('guarderiaId');
            $idMascota = $request->mascota;
            $idPersona = 1;
            $cubiculosDisponibles = $request->cubiculo;
            $fechaInicio = date("Y-m-d", strtotime($request->fechainicio));
            $dias = $fechaInicio . " + " . $request->dias . " days";
            $fechaFin = date("Y-m-d", strtotime($dias));
            $reservaValidate = reserva::query()
                ->where('idguarderia', $idGuarderia)
                ->where('idcubiculo', $cubiculosDisponibles)
                ->where('fechainicio', '=', $fechaInicio)
                ->where('fechafin', '<=', $fechaFin)
                ->where('estado', 0)
                ->count();
            if ($reservaValidate > 0) {
                return response()->json(['error' => true, 'mensaje' => 'No existen reservas disponibles']);
            }
            $cubilolibre = cubiculos::query()->where('idcubiculo', $request->cubiculo)->first();
            //inicia proceso de insertar reservas

            $precioReserva = $request->dias * $cubilolibre->precio;
            $reserva = new reserva();
            $reserva->idguarderia = $idGuarderia;
            $reserva->idcubiculo = $cubilolibre->idcubiculo;
            $reserva->fechainicio = $fechaInicio;
            $reserva->fechafin = $fechaFin;
            $reserva->idmascota = $idMascota;
            $reserva->idpersona = $idPersona;
            $reserva->precio = $precioReserva;
            $reserva->observaciones = $request->message;
            $reserva->fecharegistro = date('Y-m-d h:i:s');
            $reserva->save();

            $guarderia=guarderia::query()->where('idguarderia',$idGuarderia)->first();
            $imagen=base64_encode(file_get_contents(url('img/logo.jpeg')));
            //envio de email
            $mailData = [
                'title' => 'Reserva de cubiculo Dog Travel - '.$guarderia->nombre,
                'fechaInicio' => $reserva->fechainicio,
                'fechaFinal' => $reserva->fechafin,
                'cubiculo' => $cubilolibre->nombre. " ".$cubilolibre->tamano,
                'nombreEmpresa'=>$guarderia->nombre,
                'precioPago'=>$precioReserva,
                'recomendaciones'=>$guarderia->politicas,
                'imagen'=>$imagen

            ];

            Mail::to('pitillo44@gmail.com')->send(new reservaEmail($mailData));
            //
            DB::commit();
            return response()->json(['error' => false, 'mensaje' => 'Su reserva fue registrada existosamente,sera direccionado al metodo de pagos']);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['error' => true, 'mensaje' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $guarderia = guarderia::query()->where("idguarderia", $id)->first();
        session(['guarderiaId' => $id]);

        $cubiculos = cubiculos::query()->where('idGuarderia', 1)->get();

        $datosMascota = mascotasPersonas::query()->where('id_persona', 1)->with('mascota')->get();
       // return view('reservaEmail');
       return view('reserva')->with("dataguarderia", $guarderia)->with('datosMascotas', $datosMascota)->with('cubiculos', $cubiculos);
    }


    public function consultarCubiculo(Request $request)
    {
        if (empty($request->fechainicio)) {
            return response()->json(['error' => true, 'mensaje' => 'Ingrese una fecha de inicio para la reserva']);
        }
        if (empty($request->dias)) {
            return response()->json(['error' => true, 'mensaje' => 'Ingrese una fecha fin para la reserva']);
        }
        if (empty($request->mascota)) {
            return response()->json(['error' => true, 'mensaje' => 'Ingrese / seleccione una mascota']);
        }

        if (empty($request->cubiculo)) {
            return response()->json(['error' => true, 'mensaje' => 'Ingrese / seleccione un cubiculo']);
        }

        $idGuarderia = $request->session()->get('guarderiaId');
        $idMascota = 1;
        $idPersona = 1;
        $fechaInicio = date("Y-m-d", strtotime($request->fechainicio));
        $dias = $fechaInicio . " + " . $request->dias . " days";
        $fechaFin = date("Y-m-d", strtotime($dias));
        $reservaValidate = reserva::query()
            ->where('idguarderia', $idGuarderia)
            ->where('idcubiculo', $request->cubiculo)
            ->where('fechainicio', '=', $fechaInicio)
            ->where('fechafin', '<=', $fechaFin)
            ->where('estado', 0)
            ->select('idcubiculo')
            ->get();
        if ($reservaValidate->isEmpty()) {
            return response()->json(['error' => false, 'mensaje' => 'Se encuentra disponible el cubiculo para la reserva']);
        } else {
            return response()->json(['error' => true, 'mensaje' => 'No existen reservas disponibles para el cubiculo disponible']);
        }


        //
    }

}
