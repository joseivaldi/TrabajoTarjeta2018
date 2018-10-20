<?php

namespace TrabajoTarjeta;

use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {

    public function testNombre() {
    	$colectivo = new Colectivo("142 Rojo", "Semtur", 10);
    	$this->assertEquals($colectivo->linea(), "142 Rojo");
    }

    public function testPagarCon() {
    	$colectivo = new Colectivo("142 Rojo", "Semtur", 10);
    	$tarjetaJose = new Tarjeta();
    	$this->assertFalse($colectivo->pagarCon($tarjetaJose));

        $tarjetaJose->recargar(50);
        $boleto= $colectivo->pagarCon($tarjetaJose);
        $colectivo_del_boleto_pagado = $boleto->obtenerColectivo();
    	$this->assertEquals( $colectivo_del_boleto_pagado->linea() , $colectivo->linea() );

    }

    public function TestViajePlus() {
        $colectivo = new Colectivo("142 Rojo", "Semtur", 10);
        $tarjetaJose = new Tarjeta();

        $tarjetaJose->recargar(10);
        $this->assertEquals( ( ($colectivo->pagarCon($tarjetaJose) )->obtenerColectivo() )->linea() , $colectivo->linea() );
        $this->assertEquals( ( ($colectivo->pagarCon($tarjetaJose) )->obtenerColectivo() )->linea() , $colectivo->linea() );
        $this->assertFalse($colectivo->pagarCon($tarjetaJose));
        
        $tarjetaJose2 = new Tarjeta();
        $tarjetaJose2->recargar(10);
        $colectivo->pagarCon($tarjetaJose2);

        $tarjetaJose2->recargar(20);
        $colectivo->pagarCon($tarjetaJose2);
        $this->assertEquals($tarjetaJose2->obtenerSaldo, 0.4);
    }

}