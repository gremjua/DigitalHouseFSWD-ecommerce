<?php
// SDK de Mercado Pago
require '../vendor/autoload.php';
// Agrega credenciales
MercadoPago\SDK::setAccessToken('APP_USR-4863611560259104-043018-aaeadac5b8d18cc8e80f66851c59ae4c-185110306');

// Crea un objeto de preferencia
$preference = new MercadoPago\Preference();

// Crea un ítem en la preferencia
$item = new MercadoPago\Item();
$item->title = 'Mi producto';
$item->quantity = 1;
$item->unit_price = 75.56;
$preference->items = array($item);
$preference->save();
?>

@extends('layouts.app')

@section('title')
   Check Out
@endsection

@section('content')
<a href="{{$preference->sandbox_init_point}}"> Pagar </a>

@endsection


