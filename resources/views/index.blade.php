<?php
    use \Clemdesign\PhpMask\Mask;
?>
@extends('app')

@section('titulo', 'Página Inicial')

@section('conteudo')
<h1>Lista de diaristas</h1>
        
<table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Telefone</th>
            <th scope="col">CEP</th>
            <th scope="col">Ações</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($diaristas as $diarista)
        <tr>
            <th scope="row"></th>
            <td>{{ $diarista->nome_completo }}</td>
            <td>{{ Mask::apply($diarista->telefone, '(00) 00000-0000') }}</td>
            <td>{{ Mask::apply($diarista->cep, '00000-000') }}</td>
            <td>
                <a class="btn btn-primary" href="{{ route('diaristas.edit', $diarista) }}">Atualizar</a>
                <a class="btn btn-danger" href="{{ route('diaristas.destroy', $diarista )}}" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
            </td>
        </tr>
        @empty
        <tr>
            <th></th>
            <td>Nenhum registro encontrado</td>
            <td></td>
            <td></td>
        </tr>
        @endforelse
    </tbody>
</table>
<a href="{{ route('diaristas.create') }}" class="btn btn-success">Nova diarista</a>
@endsection