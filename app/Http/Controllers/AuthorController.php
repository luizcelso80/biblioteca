<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    private $totalPage = 5;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('clearance');
        
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Cadastrar Novo Livro';

        $authors = Author::paginate($this->totalPage);

        return view('authors.index', compact('authors', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $title = 'Cadastrar Novo Author';
        return view('authors.form', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataForm = $request->all();

        if (Author::create($dataForm))
            return redirect()
                        ->route('authors.index')
                        ->with('success', 'Cadastro realizado com sucesso!');
        else
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao cadastrar!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::find($id);
        if(!$author)
            return redirect()->back();

        $title = "Editando Autor: {$author->name}";
        
        

        return view('authors.form', compact('title', 'author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $author = Author::find($id);
        if(!$author)
            return redirect()->back();
        
        $update = $author->update($request->all());

        if ($update)
            return redirect()
                        ->route('authors.index')
                        ->with('success', 'Atualizado com sucesso!');
        else
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao atualizar!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Author::find($id)->delete();

        return redirect()
                    ->route('authors.index')
                    ->with('success', 'Sucesso ao deletar');
    }
}
