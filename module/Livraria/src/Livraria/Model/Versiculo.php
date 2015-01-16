<?php

namespace Livraria\Model;

class Versiculo {
    
    public $vd_id;
    public $vd_date;
    public $vd_livro;
    public $vd_capitulo;
    public $vd_versiculos;
    public $vd_ref;
    
    public function exchangeArray($data){
        $this->vd_id = (isset($data['vd_id'])) ? $data['vd_id'] : null;
        $this->vd_date = (isset($data['vd_date'])) ? $data['vd_date'] : null;
        $this->vd_livro = (isset($data['vd_livro'])) ? $data['vd_livro'] : null;
        $this->vd_capitulo = (isset($data['vd_capitulo'])) ? $data['vd_capitulo'] : null;
        $this->vd_versiculos = (isset($data['vd_versiculos'])) ? $data['vd_versiculos'] : null;
        $this->vd_ref = (isset($data['vd_ref'])) ? $data['vd_ref'] : null;
    }
    
    function getId() {
        return $this->vd_id;
    }

    function getDate() {
        return $this->vd_date;
    }
    
    function getLivro() {
        return $this->vd_livro;
    }

    function getCapitulo() {
        return $this->vd_capitulo;
    }

    function getVersiculos() {
        return $this->vd_versiculos;
    }
    
    function getRef(){
        return $this->getRef();
    }

    function setId($vd_id) {
        $this->vd_id = $vd_id;
    }

    function setDate($vd_date) {
        $this->vd_date = $vd_date;
    }

    function setLivro($vd_livro) {
        $this->vd_livro = $vd_livro;
    }

    function setCapitulo($vd_capitulo) {
        $this->vd_capitulo = $vd_capitulo;
    }

    function setVersiculos($vd_versiculos) {
        $this->vd_versiculos = $vd_versiculos;
    }

    function setRef($vd_ref){
        $this->vd_ref = $vd_ref;
    }

    
}
