@extends('admin.export.layout')
@section('container')

<table class="table table-hover table-valign-middle table-sm table-bordered table-responsive-sm">
    <thead class="thead-dark">
    <tr class="text-center">
        <th style="background-color: #ff8000">FECHA</th>
        <th style="background-color: #ff8000">N°</th>
        <th style="background-color: #ff8000">NOMBRE Y APELLIDO</th>
        <th style="background-color: #ff8000">CEDULA</th>
        <th style="background-color: #ff8000">TELEFONO</th>
        <th style="background-color: #ff8000">N° Pedido</th>
        <th style="background-color: #ff8000">Monto Total</th>
        <th style="background-color: #ff8000">N° TRANSFERENCIAS</th>
        <th style="background-color: #ff8000">FACTURA</th>
        <th style="background-color: #ff8000">CANT.</th>
        <th style="background-color: #ff8000">DIRECCION</th>
    </tr>
    </thead>
    <tbody>
    @php($i = 0)
    @foreach($compras as $compra)
        @php($i++)
        <tr class="text-center table-primary text-sm">
            <td class="text-center">{{ date("d-m-Y", strtotime($compra->fecha)) }}</td>
            <td class="text-center" style="background-color: #ff8000">{{ $i }}</td>
            <td class="text-left">{{ $compra->datos->nombre_completo }}</td>
            <td class="text-center">{{ $compra->datos->cedula }}</td>
            <td class="text-center">{{ $compra->datos->telefono }}</td>
            <td class="text-center">{{ $compra->pedido }}</td>
            <td class="text-center">{{ $compra->monto }}</td>
            <td class="text-center">{{ $compra->referencia }}</td>
            <td class="text-center">{{ $compra->factura }}</td>
            <td class="text-center">{{ $compra->capture }}</td>
            <td class="text-center">{{ $compra->datos->direccion }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

@endsection
