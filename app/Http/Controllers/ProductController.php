<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'search']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::orderBy('name')->paginate(15);

        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('products.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductFormRequest $request)
    {

        $data = $request->all();
        $tags = $request->get('tags');
        try {
            $product = new Product();
            $productInstance = $product->create($data);
            $productInstance->tags()->sync($tags);
        } catch (Exception $e) {
            $this->returnErrorMessage($e, 'salvar');
            return redirect()->route('produtos.create');
        }
        notify()->success("Produto adicionado com sucesso!", "Deu tudo certo");
        return redirect()->route('produtos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $tags = Tag::all();
        return view('products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductFormRequest $request, $id)
    {
        $data = $request->all();
        $tags = $request->get('tags');
        $product = Product::findOrFail($id);
        try {
            $product->update($data);
            $product->tags()->sync($tags);
        } catch (Exception $e) {
            $this->returnErrorMessage($e, 'atualizar');
            return redirect()->route("produtos.edit", ['produto' => $id]);
        }
        notify()->success("Produto atualizado com sucesso", "Deu tudo certo");
        return redirect()->route('produtos.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        /*
        Como eu não quero alterar as minhas migrations
        porque isso deixaria o schema do meu banco de dados diferente do schema do teste
        eu vou fazer a lógica de deletar em cascata aqui mesmo
        */
        DB::table('product_tag')->where('product_id', $product->id)->delete();

        $isDeleted = $product->delete();
        if ($isDeleted) {
            notify()->success("Produto deletado com sucesso", "Tudo ok");
        } else {
            notify()->error("Tente novamente mais tarde", "Erro ao deletar produto");
        }
        // Depois adicionar a mensagem de sucesso ou erro
        return redirect()->route('produtos.index');
    }

    private function returnErrorMessage(Exception $e, $actionType)
    {
        $title = "Erro ao $actionType no banco de dados";
        if ($e->getCode() == 23000) {
            notify()->error("Já existe um produto com o nome que você tentou usar!", $title);
        } else {
            notify()->error("Erro desconhecido no banco de dados, por favor tente novamente mais tarde", $title);
        }
    }

    public function search(Request $request)
    {
        $tags = Tag::all();
        if ($request->isMethod('GET')) {
            return view('products.search', compact('tags'));
        }

        $data = $request->all();
        $products = $this->fetchProductsFromDB($data);
        notify()->success('Pesquisa feita com sucesso', 'Tudo ok');
        return view('products.search', compact('tags', 'products'));
    }

    private function fetchProductsFromDB($data)
    {

        $partialQuery = Product::where('name', 'like', "%{$data['name']}%");

        if (!isset($data['tags'])) {
            $products = $partialQuery->get();
        } else {
            $products = $partialQuery->join('product_tag', 'product.id', '=', 'product_tag.product_id')
                ->whereIn('tag_id', $data['tags'])->get();
        }

        return $products;
    }
}
