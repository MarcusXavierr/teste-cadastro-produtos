@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @guest
                <h3>Olá, seja bem vindo(a) ao CRUD de produtos e tags</h3>
                <p>É preciso que você esteja logado para conseguir criar, 
                    deletar e editar tags. Mas sem uma conta você consegue conferir
                    todos os produtos e tags disponiveis no sistema
                </p>
    
            @else
                <h3>Olá {{$user->name}}! Seja bem vindo(a) de volta!</h3>
                <p>
                    Aqui você pode editar, criar e deletar novos produtos e novas tags
                </p>
            @endguest
        </div>
    </div>
</div>
@endsection
