@extends('admin.export.layout')
@section('container')


    <table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
        <thead class="thead-dark">
        <tr class="text-center">
            <td></td>
            <th style="background-color: #00b0e8"><span>N°</span></th>
            {{--<th>ITEM</th>
            <th>TOTAL</th>
            <td></td>--}}
            <th style="background-color: #00b0e8">MOTIVO</th>
            <th style="background-color: #00b0e8">TOTAL</th>
            {{--<td></td>
            <th>FECHA</th>
            <td class="table-primary">{{ date('d-m-Y') }}</td>--}}
        </tr>
        </thead>
        <tbody>
            <tr class="text-center table-primary text-sm">
                <td class="text-center"></td>
                <td class="text-center">1</td>
                {{--<td class="text-center">Combo 1</td>
                <td class="text-center">0</td>
                <td class="text-left"></td>--}}
                <td class="text-center">COSTO ELEVADO</td>
                <td class="text-center">{{ $costo }}</td>
                {{--<td class="text-left"></td>
                <th class="text-center">MUNICIPIO</th>
                <td class="text-center">ROSCIO</td>--}}
            </tr>
            <tr class="text-center table-primary text-sm">
                <td class="text-center"></td>
                <td class="text-center">2</td>
               {{-- <td class="text-center">Combo 2</td>
                <td class="text-center">0</td>
                <td class="text-left"></td>--}}
                <td class="text-center">FALTA DE RECURSOS</td>
                <td class="text-center">{{ $recurso }}</td>
                {{--<td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>--}}
            </tr>
            <tr class="text-center table-primary text-sm">
                <td class="text-center"></td>
                <td class="text-center">3</td>
                {{--<td class="text-center">COMBO DE LIMPIEZA</td>
                <td class="text-center">0</td>
                <td class="text-left"></td>--}}
                <td class="text-center">OTROS RUBROS</td>
                <td class="text-center">{{ $rubro }}</td>
                {{--<td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>--}}
            </tr>
            <tr class="text-center table-primary text-sm">
                <td class="text-center"></td>
                <td class="text-center">4</td>
                {{--<td class="text-center">COMBO DE HIGIENE</td>
                <td class="text-center">0</td>
                <td class="text-left"></td>--}}
                <td class="text-center">INFORMACIÓN</td>
                <td class="text-center">{{ $informacion }}</td>
                {{--<td class="text-left"></td>
                <td class="text-left"></td>
                <td class="text-left"></td>--}}
            </tr>
        </tbody>
    </table>


<table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
    <thead class="thead-dark">
    <tr class="text-center">
        <th style="background-color: #00b0e8">FECHA</th>
        <th style="background-color: #00b0e8">N°</th>
        <th style="background-color: #00b0e8">NOMBRE Y APELLIDO</th>
        <th style="background-color: #00b0e8">CEDULA</th>
        <th style="background-color: #00b0e8">TELEFONO</th>
        <th style="background-color: #00b0e8">Modulo 01</th>
        <th style="background-color: #00b0e8">Modulo 02</th>
        <th style="background-color: #00b0e8">Arma tu Combo</th>
        <th style="background-color: #00b0e8">Cant. Rubros</th>
        <th style="background-color: #00b0e8">N° TRANSFERENCIAS</th>
        <th style="background-color: #00b0e8">FACTURA</th>
        <th style="background-color: #00b0e8">Monto</th>
        <th style="background-color: #00b0e8">DIRECCION</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
    @foreach($compras as $compra)
        @php($i++)
        <tr class="text-center table-primary text-sm">
            <td class="text-center">{{ date("d-m-Y", strtotime($compra->fecha)) }}</td>
            <td class="text-center" style="background-color: #00b0e8">{{ $i }}</td>
            <td class="text-left">{{ $compra->datos->nombre_completo }}</td>
            <td class="text-center">{{ $compra->datos->cedula }}</td>
            <td class="text-center">{{ $compra->datos->telefono }}</td>
            <td class="text-center">{{ $compra->modulo_1 }}</td>
            <td class="text-center">{{ $compra->modulo_2 }}</td>
            <td class="text-center">{{ $compra->modulo_3 }}</td>
            <td class="text-center">{{ $compra->modulo_4 }}</td>
            <td class="text-center">{{ $compra->referencia }}</td>
            <td class="text-center">{{ $compra->factura }}</td>
            <td class="text-center">{{ $compra->capture }}</td>
            <td class="text-center">{{ $compra->datos->direccion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
