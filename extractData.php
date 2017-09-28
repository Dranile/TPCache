<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of extractData
 *
 * @author mpyz
 */
class extractData {
    private static $url = "http://www.jeuxdemots.org/rezo-dump.php?gotermsubmit=Chercher&gotermrel=";
    private static $directory = "query/";
    
    function __construct() {
        
    }
    
    /*
     * Parcours le fichier query à la recherche des éléments
     * S'il y a l'élément en cache, on le récupère et on l'affiche
     * Sinon on le télécharge et le met en cache
     */
    function getElement($query){
        $files = scandir(extractData::$directory);
        foreach ($files as $file){
            if(strcmp($file,$query) == 0){
                echo "<h3>Mot déja en cache</h3>";
                $filename = extractData::$directory . $query;
                if(filesize($filename) == 0){
                    return "";
                }
                $myFile = fopen($filename, "r");
                $result = fread($myFile, filesize($filename));
                fclose($myFile);
                return $result;
            }
        }
        echo "<h3>Création d'un nouveau jeu de données</h3>";
        $result = $this->extract($query);
        $this->writeContentInFile($query, $result);
        return $result;
    }
    
    private function extract($query){
        $curl_handle = curl_init();
        curl_setopt($curl_handle, CURLOPT_ENCODING, '');
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
        curl_setopt( $curl_handle, CURLOPT_URL, extractData::$url . $query);
        $result = curl_exec( $curl_handle ); // Execute the request
        curl_close($curl_handle);
        return $this->parse($result);
    }
    
    private function parse($html){
        $dom = new DOMDocument();
        @$dom->loadHTML($html);
        
        foreach($dom->getElementsByTagName('code') as $code) {
            return $code->nodeValue;
        }
    }
    
    private function writeContentInFile($name, $content){
        $myFile = fopen(extractData::$directory . $name, "w");
        fwrite($myFile, $content);
        fclose($myFile);
    }
}
