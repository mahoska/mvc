<?php

namespace Model\Form;

use Library\Request;

class FeedbackForm{
    public $email;
    public $author;
    public $message;
    
    public function __construct(Request $request){
        $this->email = $request->post('email');
        $this->author = $request->post('author');
        $this->message = $request->post('message');
    }
    
    //todo_3::make validation + message form send or not
    public function isValid(&$str){
        if(trim($this->email)=='' || trim($this->author)=='' || trim($this->message)==''){
            $str = 'fill in the fields';
            return false;
        }
        //--проверка корректности email
        //[a-z0-9][a-z0-9\.-_]*[a-z0-9]+@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i
        //if (!preg_match("/^[-0-9a-z_\.]+@[-0-9a-z_^\.]+\.[a-z]{2,6}$/i", $this->email))
        $this->email = trim($this->email);     
        $uncorrect_symbol = [' ',',', ':', ';', '!', '#', '%', '*', '(', ')', '=', '+', '{', '}', '[', ']', '"',  '/', '\\', '|' ];
        for($i = 0, $len = strlen($this->email); $i < $len;  $i++){
            foreach($uncorrect_symbol as $symbol){
                if($this->email[$i] == $symbol){
                    $str = 'uncorrect_symbol in email';
                    return false;
                }
            }
        }
        $email = explode('@',$this->email);
        if(count($email)!=2 || strlen($email[0])<4){
            $str = 'email must contain @ and user_part contain more than 4 symbol';
            return false;
        }
        $user_part = explode('.',$email[0]);
        if(strlen($user_part[count($user_part)-1])<2){
            $str = 'Last part of the user_name must contain more than 2 symbol';
            return false;
        }
            
        $post_coord = explode('.',$email[1]);
        $len_last_part_coord = strlen($post_coord[count($post_coord)-1]);
        if(count($post_coord)<2 || !($len_last_part_coord>=2 && $len_last_part_coord<=4)){
            $str = 'post_coordination must contain more than 2 parts and<br> last part of the post_coordination must contain 2-4 symbols';
            return false; 
        }
        for($i = 0; $i<$len_last_part_coord; $i++){
                if(is_int($post_coord[count($post_coord)-1][$i])){
                    $str = 'last part of the post_coordination can"t contain digits ';
                    return false;
                }
        }
        return true;
    }
}

/*
 * Требования к email:
    Адрес должен содержать специальный символ "@", который отделяет имя пользователя почтовой системы от доменного имени;
    -Адрес не должен содержать символов "пробелов", ",", ":", ";", "!", "#", "%", "*", "(", ")", "=", "+", "{", "}", "[", "]/", """, "'", "/", "\" и "|";
    -Адрес должен состоять только из латинских символов;
    Так как в Интернете не существует компьютеров имеющих доменные имена первого уровня, то после символа "@" должна быть как минимум одна ".";
    После последней точки должно быть не менее 2-х и не более 4-х символов, причем наличие цифр не допускается;
    Между последней точкой и символом "@" должно быть не менее 2-х символов
    Слева от "@" должно быть не менее четырех символов.

 */