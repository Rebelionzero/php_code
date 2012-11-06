<?php

class Teststring extends PHPUnit_Framework_TestCase  {
   
   function testSelect() {
    $select = new string('usuario',5,true,'nombre',false,'content admin',2);
    $select->select('*');
    $this->assertTrue($tipo == 'string');

    $select->select(array('id','tipoUsuario'));
    $this->assertTrue($tipo == 'array');
    $this->assertEquals(2, count($parametros));
    $this->assertTrue($parametros[0] == 'id');
    $this->assertTrue($parametros[1] == 'tipoUsuario');
   }

   function testSave() {
    $ave = new string('usuario',5,true,'nombre',false,'content admin',2);
    $save->save(array( 5, 2 , 'andres' ));
    $this->assertTrue(gettype($parametros) == 'array');
    $this->assertTrue(gettype($parametros[0]) == 'integer');
    $this->assertTrue(gettype($parametros[1]) == 'integer');
    $this->assertTrue(gettype($parametros[2]) == 'string');
    $this->assertEquals(5, $parametros[0]);
    $this->assertEquals(2, $parametros[1]);
    $this->assertEquals('andres', $parametros[2]);
   }
}

?>