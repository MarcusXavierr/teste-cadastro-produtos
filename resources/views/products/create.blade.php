@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Criar novo produto</h2>
        <form action="{{route('produtos.store')}}" method="post">
            @csrf

            <div>
                <label for="productName" class="form-label">Nome do produto</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="mt-3">
                <p class="mb-1">Escolha as tags do produto</p>
                <div class="btn-group flex-wrap" role="group">
                    @foreach ($tags as $tag)
                        
                    <input type="checkbox" class="btn-check" name="tags[]" id="tag-{{$tag->id}}" value="{{$tag->id}}" autocomplete="off">
                    <label for="tag-{{$tag->id}}" class="btn btn-outline-primary m-1" >{{$tag->name}}</label>   
                    
                    @endforeach
                   </div>
            </div>

               
            
            <button type="submit" class="btn btn-success">Criar</button>
        </form>
    </div>
@endsection