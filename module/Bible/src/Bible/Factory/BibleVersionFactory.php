<?php

namespace Bible\Factory;

use Zend\ServiceManager\FactoryInterface,
    Zend\ServiceManager\ServiceLocatorInterface;

class BibleVersionFactory implements FactoryInterface{
    
    public function createService(ServiceLocatorInterface $serviceLocator) {
        $patch = __DIR__.'/../Sql/1joao.sql';
        $arquivo = fopen($patch, 'w+'); 
        $insert = "INSERT INTO verses(version,testament,book,chapter,verse,text) VALUES \n";
        fwrite($arquivo, $insert);
        for ($i=1;$i<=5;$i++){
                $ve = 1;
                do{
                    //$url = 'https://www.biblegateway.com/passage/?search=G%C3%AAnesis+1:'.$ve.'&version=NTLH';
                    $url = 'https://www.biblegateway.com/passage/?search=1joao+'.$i.':'.$ve.'&version=ARC';
                    $content = file_get_contents($url);

                    if($ve == 1){
                        $data1 = explode('class="chapternum">'.$i.' </span>', $content);
                    } else {
                        $data1 = explode('</sup>', $content);
                    }
                    
                    $data2 = explode('</div>',$data1[1]);

                    $dados = !empty($data2[0])?$data2[0]:null;
                    $text = trim(strip_tags($dados));

                    if($dados != null){
                        $sql .= "('ntlh','2','62','{$i}','{$ve}','{$text}'),";
                    }
                    $ve++;
                } while ($dados);
                $sql .= "\n";
                fwrite($arquivo, $sql);
                unset($sql);
            }

            fclose($arquivo);
        }
    
    public function createFilesSqlBibleVersion(){
        $books = $serviceLocator->get('Livraria\Service\BookService');    

        $livros = $books->fetchAll();
        $patchReference = __DIR__.'/../Sql/reference.txt';
        $fileReference = fopen($patchReference, 'w+');
        foreach ($livros as $livro){

            $nameSql = preg_replace( '/[`^~\'"]/', null, iconv('UTF-8','ASCII//TRANSLIT',$livro->name));
            $patch = __DIR__.'/../Sql/'.  str_replace(' ','',strtolower($nameSql)).'.sql';
            if(!file_exists($patch))
                $arquivo = fopen($patch, 'w+'); 
            else
                continue;
                
            $insert = "INSERT INTO verses(version,testament,book,chapter,verse,text) VALUES \n";
            fwrite($arquivo, $insert);

            $verses = $serviceLocator->get('Livraria\Service\VersesService');
            $chapters = $verses->selectDistinctChapter($livro->id);
            
            for ($i=1;$i<=$chapters;$i++){
                $ve = 1;
                do{
                    if($livro->id == 22){
                        $livro->name = 'Cântico%20dos%20Cânticos';
                    }
                    //$url = 'https://www.biblegateway.com/passage/?search=G%C3%AAnesis+1:'.$ve.'&version=NTLH';
                    $url = 'https://www.biblegateway.com/passage/?search='.str_replace(' ','%20',$livro->name).'+'.$i.':'.$ve.'&version=NTLH';
                    $content = file_get_contents($url);

                    if($ve == 1){
                        $data1 = explode('class="chapternum">'.$i.' </span>', $content);
                    } else {
                        $data1 = explode('</sup>', $content);
                    }

                    $pos   = strripos($data1[1], '<div class="crossrefs hidden">');
                    if ($pos === false){
                        $data2 = explode('</div>',$data1[1]);
                    } else {
                        $data2 = explode('<div ',$data1[1]);
                        $reference = substr(strstr(trim(strip_tags($data2[1])),':'),1);
                        fwrite($fileReference, $reference."\n");
                    }

                    $dados = !empty($data2[0])?$data2[0]:null;
                    //$versos[] =  $ve." - ".strip_tags($dados)."<br>";
                    $text = trim(strip_tags($dados));

                    if($dados != null){
                        //version,testament,book,chapter,verse,text
                        $sql .= "('ntlh','{$livro->testament}','{$livro->id}','{$i}','{$ve}','{$text}'),";
                    }
                    $ve++;
                } while ($dados);
                $sql .= "\n";
                fwrite($arquivo, $sql);
                unset($sql);
            }

            fclose($arquivo);
        }
        return true;        
        
    }
}
