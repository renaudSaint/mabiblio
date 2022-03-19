<?php
if (isset($_GET['valider'])){$isbn = isset($_GET['isbn']) ? $_GET['isbn'] : '';
// ou si vous préférez hardcodé


//$isbn = '9782800127767';
if (isset($isbn)){
$request = 'https://www.googleapis.com/books/v1/volumes?q=isbn:' . $isbn;
$response = file_get_contents($request);
$results = json_decode($response);}

if($results->totalItems > 0){
   // avec de la chance, ce sera le 1er trouvé
   $book = $results->items[0];

   $infos['isbn'] = $book->volumeInfo->industryIdentifiers[0]->identifier;
   $infos['titre'] = $book->volumeInfo->title;
   if (isset($book->volumeInfo->authors[0])){
    $infos['auteur'] = $book->volumeInfo->authors[0];
 }
   $infos['langue'] = $book->volumeInfo->language;
   $infos['publication'] = $book->volumeInfo->publishedDate;
   $infos['pages'] = $book->volumeInfo->pageCount;

   if (isset($book->volumeInfo->publisher)){

       $infos['edition'] = $book->volumeInfo->publisher;
   }

   if (isset($book->volumeInfo->description)){

    $infos['description'] = $book->volumeInfo->description;
   }


   if( isset($book->volumeInfo->imageLinks) ){
       $infos['image'] =  str_replace('&edge=curl', '', $book->volumeInfo->imageLinks->thumbnail);
       $infos['image'] = '<img src="'.$infos['image'].'" alt="texte alternatif" />';
   }
 
  
}
else{
   echo 'Livre introuvable';
}}
?>