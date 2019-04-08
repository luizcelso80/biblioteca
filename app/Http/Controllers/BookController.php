<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    private $totalPage = 5;
    private $book;

    public function __construct(Book $book)
    {
        $this->middleware('auth');
        $this->middleware('clearance')->except(['index', 'addCart', 'openCart']);
        $this->book = $book;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Cadastrar Novo Livro';

        $lended_books = Book::whereHas('lendings', function ($query) {
            $query->where('date_finish', '=', null);
        })->pluck('id')->all();
        


        $books = Book::whereNotIn('id', $lended_books)->paginate($this->totalPage);
        
        

        return view('books.index', compact('books', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $title = 'Cadastrar Novo Livro';
        return view('books.form', compact('title', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $nameFile = '';

        //dd($request->all());

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
                    
            $nameFile = uniqid(date('HisYmd')).'.'.$request->image->extension();
            //dd($nameFile);

            if (!$request->image->storeAs('books', $nameFile))
                return redirect()
                            ->back()
                            ->with('error', 'Falha ao fazer upload')
                            ->withInput();

        }

        if ( $this->book->newBook($request, $nameFile) )
            return redirect()
                            ->route('books.index')
                            ->with('success', 'Sucesso ao cadastrar');
        else
            return redirect()
                            ->back()
                            ->with('error', 'Falha ao cadastrar')
                            ->withInput();

        /*
        $dataForm = $request->all();

        if (Book::create($dataForm))
            return redirect()
                        ->route('books.index')
                        ->with('success', 'Cadastro realizado com sucesso!');
        else
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao cadastrar!');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        if(!$book)
            return redirect()->back();

        $title = "Editando Livro: {$book->title}";

        $authorsAttached = $book->authors()->pluck('id')->all();
        //dd($authorsAttached);
        $authors = Author::all();
        

        return view('books.form', compact('title', 'book', 'authors', 'authorsAttached'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        if(!$book)
            return redirect()->back();
        
        $update = $book->update($request->all());

        if ($update){
            $book->authors()->sync($request->input('authors'));
            return redirect()
                        ->route('books.index')
                        ->with('success', 'Atualizado com sucesso!');
        }
        else{
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao atualizar!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->book->find($id)->delete();

        return redirect()
                    ->route('books.index')
                    ->with('success', 'Sucesso ao deletar');
    }

    public function addCart($id)
    {
        if (!session()->has('cart'))
            session(['cart' => []]);

        if(!in_array($id, session('cart')))
            session()->push('cart', $id);

        
        return redirect()->back();
    }

    public function rmCart($id)
    {
        if (session()->has('cart')){
            if(in_array($id, session('cart'))){
                //dd(session('cart'));
                $key = array_search($id, session('cart'));
                $teste = session()->pull('cart', []);
                //dd(session('cart')[$key]);
                dd($teste);
                $cart = session()->pull('cart');
                unset($cart[$key]);
                //session()->pull('cart', []);
                session(['cart' => $cart]);

                
            }

        }

        

        
        return redirect()->back();
    }

    public function openCart()
    {
        $books_cart = null;
        
        if (session()->has('cart')){
            $books_cart = Book::whereIn('id', session('cart'))
                                ->get();
        }
        //dd($books_cart);
        return view('includes.cart', compact('books_cart'));
    }
}
