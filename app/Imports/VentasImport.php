<?php

namespace App\Imports;

use App\Datos_personal;
use App\User;
use App\Venta;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class VentasImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row) {
        $carbon = new Carbon( $row['fecha'] );
        $user   = User::find( Auth::user()->id );

        $nombre     = $row['nombre_y_apellido'];
        $cedula     = $row['cedula'];
        $telefono   = $row['telefono'];
        $pedido     = $row['n_pedido'];
        $monto      = $row['monto'];
        $referencia = $row['n_transferencias'];
        $factura    = $row['factura'];
        $cantidad   = $row['cant'];
        $direccion  = $row['direccion'];
        $fecha      = $carbon->toDateString();
        $municipio  = $row['municipio'];

        //dd( $row );
        if ( $nombre ) {

            $datos = Datos_personal::where( 'cedula', '=', $cedula )->first();
            if ( !$datos ) {
                $datos                  = new Datos_personal();
                $datos->users_id        = $user->id;
                $datos->cedula          = $cedula;
                $datos->nombre_completo = strtoupper( $nombre );
                $datos->telefono        = $telefono;
                $datos->direccion       = $direccion;
                $datos->municipio       = strtoupper( $municipio );
                $datos->save();
            }

            if ( $referencia != null ) {
                $status = "Esperando Factura";
                if ( $factura != null ) {
                    $status = "Facturado";
                }

                $revisar = Venta::where( 'factura', '=', $factura )
                                 ->orWhere( 'referencia', '=', $referencia )->first();

            } else {
                $status  = "Esperando Pago";
                $revisar = false;
            }

            if ( !$revisar ) {
                return new Venta( [
                    //'id'          => $row['ID']  // A // como se autoincrementa no se especifica
                    'users_id'    => $user->id, // B
                    'datos_id'    => $datos->id, // C
                    'pedido'      => $pedido, // D
                    'monto'       => $monto, // E
                    'fecha'       => $fecha, // H
                    'referencia'  => $referencia, // I
                    'capture'     => $cantidad, // J
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
        return 7;
    }
}
