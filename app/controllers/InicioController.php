<?php
class InicioController extends ControllerBase
{

	public function indexAction()
	{
		$user = parent::gSession("usuario");
		$u = Clientes::findFirst("id = $user");
		$titulo = "Bienvenid@ $u->nombre";
		parent::view($titulo);
	}
	
}