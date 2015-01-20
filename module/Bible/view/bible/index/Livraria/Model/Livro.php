<?php

namespace Livraria\Model;

class Livro {
    
    public $liv_id;
    public $liv_title;
    public $liv_cat_id;
    public $liv_author;
    public $liv_description;
    public $liv_img;
    public $liv_img_url;


    public function exchangeArray($data){
        $this->liv_id          = (isset($data['liv_id'])) ? $data['liv_id'] : null;
        $this->liv_title       = (isset($data['liv_title'])) ? $data['liv_title'] : null;
        $this->liv_cat_id   = (isset($data['liv_cat_id'])) ? $data['liv_cat_id'] : null;
        $this->liv_author      = (isset($data['liv_author'])) ? $data['liv_author'] : null;
        $this->liv_description = (isset($data['liv_description'])) ? $data['liv_description'] : null;
        $this->liv_img         = (isset($data['liv_img'])) ? $data['liv_img'] : null;
        $this->liv_img_url     = (isset($data['liv_img_url'])) ? $data['liv_img_url'] : null;
                
    }
    
    function getId() {
        return $this->liv_id;
    }

    function getTitle() {
        return $this->liv_title;
    }

    function getCategoria() {
        return $this->liv_cat_id;
    }

    function getAuthor() {
        return $this->liv_author;
    }

    function getDescription() {
        return $this->liv_description;
    }

    function getImg() {
        return $this->liv_img;
    }

    function getImgUrl() {
        return $this->liv_img_url;
    }

    function setId($liv_id) {
        $this->liv_id = $liv_id;
    }

    function setTitle($liv_title) {
        $this->liv_title = $liv_title;
    }

    function setCategoria($liv_cat_id) {
        $this->liv_cat_id = $liv_cat_id;
    }

    function setAuthor($liv_author) {
        $this->liv_author = $liv_author;
    }

    function setDescription($liv_description) {
        $this->liv_description = $liv_description;
    }

    function setImg($liv_img) {
        $this->liv_img = $liv_img;
    }

    function setImgUrl($liv_img_url) {
        $this->liv_img_url = $liv_img_url;
    }

}
