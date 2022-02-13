@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listagem de Tags disponiveis</h2>
        <a class="btn btn-success" href="{{route('tags.create')}}">Adicionar Tag</a>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th class="col-10">Nome da tag</th>
                    <th class="col-2">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{$tag->name}}</td>
                        <td>
                            <div class="btn-group">
                                <a class="btn btn-outline-primary btn-sm" href="{{route('tags.edit', ['tag' => $tag->id])}}">Editar</a> 
                                <x-delete-item :item="$tag" :route="route('tags.destroy', ['tag' => $tag->id])"/>
                            </div>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$tags->links()}}
    </div>
@endsection