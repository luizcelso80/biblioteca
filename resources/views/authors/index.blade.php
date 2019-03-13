@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Autores
                    @if(auth()->user()->role == 1000)
                    <div class="float-right">
                        <a href="{{ route('authors.create') }}" type="button" class="btn btn-success">Novo</a>
                    </div>
                    
                    @endif
                </div>

                <div class="card-body">
                	<ul class="list-group">
                        @foreach($authors as $author)
                        <li class="list-group-item">
                            <div class="float-left">
                                <p>{{ $author->name }} <strong>{{ $author->surname }}</strong></p>
                            </div>
                            
                            @if(auth()->user()->role == 1000)
                            
                                <div class="float-right p-1">
                                    <a href="{{ route('authors.edit', $author->id) }}" type="button" class="btn btn-primary">Editar</a>
                                </div>
                                
                                <div class="float-right p-1">
                                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger">
                                            <span class="oi oi-trash"></span>
                                        </button>
                                    </form>
                                </div>
                                
                                @endif
                                
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-sm-center p-1">
                        {!! $authors->links() !!}
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