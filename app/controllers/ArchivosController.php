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
            ["h", ["codigo"], ""],
            ["h", ["listClientes"], $data],
            ["f", ["archivo"], "Archivo"],
            ["s", ["guardar"], "Guardar"]
        ];
        
        //crear tabla de usuarios y cantidad de archivos subidos
        $head = ["C&oacute;digo", "Nombre", "Usuario", "Cant. Archivos", "Acciones"];
        $tabla = parent::thead("tusuarios", $head);
        foreach ($usuarios as $u){
            
            //cant archivos
            $arc = Archivos::find("cliente = $u->id");
            
            $tabla = $tabla.parent::tbody([
                $u->codigo,
                $u->nombre,
                $u->usuario,
                count($arc),
                parent::a(1, "archivos/docs/$u->id", "Listar archivos")
            ]);
        }

        $tabla = parent::ftable($tabla);
        $form = parent::multiForm($campos, "archivos/subir", "form1");
    	parent::view("Asignar Archivos a Usuarios", $form, $tabla);//, $tabla, [$fields, $otros, $jsBotones]);
    }
    
    public function subirACtion(){
        $texto = "";
        if(parent::vPost("cliente")){
            //Verificar primero el archivo
            //Phalcon upload file
            if (true == $this->request->hasFiles() && $this->request->isPost()) {
                $archive = new Archivos();
                $codigo = substr(parent::gPost("cliente"), strpos(parent::gPost("cliente"), " - ")+3);
                $texto = $codigo;
                $cliente = Clientes::findFirst("codigo like '$codigo'");
                $archive->cliente = $cliente->id;
                $archive->fsubida = parent::fechaHoy(true);
                
                $upload_dir = APP_PATH . '\\public\\excel\\'. "$cliente->id\\" ;

                foreach ($this->request->getUploadedFiles() as $file) {
                    if(strlen($file->getName()) > 0){
                        $archive->nombre = substr($file->getName(), 0,strpos($file->getName(), "."));
                        $archive->url = $file->getName();
                        if(!file_exists($upload_dir)){
                            mkdir($upload_dir);
                        }
                        $file->moveTo($upload_dir . $archive->url);    					
                    }    				
                }
                if($archive->save()){
                    parent::msg("Archivo fue subido exitosamente", "s");
                }else{
                    parent::msg($codigo);
                    parent::msg("","db");
                }
            }else{
                parent::msg("No se encontr&oacute; archivo para subirse");
            }
            
        }else{
            parent::msg("Debe seleccionarse un cliente existente");
        }
        return parent::forward("archivos", "index");
    }
    
    public function docsAction($id)
    {
    
        //tabla de archivos del usuario
        $cliente = Clientes::findFirst("id = $id");
        $upload_dir = APP_PATH . '\\public\\excel\\'. "$cliente->id\\" ;
        $head = ["Corr.", "Nombre Archivo", "Tama&ntilde;o", "F. Subida", "Descargas", "Acciones"];
        $tabla = parent::thead("tarchivos", $head);
        $archivos = Archivos::find("cliente = $id");
        $corr = 1;
        foreach ($archivos as $a){
            $tabla = $tabla.parent::tbody([
                $corr,
                $a->nombre,
                parent::FileSizeConvert($upload_dir.$a->url),
                parent::mysqlDate($a->fsubida),
                $a->descargas,
                parent::a(1, "archivos/descargar/$a->id", "Descargar")." | ".
                parent::a(1, "archivos/eliminar/$a->id", "Eliminar")
            ]);
            $corr++;
        }

        $tabla = parent::ftable($tabla);
        //$form = parent::multiForm($campos, "archivos/subir", "form1");
        $this->view->regresar = parent::a(1, "archivos/index", "Regresar");
    	parent::view("Archivos de $cliente->nombre - $cliente->codigo", "", $tabla);        
    }
    
    public function eliminarAction($id)
    {
        $archivo = Archivos::findFirst("id = $id");
        $nombre = $archivo->nombre;
        $cliente = $archivo->cliente;
        $url = APP_PATH . '\\public\\excel\\'."$cliente\\$archivo->url";
        
        if($archivo->delete()){
            //elminar archivo
            if(unlink($url)){
                parent::msg("Archivo eliminado exitosamente", "s");
            }else{
                parent::msg("Registro se elimin&oacute; pero el archivo f&iacute;sico no se pudo eliminar", "w");
            }
        }else{
            parent::msg("","db");
        }
        parent::forward("archivos", "docs", ["$cliente"]);
    }
    
    public function descargarAction($id){
        $this->view->disable();
        $archivo = Archivos::findFirst("id = $id");
        $cliente = $archivo->cliente;
        $url = APP_PATH . '\\public\\excel\\'."$cliente\\$archivo->url";
        parent::download($archivo->url, $url);
    }
    
    public function archivosUsuarioAction($id)
    {
    
        //tabla de archivos del usuario
        $cliente = Clientes::findFirst("id = $id");
        $upload_dir = APP_PATH . '\\public\\excel\\'. "$cliente->id\\" ;
        $head = ["Corr.", "Nombre Archivo", "Tama&ntilde;o", "F. Subida", "Descargar"];
        $tabla = parent::thead("tarchivos", $head);
        $archivos = Archivos::find("cliente = $id");
        $corr = 1;
        foreach ($archivos as $a){
            $tabla = $tabla.parent::tbody([
                $corr,
                $a->nombre,
                parent::FileSizeConvert($upload_dir.$a->url),
                parent::mysqlDate($a->fsubida),
                parent::a(1, "archivos/descargarUser/$a->id", "Descargar")
            ]);
            $corr++;
        }

        $tabla = parent::ftable($tabla);
        //$form = parent::multiForm($campos, "archivos/subir", "form1");
        //$this->view->regresar = parent::a(1, "archivos/index", "Regresar");
    	parent::view("Archivos", "", $tabla);        
    }
    
    public function descargarUserAction($id){
        $this->view->disable();
        $archivo = Archivos::findFirst("id = $id");
        $cliente = $archivo->cliente;
        //agregar 1 a la descarga
        $archivo->descargas = $archivo->descargas+1;
        $archivo->update();
        $url = APP_PATH . '\\public\\excel\\'."$cliente\\$archivo->url";
        parent::download($archivo->url, $url);
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

