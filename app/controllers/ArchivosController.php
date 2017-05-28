<?php

class ArchivosController extends ControllerBase
{

    public function indexAction()
    {
        parent::limpiar();
        
        //cargar lista de clientes para autocomplete
        $data = "";
        $usuarios = Clientes::find("admin = 0");
        foreach ($usuarios as $u) {
            $data = $data."$u->nombre - $u->codigo;";
        }
        $data = substr($data, 0, strlen($data)-1);
        
        $campos = [
            ["t", ["cliente"], "Cliente"],
            ["h", ["id"], ""],
            ["h", ["listClientes"], $data],
            ["f", ["archivo"], "Archivo"],
            ["s", ["guardar"], "Guardar"]
        ];/*
        $head = ["Nombre", "Cuenta", "Saldo", "Tel&eacute;fono","Direcci&oacute;n", "Acciones"];
        $tabla = parent::thead("bancos", $head);
        $bancos = Bancos::find();
        foreach ($bancos as $r){
            $tabla = $tabla.parent::tbody([
                $r->nombre,
                $r->telefono,
                $r->direccion,
                parent::a(2, "cargarDatos('".$r->id."','".$r->nombre."','".$r->telefono."','".$r->cuenta."','".$r->saldo."','".$r->direccion."','".$r->direccion."');", "Editar")." | ".
                parent::a(1, "bancos/eliminar", "Eliminar", [["id", $r->id]])
            ]);
        }

        //js
        $fields = ["id", "nombre", "telefono", "direccion", "cuenta", "saldo"];
        $otros = "";
        $jsBotones = ["form1", "bancos/edit", "bancos"];
		
    	$tabla = parent::ftable($tabla);*/
        $form = parent::multiForm($campos, "archivos/subir", "form1");
    	parent::view("Asignar Archivos a Usuarios", $form);//, $tabla, [$fields, $otros, $jsBotones]);
    }
    
    public function guardarAction(){
    	if(parent::vPost("nombre")){
    		$bancos = new Bancos();
    		$bancos->nombre = parent::gPost("nombre");
    		$bancos->telefono = parent::gPost("telefono");
    		$bancos->direccion = parent::gPost("direccion");
    		$bancos->cuenta = parent::gPost("cuenta");
    		$bancos->saldo = parent::gPost("saldo");
    		if($bancos->save()){
    			parent::msg("Banco creado exitosamente", "s");
    		}else{
    			parent::msg("Ocurri&oacute; un error durante la operaci�n");
    		}
    	}else{
    		parent::msg("El campo nombre no puede quedar en blanco");
    	}
    	parent::forward("bancos", "index");
    }
    
    public function eliminarAction(){
    	$bancos = Bancos::findFirst("id = ".parent::gReq("id"));
    	$cheques = Cheques::find(array("banco = $bancos->id"));
    	if(count($cheques) > 0){
    		parent::msg("No se puede eliminar un Banco que tenga asociado uno o m&aacute;s cheques", "w");
    	}else {
    		$nBancos = $bancos->nombre;    		 
    		if($bancos->delete()){
    			parent::msg("Se elimin&oacute; el Banco: $nBancos", "s");
    		}else{
    			parent::msg("","db");
    		}
    	}    	
    	parent::forward("bancos", "index");
    }

    public function editAction(){
    	if(parent::vPost("id")){
    		$bancos = Bancos::findFirst("id = ".parent::gPost("id"));
    		$bancos->nombre = parent::gPost("nombre");
    		$bancos->telefono = parent::gPost("telefono");
    		$bancos->direccion = parent::gPost("direccion");
    		$bancos->cuenta = parent::gPost("cuenta");
    		$bancos->saldo = parent::gPost("saldo");
    		if($bancos->update()){
    			parent::msg("Banco modificado exitosamente", "s");
    		}else{
    			parent::msg("Ocurri&oacute; un error durante la operaci&oacute;n");
    		}
    	}else{
    		parent::msg("Ocurri&oacute; un error al cargar los Bancos");
    	}
    	parent::forward("bancos", "index");
    }
}

