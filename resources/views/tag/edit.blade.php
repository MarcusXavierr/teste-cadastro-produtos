@extends('layouts.app')

@section('content')
    <div class="container">
        <a href="{{route('tags.index')}}" class="link"><i class="fa-solid fa-angle-left"></i> Voltar</a>
        <h2>Adicionar nova tag</h2>
        <form action="{{route('tags.update', ['tag' => $tag->id])}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="tagNameInput" class="form-label">Nome da tag</label>
                <input type="text" name='name' class="form-control" id="tagNameInput" value="{{$tag->name}}">
                @if ($errors->has('name'))
                    <span class="help-block text-sm text-danger ">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
            <button class="btn btn-success">Editar Tag</button>
        </form>
    </div>
@endsection