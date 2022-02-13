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
                        <td> 
                            <button type="button" class="btn btn-info " data-bs-toggle="modal" data-bs-target="#tag-{{$product->id}}">
                                Ver as tags deste produto
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
        {{$products->links()}}
    </div>
@endsection