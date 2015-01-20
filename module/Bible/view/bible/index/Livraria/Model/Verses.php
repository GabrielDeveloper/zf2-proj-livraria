<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Livraria\Model;


class Verses {

    public $id;
    public $version;
    public $testament;
    public $book;
    public $chapter;
    public $verse;
    public $text;
    
    
    public function exchangeArray($data){
        $this->id = (isset($data['id'])) ? $data['id'] : null;
        $this->version = (isset($data['version'])) ? $data['version'] : null;
        $this->testament = (isset($data['testament'])) ? $data['testament'] : null;
        $this->book = (isset($data['book'])) ? $data['book'] : null;
        $this->chapter = (isset($data['chapter'])) ? $data['chapter'] : null;
        $this->verse = (isset($data['verse'])) ? $data['verse'] : null;
        $this->text = (isset($data['text'])) ? $data['text'] : null;
        
    }
    
    function getId() {
        return $this->id;
    }

    function getVersion() {
        return $this->version;
    }

    function getTestament() {
        return $this->testament;
    }

    function getBook() {
        return $this->book;
    }

    function getChapter() {
        return $this->chapter;
    }

    function getVerse() {
        return $this->verse;
    }

    function getText() {
        return $this->text;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setVersion($version) {
        $this->version = $version;
    }

    function setTestament($testament) {
        $this->testament = $testament;
    }

    function setBook($book) {
        $this->book = $book;
    }

    function setChapter($chapter) {
        $this->chapter = $chapter;
    }

    function setVerse($verse) {
        $this->verse = $verse;
    }

    function setText($text) {
        $this->text = $text;
    }


    
}
