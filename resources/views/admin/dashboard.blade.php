@extends('admin.layouts.layout')

@section('content')

    <h1>Dashboard</h1>
    <p>Usuario autenticado: {{ auth()->user()->name }} /// {{ auth()->user()->email }}</p></p>

@endsection