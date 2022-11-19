<?php
$isbn = $_GET['isbn'];
$image = $_GET['image'];
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
      if (isset($book->volumeInfo->pageCount)){
         $infos['pages'] = $book->volumeInfo->pageCount;
      }
    
   
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

   ?>
   <table border="1">
   
   
   <th>couverture</th><th>description</th>
   
   <tr>

    
   <td><img src="<?php echo $image;?> "width="196" height="258"/></td>
    <td><?php if(!isset($infos['description'])){echo 'pas de description';}else{echo $infos['description'];} ?> </td>
   </tr>
   
   </table>
   

   

   