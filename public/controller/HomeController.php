<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;


$dados = array(
    ["id" => rand(1, 100), "data" => date("d-m-Y"), "nome" => "alan", "telefone" => "(21) 00000-0000", "email" => "a@gmail.com","cep"=>"00000-000"],
    ["id" => rand(1, 100), "data" => date("d-m-Y"), "nome" => "jose", "telefone" => "(21) 00000-0000", "email" => "a@gmail.com","cep"=>"00000-000"],
    ["id" => rand(1, 100), "data" => date("d-m-Y"), "nome" => "mario", "telefone" => "(21) 00000-0000", "email" => "a@gmail.com","cep"=>"00000-000"],
    ["id" => rand(1, 100), "data" => date("d-m-Y"), "nome" => "paulo", "telefone" => "(21) 00000-0000", "email" => "a@gmail.com","cep"=>"00000-000"],
    ["id" => rand(1, 100), "data" => date("d-m-Y"), "nome" => "silvio", "telefone" => "(21) 00000-0000", "email" => "a@gmail.com","cep"=>"00000-000"]
);


class HomeController
{
    
   
    
    public function listar(Request $request, Response $response, array $args): Response
    {
        global $dados;
        $response->getBody()->write(json_encode($dados));
        return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(200);
    }
    public function pesquisar(Request $request, Response $response, array $args): Response
    {
        global $dados;
        $id = $args["id"];
        $cliente = $dados[$id];
        if ($cliente) {
            $response->getBody()->write(json_encode($cliente));
            return $response->withHeader('Content-Type', 'application/json')
            ->withStatus(200);
        } else {
            $response->getBody()->write(json_encode(["msg" => "Cliente não encontrado :("]));
            return $response->withHeader('Content-Type', 'application/json')
                ->withStatus(404);
            }
        }
    public function salvar(Request $request, Response $response, array $args): Response
    {
        global $dados;
        $body = $request->getParsedBody();
        $cliente = [
            "id" => rand(1, 100),
            "data" => date("d-m-Y"),
            "nome" => $body["nome"],
            "telefone" => $body["telefone"],
            "email" => $body["email"],
            "cep" => $body["cep"]
        ];
        array_push($dados,$cliente);
        $response->getBody()->write(json_encode($dados));
        return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
    }
    public function editar(Request $request, Response $response, array $args): Response
    {
        global $dados;
        $id = $args["id"];
        $body = $request->getParsedBody();
        $cliente = [
            "id" => rand(1, 100),
            "data" => date("d-m-Y"),
            "nome" => $body["nome"],
            "telefone" => $body["telefone"],
            "email" => $body["email"],
            "cep" => $body["cep"]
        ];
        $dados[$id] = $cliente;
        $response->getBody()->write(json_encode($dados));
        return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
    }
    public function deletar(Request $request, Response $response, array $args): Response
    {
        global $dados;
        $id = $args["id"];
        array_splice($dados,$id,1);
        $response->getBody()->write(json_encode($dados));
        return $response->withHeader('Content-Type', 'application/json')
        ->withStatus(201);
    }
}
