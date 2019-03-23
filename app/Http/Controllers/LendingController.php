<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Carbon\Carbon;

class LendingController extends Controller
{

    private $totalPage = 5;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('clearance')->except(['index','lending', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'Cadastrar Novo Livro';
        $user_id = auth()->user()->id;
        if(!auth()->user()->role == 1000){
            $lendings = Lending::where('user_id', '=', $user_id)->withCount('books')->paginate($this->totalPage);
        }
        else{
            $lendings = Lending::withCount('books')->paginate($this->totalPage);
        }

        

        return view('lendings.index', compact('lendings', 'title'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lending = Lending::find($id);
        if(!$lending)
            return redirect()->back();

        $title = "Exibindo Empréstimo número: {$lending->id}";

        return view('lendings.show', compact('title', 'lending'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function edit(Lending $lending)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lending $lending)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lending  $lending
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lending $lending)
    {
        //
    }

    public function lending()
    {
        if (session()->has('cart')){
            $user_id = auth()->user()->id;
            $date_start = Carbon::now();
            $date_end = Carbon::now()->addDays(7);
            $lending = new Lending();

            $lending->user_id = $user_id;
            $lending->date_start = $date_start;
            $lending->date_end = $date_end;
            $lending->save();
            $lending->books()->attach(session('cart'));
            session()->forget('cart');
            return redirect()->back();
            

        }
    }

    public function refund($id)
    {
        $lending = Lending::find($id);
        if(!$lending)
            return redirect()->back();
        
        $date_finish = Carbon::now();
        $lending->date_finish = $date_finish;
        $update = $lending->save();

        if ($update)
            return redirect()
                        ->route('lendings.index')
                        ->with('success', 'Atualizado com sucesso!');
        else
            return redirect()
                        ->back()
                        ->with('error', 'Falha ao atualizar!');
    }
}
