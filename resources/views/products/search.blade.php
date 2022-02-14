@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Pesquise produtos</h2>
        <form action="{{route('produtos.search')}}" method="post">
            @csrf

            <div>
                <label for="productName" class="form-label">Nome do produto</label>
                <input type="text" name="name" class="form-control">
                @if ($errors->has('name'))
                    <span class="help-block text-sm text-danger ">
                        {{ $errors->first('name') }}
                    </span>
                @endif
            </div>
            <div class="mt-3">
                <p class="mb-1">Tags</p>
                <div class="btn-group flex-wrap ml-0" role="group">
                    @foreach ($tags as $tag)
                    
                    <input type="checkbox" class="btn-check" name="tags[]" id="tag-{{$tag->id}}" value="{{$tag->id}}" autocomplete="off">
                    <label for="tag-{{$tag->id}}" class="btn btn-outline-primary m-1" >{{$tag->name}}</label>   
                    
                    @endforeach
                </div>
                <p>Caso você não deseje filtrar os produtos por tag, basta não selecionar nenhuma</p>
            </div>

            <button class="btn btn-success mt-3">Pesquisar</button>
        </form>


        {{-- Listagem de produtos --}}
        @if(isset($products))

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th scope="col" class="col-10">Nome do produto</th>
                    <th scope="col" class="col-2">Tags</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td> 
                            <button type="button" class="btn btn-outline-info btn-sm " data-bs-toggle="modal" data-bs-target="#tag-{{$product->id}}Modal">
                                Tags
                            </button>
                            <div class="modal fade" id="tag-{{$product->id}}Modal" tabindex="-1" aria-labelledby="tag-{{$product->id}}Label" aria-hidden="true">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" id="tag-{{$product->id}}Label">Tags deste produto</h5>
                                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                    </div>
                                    <div class="modal-body">
                                      @foreach ($product->tags as $tag)
                                          {{$tag->name}}<br>
                                      @endforeach
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @endif
    </div>
@endsection