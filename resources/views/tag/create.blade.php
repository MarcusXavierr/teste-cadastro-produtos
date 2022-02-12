@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Adicionar nova tag</h2>
        <form action="{{route('tags.store')}}" method="post">
            @csrf
            <div class="mb-3">
                <label for="tagNameInput" class="form-label">Nome da tag</label>
                <input type="text" name='name' class="form-control" id="tagNameInput">
            </div>
            <button class="btn btn-success">Adicionar Tag</button>
        </form>
    </div>
@endsection