@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>{{ $title }}</strong>
                </div>
                <div class="card-body">
                    @if( isset($author) )
                    <form action="{{ route('authors.update', $author->id) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="title">Nome</label>
                        <input type="text" value="{{ $author->name }}" class="form-control" name="name" aria-describedby="Nome" placeholder="Nome Autor">
                    </div>
                    <div class="form-group">
                        <label for="surname">Sobrenome</label>
                        <input type="text" class="form-control" name="surname" aria-describedby="Sobrenome" placeholder="Sobrenome Autor" value="{{ $author->surname }}">
                    </div>
                    @else
                    <form action="{{ route('authors.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="name">Nome</label>
                            <input type="text" class="form-control" name="name" aria-describedby="Nome" placeholder="Nome Autor">
                        </div>
                        <div class="form-group">
                            <label for="surname">Sobrenome</label>
                            <input type="text" class="form-control" name="surname" aria-describedby="Sobrenome" placeholder="Sobrenome Autor">
                        </div>
                    @endif
                        @csrf
                        <a href="{{ route('authors.index') }}" type="button" class="btn btn-success">Voltar</a>
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection