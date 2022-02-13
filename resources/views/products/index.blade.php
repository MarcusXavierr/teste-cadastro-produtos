@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Listagem de produtos</h2>
        @auth
            <a href="{{route('produtos.create')}}" class="btn btn-success">Adicionar produto</a>
        @endauth
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th scope="col" class="col-8">Nome do produto</th>
                    <th scope="col" class="col-2">Tags</th>
                    @auth  <th scope="col" class="col-2">Ações</th> @endauth
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{$product->name}}</td>
                        <td> 
                            <button type="button" class="btn btn-outline-info btn-sm " data-bs-toggle="modal" data-bs-target="#tag-{{$product->id}}">
                                Tags
                            </button>
                            <div class="modal fade" id="tag-{{$product->id}}" tabindex="-1" aria-labelledby="tag-{{$product->id}}Label" aria-hidden="true">
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
                        @auth
                            <td>
                                <div class="btn-group flex-wrap">
                                    <a class="btn btn-outline-primary btn-sm" href="{{route('produtos.edit', ['produto' => $product->id])}}">Editar</a>
                                    <x-delete-item :item="$product" :route="route('produtos.destroy', ['produto' => $product->id])"/>
                                </div>
                            </td>
                        @endauth
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$products->links()}}
    </div>
@endsection