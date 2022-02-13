<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
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
        $tags = Tag::paginate(15);

        return view('tag.index', compact("tags"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tag.create');
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
        $tag = new Tag();
        $isSaved = $tag->create($data);
        if (!$isSaved) {
            return "Erro ao salvar no banco de dados";
            //só pra testar, depois eu adiciono um toast notification
        }
        return redirect()->route('tags.index');
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
        $tag = Tag::findOrFail($id);
        return view('tag.edit', compact('tag'));
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
        $tag = Tag::findOrFail($id);
        $data = $request->all();
        $isUpdated = $tag->update($data);
        if (!$isUpdated) {
            return "Erro ao atualizar tag no banco de dados";
        }
        return redirect()->route('tags.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);

        /*
        Como eu não quero alterar as minhas migrations
        porque isso deixaria o schema do meu banco de dados diferente do schema do teste
        eu vou fazer a lógica de deletar em cascata aqui mesmo
        */

        DB::table('product_tag')->where('tag_id', $tag->id)->delete();
        $tag->delete();

        // Depois adicionar a mensagem de sucesso ou erro
        return redirect()->route('tags.index');
    }
}
