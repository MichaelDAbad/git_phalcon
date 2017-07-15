<?php
class Users extends Phalcon\Mvc\Model{
    //antes de pasar a la base de datos  encriptamos la contraseña 
    public function afterValidationOnCreate()
    {
        $security = new Phalcon\Security();
        $this->password = $security->hash($this->password);
    }
    //@desc - personalizamos los mensajes para cada caso
    public function getMessages($filter = NULL)
    {
        $messages = array();
        foreach (parent::getMessages() as $message){
            switch ($message->getType()){
                case 'PresenceOf':
                    $messages[] = 'El campo ' . $message->getField() . ' es obligatorio.';
                    break;
            }
        }
        return $messages;
    }
}