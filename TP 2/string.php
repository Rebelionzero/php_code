<?php
	class string {
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

		public function select(){
			$parametros = func_get_args();
			foreach ($parametros as $parametro => $valor) {
				if(gettype($valor) != string){
					echo 'no es string <br />';
					echo $valor.'<br />';
				}else{
					
				}
			}
			/*if(){
				echo 'todo bien';
			}else{				
				echo gettype($parametros);
			}*/

		}
		public function save(){}
	}

//$d = new string(5,true,'nombre',false,'content admin',2,'usuario' );
$c = new string('usuario',5,true,'nombre',false,'content admin',2);
print_r('<br />');
$c->select('asd','46546',5,array(),4.3,false,'hola',32);

?>