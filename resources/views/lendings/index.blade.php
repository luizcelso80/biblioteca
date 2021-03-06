@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="messages">
                @include('includes.alerts')
            </div>
            <div class="card">
                <div class="card-header">
                    Empréstimos
                </div>

                <div class="card-body">
                	<ul class="list-group">
                        <li class="list-group-item">
                            <div class="float-left">Usuário</div>
                            <div class="float-right mr-5">&nbsp</div>
                            <div class="float-right mr-5">&nbsp</div>
                            <div class="float-right mr-5">&nbsp</div>
                            <div class="float-right mr-5">Entrega</div>
                            <div class="float-right mr-2">Retirada</div>
                        </li>
                        @foreach($lendings as $lending)
                        <li class="list-group-item">
                            <span class="oi oi-person p-1"></span>
                            {{ $lending->user->name }}
                            <div class="float-right">
                                @if($lending->date_finish)
                                {{ \Carbon\Carbon::parse($lending->date_finish)->format('d/m/Y') }}
                                @endif
                                {{ \Carbon\Carbon::parse($lending->date_start)->format('d/m/Y') }}
                                <a href="{{ route('lendings.show', $lending->id) }}" class="btn btn-primary">
                                  Livros <span class="badge badge-light">{{ $lending->books_count }}</span>
                                </a>
                                
                                @if(auth()->user()->role == 1000)
                                <a href="#" type="button" class="btn btn-danger">Cancelar</a>
                                @endif
                            </div>     
                        </li>
                        @endforeach
                    </ul>
                    <div class="d-flex justify-content-sm-center p-1">
                        {!! $lendings->links() !!}
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