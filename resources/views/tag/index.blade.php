@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listagem de Tags disponiveis</h2>
        <a class="btn btn-success" href="{{route('tags.create')}}">Adicionar Tag</a>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome da tag</th>
                    <th>Editar</th>
                    <th>Deletar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td> <a class="btn btn-warning" href="{{route('tags.edit', ['tag' => $tag->id])}}">Editar</a> </td>
                        <td>
                            <form action="{{route('tags.destroy', ['tag' => $tag->id])}}" method='post'>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Deletar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection