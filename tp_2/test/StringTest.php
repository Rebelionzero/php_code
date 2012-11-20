<?php
include_once(__DIR__.'/../autoloader.php');
class stringTest extends PHPUnit_Framework_TestCase  {

   function testSelect() {	
    $c = new string('usuario',5,true,'nombre',false,'content admin',2);
    $this->assertEquals('usuario', $parametros[0]);
    $this->assertEquals(5, $parametros[1]);
    $this->assertEquals(true, $parametros[2]);
    $this->assertEquals('nombre', $parametros[3]);
    $this->assertEquals(false, $parametros[4]);
    $this->assertEquals('content admin', $parametros[5]);
    $this->assertEquals(2, $parametros[6]);

    $c->select('*');
    $this->assertTrue($tipo == 'string');

    $c->select(array('id','nombreProducto'));
    $this->assertEquals( 2 , $cantidad );
    $c->select(array('id','tipoUsuario'));
    $this->assertTrue($tipo == 'array');
   }

   function testSave() {
        $save = new string('usuario',5,true,'nombre',false,'content admin',2);
        $save->save(array( 5, 2 , 'andres'));

        $this->assertTrue(gettype($parametros) == 'array');
        $this->assertTrue(gettype($parametros[0]) == 'string');
        $this->assertTrue(gettype($parametros[1]) == 'integer');
        $this->assertTrue(gettype($parametros[2]) == 'bool');
        $this->assertEquals('usuario', $parametros[0]);
        $this->assertEquals(2, $parametros[6]);
        $this->assertEquals(true, $parametros[2]);
   }
}

?>