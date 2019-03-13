@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">

                  Livros no carrinho
                    <div class="float-right">

                    	<a href="{{ route('books.index') }}" type="button" class="btn btn-success">Adicionar + livros</a>
                    </div>
                </div>

                <div class="card-body">
                	<ul class="list-group">
                		@if(isset($books_cart))
                	   @foreach($books_cart as $book_cart)
                	   <li class="list-group-item">
                	      {{ $book_cart->title }}       
                	   </li>
                	   @endforeach
                	   @else
                	   <div class="d-flex justify-content-sm-center p-1">
                	      <p><strong>Carrinho vazio!</strong></p>
                	   </div>
                	   @endif
                	</ul>
                	<div class="float-right p-1">
                		<a href="{{ route('lend') }}" type="button" class="btn btn-danger">Finalizar</a>
                	</div>  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection