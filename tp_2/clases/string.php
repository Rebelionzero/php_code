<?php
include_once(__DIR__.'/../autoloader.php');
include_once('/../interfaces/Istring.php');
	class string implements Istring{
		var $string = array();

		public function __construct(){
			$data = func_get_args();
			if( is_bool(($resultado = $this->validate($data))) ){
				// true				
				$this->string = array(
					'tabla' => $data[0],
					'campos' => array(
						'id' => array('tipo' => $data[1],'pk' => $data[2]),
						'nombre' => array('tipo' => $data[3], 'pk' => $data[4]),
						'tipoUsuario' => array('tipo' => $data[5], 'values' =>$data[6])
					)
				);				
			}else{
				// false
				var_dump($resultado);
			}
		}

		function validate($array){
			$validacion = array(
				'tabla'		 => ((!is_string($array[0])) ? 'Error: el campo tabla debe ser un string' : true),
				'id'		 => ((!is_numeric($array[1])) ? 'Error: el id debe ser un numero' : true),
				'primary key'=> ((!is_bool($array[2])) ? 'Error: debe establecer si quiere que sea una clave primaria con un booleano' : true),
				'nombre'	 => ((!is_string($array[3])) ? 'Error: el nombre debe ser un string' : true),
				'nombrepk'	 => ((!is_bool($array[4])) ? 'Error: debe establecer si quiere que sea una clave primaria con un booleano' : true),
				'tipoUsuario'=> ((!is_string($array[5])) ? 'Error: el tipo de usuario debe ser un string' : true),
				'values'	 => ((!is_numeric($array[6])) ? 'Error: el valor de usuario debe ser un numero' : true)
			);

			$errores = array();
			foreach($validacion as $valor => $item){
				if(is_bool($item)){
					continue;
				}else{
					array_push($errores,$item);
				}
			}
			if(count($errores) > 0){return $errores;}else{return true;}
		}

		public function select($parametros){
			$tipo = gettype($parametros);
			if($tipo != 'string' && $tipo != 'array'){
				echo 'Error: solo se permiten arrays o strings como parametros';
			}else{
				if($tipo == 'string'){
					if($parametros != '*'){
						echo 'Error: si ingresa un solo valor, este debe ser un string que obligatoriamente sea &#34;*&#34;';
					}else{
						// consulta exitosa
						echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
						echo '<p>SELECT * from '.$this->string["tabla"].'</p>';
					}
				}elseif($tipo == 'array'){
					$largo_array = count($parametros);
					if($largo_array != 2){
						echo 'Error: debe ingrsar solo 2 parametros en el array';
					}else{
						if($parametros[0] != 'id'){
							echo 'Error: el primer parametro debe ser &#34;id&#34;';
						}else{
							if($parametros[1] == 'tipoUsuario'){
								echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
								echo '<p>SELECT id, tipoUsuario from '.$this->string["tabla"].'</p>';
							}elseif($parametros[1] == 'nombreProducto'){
								// excepcion
							}
						}
					}
				}
			}
		}
		
		public function save($array){
			$cantidad = count($array);
			$errores = array();
			if (gettype($array) != 'array') {
				echo 'Error: solo puede ingresar un array como parametro';
			}else{
				if ($cantidad == 3){
					// revisar que los 3 parametros sean correctos
					if (!array_key_exists('id',$array)) {
						echo 'Error: las clave id del array debe estar presente';
					} else {
						if(!array_key_exists('tipoUsuario',$array)) {
							echo 'Error: las clave tipoUsuario del array debe estar presente';
						}else{
							if(!array_key_exists('nombre',$array)) {
								echo 'Error: las clave nombre del array debe estar presente';
							}else{
								
								$validacion = array(
									'id'			 => ((!is_numeric($array['id'])) ? 'Error: el primer campo debe ser un numero' : true),
									'tipoUsuario'	 => ((!is_numeric($array['tipoUsuario'])) ? 'Error: el segundo campo debe ser un numero' : true),
									'nombre'		 => ((!is_string($array['nombre'])) ? 'Error: el tercer campo debe ser un string' : true)
								);
								
								foreach ($validacion as $llave => $valor) {
									if($valor){continue;}else{echo('<p>'.$valor.'</p>');array_push($errores, true);}
								}

								if (!count($errores) > 0) {
									if ($array['id'] != $this->string['campos']['id']['tipo']) {
										echo 'Error: El id ingresado no corresponde con ninguno de la base de datos';
									}else{
										// exito
										echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
										echo '<p>UPDATE usuario SET tipoUsuario=&#34;'.$array['tipoUsuario'].'&#34;,nombre=&#34;'.$array['nombre'].'&#34; WHERE id=&#34;'.$array['id'].'&#34;</p>';
									}
								}
							}
						}
					}
				}	
			
				if ($cantidad == 2){					
					// revisar que los 2 parametros sean correctos
					if(!array_key_exists('tipoUsuario',$array)){
						echo 'Error: las clave tipoUsuario del array debe estar presente';
					}else{
						if(!array_key_exists('nombre',$array)){
							echo 'Error: las clave nombre del array debe estar presente';
						}else{
							$validacion = array(						
								'tipoUsuario'		 => ((!is_numeric($array['tipoUsuario'])) ? 'Error: el primer campo debe ser un numero' : true),
								'nombre'			 => ((!is_string($array['nombre'])) ? 'Error: el segundo campo debe ser un string' : true)
							);
							
							foreach ($validacion as $llave => $valor) {
								if($valor){continue;}else{echo('<p>'.$valor.'</p>');array_push($errores, true);}
							}
							
							if (!count($errores) > 0) {
								// exito
								echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
								echo '<p>INSERT INTO usuario VALUES( null , '.$array['tipoUsuario'].' , "'.$array['nombre'].'" )</p>';
							}else{
								var_dump($errores);
							}
						}
					}
				}
			}
		}
	}

//$d = new string(5,true,'nombre',false,'content admin',2,'usuario' );
$c = new string('usuario',5,true,'nombre',false,'content admin',2);
//$c->select('*');
//$c->select(array('id','ad'));
//$c->save(array('id' => 5, 'tipoUsuario' => 2, 'nombre' => 'juan'));
$c->save(array('tipoUsuario' => 2, 'nombre' => 'juan'));
