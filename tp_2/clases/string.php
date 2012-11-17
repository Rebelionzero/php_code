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


		private function validate($array){
			$validacion = array(
				'tabla'		 => ((!is_string($array[0])) ? 'el campo tabla debe ser un string' : true),
				'id'		 => ((!is_numeric($array[1])) ? 'el id debe ser un numero' : true),
				'primary key'=> ((!is_bool($array[2])) ? 'debe establecer si quiere que sea una clave primaria con un booleano' : true),
				'nombre'	 => ((!is_string($array[3])) ? 'el nombre debe ser un string' : true),
				'nombrepk'	 => ((!is_bool($array[4])) ? 'debe establecer si quiere que sea una clave primaria con un booleano' : true),
				'tipoUsuario'=> ((!is_string($array[5])) ? 'el tipo de usuario debe ser un string' : true),
				'values'	 => ((!is_numeric($array[6])) ? 'el valor de usuario debe ser un numero' : true)
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
				echo 'solo se permiten arrays o strings como parametros';
			}else{
				if($tipo == 'string'){
					if($parametros != '*'){
						echo 'si ingresa un solo valor, este debe ser un string que obligatoriamente sea &#34;*&#34;';
					}else{
						// consulta exitosa
						echo '<p>Se realizar&aacute; la siguiente consulta:</p>';
						echo '<p>SELECT * from '.$this->string["tabla"].'</p>';
					}
				}elseif($tipo == 'array'){
					$largo_array = count($parametros);
					if($largo_array != 2){
						echo 'debe ingrsar solo 2 parametros en el array';
						// continuar aca
					}	
				}
			}

			/*foreach ($parametros as $parametro => $valor) {
				if(gettype($valor) != 'string'){					
					echo $valor.' no es string <br />';					
				}else{
					if($valor != '*' && $valor != 'id' && $valor != 'tipoUsuario'){
						echo '<p>los valores ingresados son incorrectos, solo se permiten: &#34;*&#34;, &#34;id&#34; y &#34;tipoUsuario&#34;</p>';
					}else{
						echo '<p>Bien hecho!!!</p>';
					}
				}
			}*/			

		}
		public function save(){}
	}

//$d = new string(5,true,'nombre',false,'content admin',2,'usuario' );
$c = new string('usuario',5,true,'nombre',false,'content admin',2);
$c->select('*');

?>