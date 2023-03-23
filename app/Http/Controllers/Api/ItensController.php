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

    private $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
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
        //GERA O TOKEN CM 32 CARACTERES
        $token = strval(bin2hex(random_bytes(32)));
        //RECEBE OS DADOS PASSADOS
        $dados = $request->all();

        //VERIFICA E TESTA SE O TOKEN GERADO JÁ EXISTE NO BANCO DE DADOS
        $tokenDisponivel = Token::where('token', '=', "{$token}")->get();
        //CASO A CHAVE JA EXISTA, ELE GERA UMA NOVA
        if(isset($tokenDisponivel[0]->token)){
            $token = strval(bin2hex(random_bytes(32)));
        }
        else{
            //CASO NÃO EXISTA ELE FAZ A VALIDAÇÃO DE EMAIL PASSADO NO PARAMETRO TEM UM FORMATO VALIDO.
            if (filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {

                //VALIDA SE O NOME PASSADO JÁ EXISTE NO BANCO DE DADOS
                $nomeDisponivel = Token::where('nome', '=', "{$request->nome}")->get();
                if (isset($nomeDisponivel[0]->nome)) {

                    return json_encode('nome indisponivel');
                }
                //CASO NÃO EXISTA ELE VALIDA SE O EMAIL JÁ EXISTE NO BANDO.
                else {

                    $emailDisponivel = Token::where('email', '=', "{$request->email}")->get();
                    if (isset($emailDisponivel[0]->email)) {

                        return json_encode('E-mail indisponivel');
                    } else {

                        //CASO NÃO EXISTA, ADICIONA O TOKEN JUNTO DO ARRAY E SALVA OS DADOS NA TABELA TOKENS NO BANCO.
                        $dados['token'] = $token;
                        Token::create($dados);

                        //RETORNA O TOKEN
                        return json_encode('Token gerado com sucesso TOKEN: ' . $token) ;
                    }
                }

            } else {

                return 'Formato de e-mail invalido';
            }
        }

    }



}
