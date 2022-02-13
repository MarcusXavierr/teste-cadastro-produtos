@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Editar produto</h2>
        <form action="{{route('produtos.update', ['produto' => $product->id])}}" method="post">
            @csrf
            @method('PUT')
            <div>
                <label for="productName" class="form-label">Nome do produto</label>
                <input type="text" name="name" class="form-control" value="{{$product->name}}">
                @if ($errors->has('name'))
                    <span class="help-block text-sm text-danger ">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
            <div class="mt-3">
                <p class="mb-1">Escolha as tags do produto</p>
                <div class="btn-group flex-wrap" role="group">
                    @foreach ($tags as $tag)
                        
                    <input type="checkbox" class="btn-check" name="tags[]" 
                        id="tag-{{$tag->id}}" value="{{$tag->id}}"  autocomplete="off"
                        @foreach ($product->tags as $pTag)
                            @if($pTag->id == $tag->id)
                                checked
                                @break
                            @endif
                        @endforeach
                        >
                    <label for="tag-{{$tag->id}}" class="btn btn-outline-primary m-1" >{{$tag->name}}</label>   
                    
                    @endforeach
                   </div>
            </div>

               
            <button type="submit" class="btn btn-success mt-4 px-5">Editar</button>
            
        </form>
    </div>
@endsection