<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Tag;
use Exception;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{



    public function __construct()
    {
        $this->middleware('auth')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();

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
    public function store(Request $request)
    {

        $data = $request->all();
        $tags = $request->get('tags');
        try {
            $product = new Product();
            $productInstance = $product->create($data);
            $productInstance->tags()->sync($tags);
        } catch (Exception $e) {
            if ($e->getCode() == 23000) {
                return "Você não pode ter nomes duplicados";
            }
            return "Erro ao salvar no banco de dados";
            //logo vou dar um jeito de fazer ele voltar pra tela com essa mensagem
            //de erro
        }

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
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $tags = $request->get('tags');
        $product = Product::findOrFail($id);
        $isUpdated = $product->update($data);
        $product->tags()->sync($tags);
        if (!$isUpdated) {
            return "Erro ao atualizar";
        }
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

        $product->delete();
        // Depois adicionar a mensagem de sucesso ou erro
        return redirect()->route('produtos.index');
    }
}
