<?php

namespace App\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\Contracts\RepositoryInterface;

interface CidadeRepository extends RepositoryInterface
{

    /**
     * Pesquisa e retorna UF's distintas das cidades
     *
     * @return Collection
     */
    public function getUFs();

    /**
     * Retorna Cidades de uma determinada UF
     *
     * @param string $uf
     * @return Collection
     */
    public function getByUF($uf);

    /**
     * Retorna uma Cidade pelo nome e uf
     *
     * @param string $nome
     * @param string $uf
     * @return mixed
     */
    public function getByCidadeUF($nome, $uf);

    /**
     * Retorna nome da Cidade pelo id
     *
     * @param string $cidade_id
     */
    public function getNameCity($cidade_id);

}