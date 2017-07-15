<?php

class IndexController extends ControllerBase{
    public function indexAction()
    {
    	
    }
    function saveAction()
    {
    //si es una petición post
    	if ($this->request->isPost() == true) 
    	{
    		//creamos instancia del modelo users
    		$user = new Users();
    		//obtenemos los campos del formulario pasando los filtros que queremos
            $user->name = $this->request->getPost();
            $user->email = $this->request->getPost('email', array('striptags', 'email', 'trim'));
            $user->username = $this->request->getPost('username', array('striptags', 'alphanum', 'trim'));
            $user->password = $this->request->getPost('password', array('striptags', 'alphanum', 'trim'));
  			//si el usuario no se guarda mostramos los errores
	        if (!$user->save()) 
	        {
	            foreach ($user->getMessages() as $message) 
	            {
	                $this->flash->error($message);
	            }
	            //con forward mandamos a la acción index con los errores del formulario
	            return $this->dispatcher->forward(array("action" => "index"));
	        } 
	        //en otro caso mostramos un mensaje conforme se ha registrado y limpiamos los campos del formulario
	        else 
	        {
	        	$this->tag->setDefault('name', '');
            	$this->tag->setDefault('email', '');
            	$this->tag->setDefault('username', '');
            	$this->tag->setDefault('password', '');
	            $this->flash->success("Te has registrado correctamente.");
	            return $this->dispatcher->forward(array("action" => "index"));
	        }
        }
    }
}

