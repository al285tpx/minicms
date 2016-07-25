<?php
class category extends ACore {
    
    public function get_content() {
        
        echo '<div id="main">';
        
        if (! $_GET['id_cat']) {
           echo 'Не правильный данные для вывода статьи';
          }
        else {
            $id_cat = (int)$_GET['id_cat'];
            if (!$id_cat) {
            echo 'Не правильный данные для вывода статьи';    
            }
            else { $query = "SELECT id, title, discription, date, img_src
                    FROM statti 
                    WHERE cat='$id_cat'
                    ORDER BY date DESC";
              $result = mysql_query($query);
              if (!$result) {
                   exit(mysql_error());
              }
              
              if (mysql_num_rows($result) > 0) {
                  
                  $row = array();
              for ($i=0; $i < mysql_num_rows($result);$i++) { //цикл будет вытаскивать содержимое БД пока $i не станет меньше количества строк в $result 
              $row = mysql_fetch_array($result, MYSQL_ASSOC);
              printf("<div style='margin:10px;border-bottom:2px solid #c2c2c2'>
                  <p style='font-size:18px'>%s</p>
                  <p>%s</p>
                  <p><img style='margin:5px' width='150px' align='left' src='%s'>%s</p>
                  <p style='color:red'><a href=?option=view&id_text=%s'>Читать далее...</a></p>
                  
                  </div>
                  ",$row['title'],$row['date'],$row['img_src'],$row['discription'],$row['id']);
               }
              }
            else {
                  echo 'В данной категории нет статей';
            }
                                
            }
        }
       echo '</div></div>';
    }
   
}



