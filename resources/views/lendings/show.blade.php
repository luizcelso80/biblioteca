@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ $title }}
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-sm">Locatário</div>
                        <div class="col-sm">{{ $lending->user->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-sm">Retirada</div>
                        <div class="col-sm">{{ \Carbon\Carbon::parse($lending->date_start)->format('d/m/Y') }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm">
                            <div class="d-flex justify-content-sm-center p-1">
                                <h3>Livros emprestados</h3>
                            </div>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Descrição</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($lending->books as $book)
                                    <tr>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->description }}</td>
                                        <td>
                                            
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="{{ url('refund', $lending->id) }}" type="button" class="btn btn-success">fecha</a>
                        </div>
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