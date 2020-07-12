<?php

namespace App\Imports;

use App\Compra;
use App\Datos_personal;
use App\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ComprasImport implements ToModel, WithHeadingRow//, WithMappedCells
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $carbon = new Carbon($row['fecha']);
        $user = User::find(Auth::user()->id);

        $nombre = $row['nombre_y_apellido'];
        $cedula = $row['cedula'];
        $telefono = $row['telefono'];
        $modulo_1 = $row['modulo_1'];
        $modulo_2 = $row['modulo_2'];
        $modulo_3 = $row['combo_de_limpieza'];
        $modulo_4 = $row['combo_de_higiene'];
        $referencia = $row['n_transferencias'];
        $factura = $row['factura'];
        $direccion = $row['direccion'];
        $fecha = $carbon->toDateString();
        $municipio = $row['municipio'];

        //dd($row);
        if($nombre){

            $datos = Datos_personal::where('cedula', '=', $cedula)->first();
            if(!$datos){
                $datos = new Datos_personal();
                $datos->users_id = $user->id;
                $datos->cedula = $cedula;
                $datos->nombre_completo = strtoupper($nombre);
                $datos->telefono = $telefono;
                $datos->direccion = $direccion;
                $datos->municipio = strtoupper($municipio);
                $datos->save();
            }

            if($referencia != null){
                $status = "Esperando Factura";
                if($factura != null){
                    $status = "Facturado";
                }

            $revisar = Compra::where('factura', '=', $factura)
                             ->orWhere('referencia', '=', $referencia)->first();

            }else{
                $status = "Esperando Pago";
                $revisar = false;
            }

            if (!$revisar) {

                return new Compra( [
                    //'id'          => $row['ID']  // A // como se autoincrementa no se especifica
                    'users_id'    => $user->id, // B
                    'datos_id'    => $datos->id, // C
                    'modulo_1'    => $modulo_1, // D
                    'modulo_2'    => $modulo_2, // E
                    'modulo_3'    => $modulo_3, // F
                    'modulo_4'    => $modulo_4, // G
                    'fecha'       => $fecha, // H
                    'referencia'  => $referencia, // I
                    'capture'     => null, // J
                    'factura'     => $factura, // k
                    'estatus'     => $status, // L
                    'municipio'   => $municipio, // M
                    'responsable' => "Importado Excel" // N
                ] );
            }
        }
    }

    public function headingRow(): int
    {
        return 9;
    }
}
