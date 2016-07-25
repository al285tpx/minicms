<?php
class view extends ACore {
    
   public function get_content() {
        echo '<div id="main">';       
        //проверяем есть в $_GET параметр id_text 
       if (! $_GET['id_text']) {
           echo 'Не правильный данные для вывода статьи';
          }
       else {
            $id_text=(int)$_GET['id_text'];//если есть приобразем его в число
            if (!$id_text) {
            echo 'Не правильный данные для вывода статьи';    
            }
            else {
                $query = "SELECT title,text,date,img_src FROM statti WHERE id='$id_text'";
                $result = mysql_query($query);
                if (!$result) {
                    exit(mysql_error());
                }
                $row = mysql_fetch_array($result, MYSQLI_ASSOC);
                printf("<div style='margin:10px;border-bottom:2px solid #c2c2c2'>
                  <p style='font-size:18px'>%s</p>
                  <p>%s</p>
                  <p><img style='margin:5px' width='150px' align='left' src='%s'>%s</p>"
                  
                  ,$row['title'], $row['date'],$row['img_src'],$row['text']);
            }
       }
         
       
        
        echo '</div></div>';
    } 
}

