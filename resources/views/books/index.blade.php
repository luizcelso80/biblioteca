@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Livros
                    @if(auth()->user()->role == 1000)
                    <div class="float-right">
                        <a href="{{ route('books.create') }}" type="button" class="btn btn-success">Novo</a>
                    </div>
                    
                    @endif
                </div>

                <div class="card-body">
                	<ul class="list-group">
                        @foreach($books as $book)
                        <li class="list-group-item">
                            <div class="float-left">
                                <div class="center">
                                    <img src="{{ url("storage/books/{$book->image}") }}" alt="{{ $book->name }}" style="max-width: 60px;">
                                    {{ $book->title }}
                                </div>
                                
                            </div>
                            
                            
                            @if(auth()->user()->role == 1000)
                            <div class="float-right p-1">
                                <a href="{{ route('books.edit', $book->id) }}" type="button" class="btn btn-primary">Editar</a>
                            </div>
                            <div class="float-right p-1">
                                <form action="{{ route('books.destroy', $book->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">
                                        <span class="oi oi-trash"></span>
                                    </button>
                                </form>
                            </div>
                                
                            @endif
                            <div class="float-right p-1">
                                <a href="{{ url('books/addCart', $book->id) }}" type="button" class="btn btn-success">Add</a>
                            </div>
                            
                                
                            </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-sm-center p-1">
                        {!! $books->links() !!}
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="messages">
        @include('includes.alerts')
    </div>
</div>
@endsection