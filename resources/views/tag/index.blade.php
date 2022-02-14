@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listagem de Tags disponiveis</h2>
        @auth
            <a class="btn btn-success" href="{{route('tags.create')}}">Adicionar Tag</a>
        @endauth
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th class="col-8">Nome da tag</th>
                    <th class="col-2">Qtd produtos</th>
                    @auth <th class="col-2">Ações</th> @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>{{count($tag->products)}}</td>
                        @auth
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-outline-primary btn-sm" href="{{route('tags.edit', ['tag' => $tag->id])}}">Editar</a> 
                                <x-delete-item :item="$tag" :route="route('tags.destroy', ['tag' => $tag->id])"/>
                            </div>
                            
                        </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$tags->links()}}
    </div>
@endsection