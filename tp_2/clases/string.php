<?php
include_once(__DIR__.'/../autoloader.php');
include_once('/../interfaces/Istring.php');
	class string implements Istring{
		var $string = array();

		public function __construct(){
			$data = func_get_args();
			if( is_bool(($resultado = $this->validate($data))) ){
				// bool				
				$this->string = array(
					'tabla' => $data[0],
					'campos' => array(
						'id' => array('tipo' => $data[1],'pk' => $data[2]),
						'nombre' => array('tipo' => $data[3], 'pk' => $data[4]),
						'tipoUsuario' => array('tipo' => $data[5], 'values' =>$data[6])
					)
				);				
			}else{
				// array
				var_dump($resultado);
			}
		}

		function validate($array){
			$validacion = array(
				'tabla'		 => ((!is_string($array[0])) ? '<p>Error: el campo tabla debe ser un string</p>' : false),
				'id'		 => ((!is_numeric($array[1])) ? '<p>Error: el id debe ser un numero</p>' : false),
				'primary key'=> ((!is_bool($array[2])) ? '<p>Error: debe establecer si quiere que sea una clave primaria con un booleano</p>' : false),
				'nombre'	 => ((!is_string($array[3])) ? '<p>Error: el nombre debe ser un string</p>' : false),
				'nombrepk'	 => ((!is_bool($array[4])) ? '<p>Error: debe establecer si quiere que sea una clave primaria con un booleano</p>' : false),
				'tipoUsuario'=> ((!is_string($array[5])) ? '<p>Error: el tipo de usuario debe ser un string</p>' : false),
				'values'	 => ((!is_numeric($array[6])) ? '<p>Error: el valor de usuario debe ser un numero</p>' : false)
			);

			$errores = array();
			foreach($validacion as $valor => $item){
				if(is_bool($item)){
					continue;
				}else{
					array_push($errores,$item);
				}
			}
			if(count($errores) > 0){return $errores;}else{return false;}
		}

		public function select($parametros){
			$tipo = gettype($parametros);
			if($tipo != 'string' && $tipo != 'array'){
				echo '<p>Error: solo se permiten arrays o strings como parametros</p>';
			}else{
				if($tipo == 'string'){
					if($parametros != '*'){
						echo '<p>Error: si ingresa un solo valor, este debe ser un string que obligatoriamente sea &#34;*&#34;</p>';
					}else{
						// consulta exitosa
						echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
						echo '<p>SELECT * FROM '.$this->string["tabla"].'</p>';
					}
				}elseif($tipo == 'array'){
					$largo_array = count($parametros);
					if($largo_array != 2){
						echo '<p>Error: debe ingrsar solo 2 parametros en el array</p>';
					}else{
						if($parametros[0] != 'id'){
							echo '<p>Error: el primer parametro debe ser &#34;id&#34;</p>';
						}else{
							if($parametros[1] == 'tipoUsuario'){
								echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
								echo '<p>SELECT id, tipoUsuario FROM '.$this->string["tabla"].'</p>';
							}elseif($parametros[1] == 'nombreProducto'){
								// excepcion
								try{
     							   throw new Exception('<p>Sera lanzada una excepcion como consulta</p>');
    							}catch (Exception $e){
        							echo $e->getMessage();
        							echo '<p>SELECT id, nombreProducto FROM '.$this->string["tabla"].'</p>';
    							}
							}
						}
					}
				}
			}
		}
		
		public function save($array){
			$cantidad = count($array);
			$errores = array();
			$errores2 = array();

			if (gettype($array) != 'array') {
				echo '<p>Error: solo puede ingresar un array como parametro</p>';
			}else{
				if ($cantidad == 3){
					// revisar que los 3 parametros sean correctos
					if (!array_key_exists('id',$array)) {
						echo '<p>Error: las clave id del array debe estar presente</p>';
					} else {
						if(!array_key_exists('tipoUsuario',$array)) {
							echo '<p>Error: las clave tipoUsuario del array debe estar presente</p>';
						}else{
							if(!array_key_exists('nombre',$array)) {
								echo '<p>Error: las clave nombre del array debe estar presente</p>';
							}else{
								
								$validacion = array(
									'id'			 => ((!is_numeric($array['id'])) ? '<p>Error: el primer campo debe ser un numero</p>' : false),
									'tipoUsuario'	 => ((!is_numeric($array['tipoUsuario'])) ? '<p>Error: el segundo campo debe ser un numero</p>' : false),
									'nombre'		 => ((!is_string($array['nombre'])) ? '<p>Error: el tercer campo debe ser un string</p>' : false)
								);
								
								foreach ($validacion as $llave => $valor) {
									if($valor == false){continue;}else{echo($valor);array_push($errores, $valor);}
								}

								if (!count($errores) > 0) {
									if ($array['id'] != $this->string['campos']['id']['tipo']) {
										echo '<p>Error: El id ingresado no corresponde con ninguno de la base de datos</p>';
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
						echo '<p>Error: las clave tipoUsuario del array debe estar presente</p>';
					}else{
						if(!array_key_exists('nombre',$array)){
							echo '<p>Error: las clave nombre del array debe estar presente</p>';
						}else{							
							$validacion = array(						
								'tipoUsuario'		 => (!is_numeric($array['tipoUsuario']) ? $string = '<p>Error: el primer campo debe ser un numero</p>' : false),
								'nombre'			 => (!is_string($array['nombre']) ? $string = '<p>Error: el segundo campo debe ser un string</p>' : false)
							);
							
							foreach ($validacion as $llave => $vl) {
								if($vl == false){
									//echo 'es igual a true';
									//echo $vl;
									continue;
								}else{									
									echo($vl);
									array_push($errores2,$vl);									
								}
							}
							
							if (!count($errores2) > 0) {
								// exito
								echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
								echo '<p>INSERT INTO usuario VALUES( null , '.$array['tipoUsuario'].' , "'.$array['nombre'].'" )</p>';
							}else{
								var_dump($errores2);
							}
						}
					}
				}
			}
		}
	}


$c = new string('usuario',5,true,'nombre',false,'content admin',2);
$c->select('*');
$c->select(array('id','tipoUsuario'));
$c->select(array('id','nombreProducto'));
$c->save(array('id' => 5, 'tipoUsuario' => 2, 'nombre' => 'juan'));
$c->save(array('tipoUsuario' => 2, 'nombre' => 'juan'));


/* fallidos con proposito de code coverage 100% */
$d = new string(5,true,'nombre',false,'content admin',2,'usuario');
$c->select(5);
$c->select('5');
$c->select(array('ad','id','tipoUsuario'));
$c->select(array('ad','tipoUsuario'));
$c->save('string');
$c->save(array('ad' => 5, 'tipoUsuario' => 2, 'nombre' => 'juan'));
$c->save(array('id' => 5, 'Usuario' => 2, 'nombre' => 'juan'));
$c->save(array('id' => 5, 'tipoUsuario' => 2, 'name' => 'juan'));
$c->save(array('id' => 17, 'tipoUsuario' => 2, 'nombre' => 'juan'));
$c->save(array('Usuario' => 2, 'nombre' => 'juan'));
$c->save(array('tipoUsuario' => 2, 'name' => 'juan'));
$c->save(array('tipoUsuario' => false, 'nombre' => null));