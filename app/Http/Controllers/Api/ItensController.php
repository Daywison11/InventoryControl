<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Itens;
use App\Models\Token;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\Arr;

use Illuminate\Support\Facades\DB;

class ItensController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    private $itens;

    public function __construct(Itens $itens)
    {
        $this->itens = $itens;
    }

    public function index()
    {
        return $this->itens->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $chave = $request->header()['chave'][0];
        $dados = $request->all();

        var_dump($chave . ' Dados ', $dados); exit();

        $data = $request->all();
        return $this->itens->create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        if ($item = Itens::find($id)) {

            $item = Itens::find($id);
            return $item;
        } else {
            return json_encode($item);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();

        if ($item = Itens::find($id)) {

            $item->update($data);

            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if ($item = Itens::find($id)) {

            $item->delete();

            return json_encode(true);
        } else {
            return json_encode(false);
        }
    }
    //faz select no banco por nome
    public function searchName(Request $request)
    {
        $item = Itens::where('nome', 'LIKE', "{$request->nome}%")->get();

        return $item;
    }

    //faz select no banco por tipo
    public function searchTipo(Request $request)
    {
        $item = Itens::where('tipo', 'LIKE', "{$request->tipo}%")->get();

        return $item;
    }

    //faz select no banco por codigo.
    public function searchCodigo(Request $request)
    {
        $item = Itens::where('codigo', '=', "{$request->codigo}")->get();

        return $item;
    }

    public function gerar(Request $request)
    {
        $token = strval(bin2hex(random_bytes(32)));
        $dados = $request->all();


        $item = Token::find(1);
        $token = $item->tokens;

        return $token;
        exit;

        if (filter_var($dados['email'], FILTER_VALIDATE_EMAIL)){
            $dados['token'] = $token;

            return Token::create($dados);
        }
        else{
            return 'email invalido';
        }

    }



}
