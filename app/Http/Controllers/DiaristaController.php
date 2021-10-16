<?php

namespace App\Http\Controllers;

use App\Models\Diarista;
use Illuminate\Http\Request;
use App\classes\Helpers;
use App\classes\Helpers\Helper;
use App\Http\Requests\DiaristaRequest;
use App\Services\ViaCEP;

class DiaristaController extends Controller
{
    //protected ViaCEP $viaCEP;

    public function __construct(
        protected ViaCEP $viaCEP
    ) {
    }

    public function index()
    {
        $diaristas = Diarista::get();
        return view('index', [
            'diaristas' => $diaristas
        ]);
    }

    public function create()
    {
        $diaristas = Diarista::get();
        return view('create', [
            'diaristas' => $diaristas
        ]);
    }

    public function store(DiaristaRequest $request)
    {
        $dados = $request->except('_token');
        $dados['foto_usuario'] = $request->foto_usuario->store('public');

        $dados['cpf'] = Helper::limpaMascara($dados['cpf']);
        $dados['cep'] = Helper::limpaMascara($dados['cep']);
        $dados['telefone'] = Helper::limpaMascara($dados['telefone']);
        $dados['codigo_ibge'] = $this->viaCEP->buscar($dados['cep'])['ibge'];
        
        Diarista::create($dados);
        
        return redirect()->route('diaristas.index');
    }

    public function edit(int $id)
    {
        $diarista = Diarista::findOrFail($id);

        return view('edit', [
            'diarista' => $diarista
        ]);
    }

    public function update(int $id, DiaristaRequest $request)
    {
        $diarista = Diarista::findOrFail($id);

        $dados = $request->except('_token', '_method');

        $dados['cpf'] = Helper::limpaMascara($dados['cpf']);
        $dados['cep'] = Helper::limpaMascara($dados['cep']);
        $dados['telefone'] = Helper::limpaMascara($dados['telefone']);
        $dados['codigo_ibge'] = $this->viaCEP->buscar($dados['cep'])['ibge'];

        if($request->hasFile('foto_usuario')) {
            $dados['foto_usuario'] = $request->foto_usuario->store('public');
        }

        $diarista->update($dados);

        return redirect()->route('diaristas.index');
    }

    public function destroy(int $id)
    {
        $diarista = Diarista::findOrFail($id);

        $diarista->delete();

        return redirect()->route('diaristas.index');
    }
}
