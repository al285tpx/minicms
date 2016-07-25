<?php
class menu extends ACore {
    
   public function get_content() {
        echo '<div id="main">';       
        //проверяем есть в $_GET параметр id_menu 
       if (! $_GET['id_menu']) {
           echo 'Не правильный данные для вывода меню';
          }
       else {
            $id_menu=(int)$_GET['id_menu'];//если есть приобразуем его в число
            if (!$id_menu) {
            echo 'Не правильный данные для вывода статьи';    
            } 
            else {
                $query = "SELECT id_menu, name_menu, text_menu FROM menu WHERE id_menu='$id_menu'";
                $result = mysql_query($query);
                if (!$result) {
                    exit(mysql_error());
                }
                $row = mysql_fetch_array($result, MYSQLI_ASSOC);
                printf("<p style='font-size:18px'>%s</p>
                        <p>%s</p>"
                        ,$row['name_menu'], $row['text_menu']);
            }
       }
         
       
        
        echo '</div></div>';
    } 
}



