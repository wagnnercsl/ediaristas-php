<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diarista extends Model
{
    use HasFactory;

    /**
     * Define os campos que podem ser gravados
     *
     * @var array
     */
    protected $fillable = ['nome_completo', 'cpf', 'email', 'telefone', 'logradouro', 'numero', 'complemento', 'bairro', 'cidade', 'estado', 'cep', 'codigo_ibge', 'foto_usuario'];

    /**
     * Define os campos que serão usados na serialização
     *
     * @var array
     */
    protected $visible = ['nome_completo', 'cidade', 'foto_usuario'];

    public function getFotoUsuarioAttribute(string $valor)
    {
        return config('app.url') . '/' . $valor;
    }
    
    /**
     * Busca diaristas pelo código do IBGE
     *
     * @param integer $codigoIbge
     * @return void
     */
    static public function buscaPorCodigoIbge(int $codigoIbge)
    {
        return self::where('codigo_ibge', $codigoIbge)->limit(6)->get();
    }

    /**
     * Busca a quantidade de diaristas
     *
     * @param integer $codigoIbge
     * @return void
     */
    static public function quantidadePorCodigoIbge(int $codigoIbge)
    {
        $quantidade = self::where('codigo_ibge', $codigoIbge)->count();

        return $quantidade > 6 ? $quantidade - 6 : 0;
    }
}
