@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listagem de produtos</h2>
        <a href="{{route('produtos.create')}}" class="btn btn-success">Adicionar produto</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome do produto</th>
                    <th>Tags</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td> KEK </td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-warning" href="{{route('produtos.edit', ['produto' => $product->id])}}">Editar</a>
                            <form action="{{route('produtos.destroy', ['produto' => $product->id])}}" method='post'>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection