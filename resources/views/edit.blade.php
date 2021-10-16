@extends('app')

@section('titulo', 'Editar diarista')

@section('conteudo')
        <h1>Editar diarista</h1>
        <form action="{{ route('diaristas.update', $diarista) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @include('_form')
        </form>
    </div>
@endsection