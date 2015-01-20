<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Livraria\Model;


class Categoria {

    public $cat_id;
    public $cat_title;
    public $cat_description;
    public $cat_img;
    public $cat_img_url;
    
    public function exchangeArray($data){
        $this->cat_id = (isset($data['cat_id'])) ? $data['cat_id'] : null;
        $this->cat_title = (isset($data['cat_title'])) ? $data['cat_title'] : null;
        $this->cat_description = (isset($data['cat_description'])) ? $data['cat_description'] : null;
        $this->cat_img = (isset($data['cat_img'])) ? $data['cat_img'] : null;
        $this->cat_img_url = (isset($data['cat_img_url'])) ? $data['cat_img_url'] : null;
    }
    
    public function getId() {
        return $this->cat_id;
    }

    public function getTitle() {
        return $this->cat_title;
    }

    public function getDescription() {
        return $this->cat_description;
    }

    public function getImage() {
        return $this->cat_img;
    }
    
    public function getImageUrl(){
        return $this->cat_img_url;
    }

    public function setId($cat_id) {
        $this->cat_id = $cat_id;
    }

    public function setTitle($cat_title) {
        $this->cat_title = $cat_title;
    }

    public function setDescription($cat_description) {
        $this->cat_description = $cat_description;
    }

    public function setImage($cat_img) {
        $this->cat_img = $cat_img;
    }
    
    public function setImageUrl($cat_img_url){
        $this->cat_img_url = $cat_img_url;
    }


    
}
