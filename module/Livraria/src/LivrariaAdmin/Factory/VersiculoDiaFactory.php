<?php


namespace LivrariaAdmin\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class VersiculoDiaFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        
        $url = simplexml_load_file('https://www.biblegateway.com/usage/votd/rss/votd.rdf?version=37');
        if(!$url){
            return false;
        }
        $verso =(string) $url->channel->item->title;
        $ref = explode(' ', $verso);


        if(count($ref) == 3 && is_numeric($ref[0])){
            $num = $ref[0];
            $lv = $ref[0]." ".$ref[1];

            $c = explode(':', $ref[2]);
            $capitulo = $c[0];
            $ver = $c[1];
        }else{
            $lv = $ref[0];
            $c = explode(':', $ref[1]);
            $capitulo = $c[0];
            $ver = $c[1].$ref[2];
        }
        $pos = strpos($ver, ',');
        if ($pos != false){
            $ver = explode(',', $ver);
            $ver = $ver[0].'-'.$ver[1];
        }
        
        
        $livro = $serviceLocator->get('Livraria\Model\BookService')->selectByName($lv);
        $data = [
            'vd_date'=>date('d/m/Y'),
            'vd_livro'=>$livro[0]->id,
            'vd_capitulo'=>(int) $capitulo,
            'vd_versiculos'=>$ver,
            'vd_ref'=>$verso,
        ];
        return $data;
        
        
    }
}
