<?php

class login extends ACore {
    
    protected function obr(){
        $login = strip_tags(mysql_escape_string($_POST['login']));
        $password = strip_tags(mysql_escape_string($_POST['password']));
        
        if (!empty($login) AND !empty($password)){
            $password = md5($password);
            
            $query = "SELECT id FROM users WHERE login='$login' AND pass = '$password'";
            
            $result = mysql_query($query);
            
            if(!$result){
                exit(mysql_error());
            }
            
            if(mysql_num_rows($result) ==1){
                $_SESSION['user'] = TRUE;
                header("Location:?option=admin");
                exit();
            }
            else {
                exit("Такого пользователя нет");
            }
        }
    else {
            exit("Заполните обязательные поля");
 }
    }

        public function get_content() {
        
       
        echo '<div id="main">';
        
        print <<<HEREDOC
<form enctype='multipart/form-data' action='' method='POST'>
<p>Логин:<br />
<input type='text' name='login'>
        
<p>Пароль:<br />
<input type='password' name='password'>
</p>
<p><input type='submit' name='buttom' value='Сохранить'></p></form>
HEREDOC;
             echo '</div></div>';
    }
   
}
