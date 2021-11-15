@extends('layout.default')

@section('content')

<div class="page-header">
    <h2>Usuário #{{ $user->id }}</h2>
</div>

<div class="row form-group">
    <div class="col-md-12">
        <a href="{{ route('users.index') }}" class="btn btn-primary pull-right"">Voltar</a>
    </div>
</div>

@if (session('success'))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <strong>Legal!</strong> {{ session('success') }}
    </div>
@endif

<div class="row form-group">
    <div class="col-md-12">
        <table class="table">
            <tbody>
                <tr>
                    <th style="width: 20%;">Nome</th>
                    <td>{{ $user->nome }} {{ $user->sobrenome }}</td>
                </tr>
                <tr>
                    <th>Endereço</th>
                    <td>{{ $user->logradouro }}</td>
                </tr>
                <tr>
                    <th>CEP</th>
                    <td>{{ $user->cep }}</td>
                </tr>
                <tr>
                    <th>Complemento</th>
                    <td>{{ $user->complemento }}</td>
                </tr>
                <tr>
                    <th>Bairro</th>
                    <td>{{ $user->bairro }}</td>
                </tr>
                <tr>
                    <th>Cidade</th>
                    <td>{{ $user->cidade }}</td>
                </tr>
                <tr>
                    <th>UF</th>
                    <td>{{ $user->uf }}</td>
                </tr>
            </tbody>
            <tbody>
        </table>
    </div>
</div>

@endsection