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
                    @if( isset($book) )
                    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="title">Título</label>
                        <input type="text" value="{{ $book->title }}" class="form-control" name="title" aria-describedby="título" placeholder="Título do livro">
                    </div>
                    <div class="form-group">
                        <label for="description">Descrição</label>
                        <textarea class="form-control" name="description" rows="3">{{ $book->description }}</textarea>
                    </div>
                    <div class="form-group">
                        <select name="authors[]" class="custom-select" multiple size="5">
                            @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ in_array($author->id, $authorsAttached) ? 'selected': '' }}>
                                {{ $author->name }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    @else
                    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="title">Título</label>
                            <input type="text" class="form-control" name="title" aria-describedby="título" placeholder="Título do livro">
                        </div>
                        <div class="form-group">
                            <label for="description">Descrição</label>
                            <textarea class="form-control" name="description" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <select name="authors[]" class="custom-select" multiple size="5">
                                @foreach($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="image">Imagem</label>
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    @endif
                        @csrf
                        <a href="{{ route('books.index') }}" type="button" class="btn btn-success">Voltar</a>
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