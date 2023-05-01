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


    public function index($token)
    {

        return $this->token->where('token', "$token")->with('itens')->get();

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $token)
    {
        $dados = $request->all();

        $token = Token::where('token', $token)->first();

        if (!$token) {
            return response()->json(['message' => 'Token não encontrado'], 404);
        }

        do {
            $codigo = rand(10000, 99999);
        } while ($token->itens()->where('codigo', $codigo)->exists());

        $dados['codigo'] = $codigo;

        $item = $token->itens()->create($dados);

        return response()->json($item);
    }

    /**
     * Display the specified resource.
     */
    public function show($token,$id)
    {
        $token = $this->token->where('token', $token)->first();

        if (!$token) {

            $mensagem = ['message' => 'Token não encontrado'];
            return response()->json($mensagem, 404);
        }

        $item = $token->itens()->where('id', $id)->first();

        if (!$item) {
            $mensagem = ['message' => 'Item não encontrado'];
            return response()->json($mensagem, 404);
        }

        return $item;

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
    //========================================== TOKEN ===================================================================
    public function gerar(Request $request)
    {
        //GERA O TOKEN CM 32 CARACTERES
        $token = strval(bin2hex(random_bytes(32)));
        //RECEBE OS DADOS PASSADOS
        $dados = $request->all();

        //VERIFICA E TESTA SE O TOKEN GERADO JÁ EXISTE NO BANCO DE DADOS
        $tokenDisponivel = Token::where('token', '=', "{$token}")->get();
        //CASO A CHAVE JA EXISTA, ELE GERA UMA NOVA
        if (isset($tokenDisponivel[0]->token)) {
            $token = strval(bin2hex(random_bytes(32)));
        } else {
            //CASO NÃO EXISTA ELE FAZ A VALIDAÇÃO DE EMAIL PASSADO NO PARAMETRO TEM UM FORMATO VALIDO.
            if (filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {

                //VALIDA SE O NOME PASSADO JÁ EXISTE NO BANCO DE DADOS
                $nomeDisponivel = Token::where('nome', '=', "{$request->nome}")->get();
                if (isset($nomeDisponivel[0]->nome)) {

                    $mensagem = ['message' => 'nome indisponivel'];
                    return response()->json($mensagem);
                }
                //CASO NÃO EXISTA ELE VALIDA SE O EMAIL JÁ EXISTE NO BANDO.
                else {

                    $emailDisponivel = Token::where('email', '=', "{$request->email}")->get();
                    if (isset($emailDisponivel[0]->email)) {

                        $mensagem = ['message' => 'E-mail indisponivel'];
                        return response()->json($mensagem);

                    } else {

                        //CASO NÃO EXISTA, ADICIONA O TOKEN JUNTO DO ARRAY E SALVA OS DADOS NA TABELA TOKENS NO BANCO.
                        $dados['token'] = $token;
                        Token::create($dados);

                        //RETORNA O TOKEN
                        $mensagem = ['message' => 'Token gerado com sucesso TOKEN', 'token' => $token];

                        return response()->json($mensagem, 201);
                    }
                }
            } else {

                return 'Formato de e-mail invalido';
            }
        }
    }

    public function buscar(Request $request)
    {

        if (filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {

            $nomeValida = Token::where('nome', 'LIKE', "{$request->nome}")->get();
            $emailValida = Token::where('email', 'LIKE', "{$request->email}")->get();

            if(isset($nomeValida[0]->nome)){

                if(isset($emailValida[0]->email)){

                    return $emailValida[0];
                }
                else{
                    $mensagem = ['message' => 'E-mail não encontrado'];

                    return response()->json($mensagem, 404);
                }
            }
            else{

                $mensagem = ['message' => 'Nome não encontrado'];
                return response()->json($mensagem, 404);
            }

        }
        else{
            $mensagem = ['message' => 'Email invalido'];

            return  response()->json($mensagem);
        }

    }
}
