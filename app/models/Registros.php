<?php

class Registros extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var string
     */
    public $id;

    /**
     *
     * @var string
     */
    public $transaccion;

    /**
     *
     * @var string
     */
    public $ticket;

    /**
     *
     * @var string
     */
    public $fechaentra;

    /**
     *
     * @var string
     */
    public $horaentra;

    /**
     *
     * @var string
     */
    public $fechasale;

    /**
     *
     * @var string
     */
    public $horasale;

    /**
     *
     * @var string
     */
    public $tiempo;

    /**
     *
     * @var string
     */
    public $tarjetano;

    /**
     *
     * @var string
     */
    public $bascula;

    /**
     *
     * @var string
     */
    public $bascula2;

    /**
     *
     * @var string
     */
    public $actividad;

    /**
     *
     * @var string
     */
    public $descActividad;

    /**
     *
     * @var string
     */
    public $almacen;

    /**
     *
     * @var string
     */
    public $descAlmacen;

    /**
     *
     * @var string
     */
    public $producto;

    /**
     *
     * @var string
     */
    public $descProducto;

    /**
     *
     * @var string
     */
    public $categoria;

    /**
     *
     * @var double
     */
    public $pesoin;

    /**
     *
     * @var double
     */
    public $pesoout;

    /**
     *
     * @var double
     */
    public $pesoneto;

    /**
     *
     * @var string
     */
    public $cliente;

    /**
     *
     * @var string
     */
    public $vehiculo;

    /**
     *
     * @var string
     */
    public $motorista;

    /**
     *
     * @var string
     */
    public $descMotorista;

    /**
     *
     * @var string
     */
    public $transportista;

    /**
     *
     * @var string
     */
    public $descTransportista;

    /**
     *
     * @var string
     */
    public $codbuque;

    /**
     *
     * @var string
     */
    public $buque;

    /**
     *
     * @var string
     */
    public $envioingenio;

    /**
     *
     * @var string
     */
    public $envioalmapac;

    /**
     *
     * @var string
     */
    public $viajecepa;

    /**
     *
     * @var string
     */
    public $boletacepa;

    /**
     *
     * @var double
     */
    public $pesocepa;

    /**
     *
     * @var string
     */
    public $tipocarga;

    /**
     *
     * @var string
     */
    public $observaciones;

    /**
     *
     * @var string
     */
    public $usuario;

    /**
     *
     * @var string
     */
    public $semaforo;

    /**
     *
     * @var string
     */
    public $semaforo2;

    /**
     *
     * @var string
     */
    public $semaforo3;

    /**
     *
     * @var string
     */
    public $semaforo4;

    /**
     *
     * @var string
     */
    public $estatus;

    /**
     *
     * @var string
     */
    public $salida;

    /**
     *
     * @var string
     */
    public $codfactor;

    /**
     *
     * @var double
     */
    public $factor1;

    /**
     *
     * @var double
     */
    public $factor2;

    /**
     *
     * @var double
     */
    public $factor3;

    /**
     *
     * @var double
     */
    public $pesocliente;

    /**
     *
     * @var double
     */
    public $equivalencia;

    /**
     *
     * @var string
     */
    public $ticketgranel;

    /**
     *
     * @var string
     */
    public $ticketensacado;

    /**
     *
     * @var string
     */
    public $almacen2;

    /**
     *
     * @var string
     */
    public $descAlmacen2;

    /**
     *
     * @var string
     */
    public $ticketlimpieza;

    /**
     *
     * @var string
     */
    public $codigounidad;

    /**
     *
     * @var string
     */
    public $ordenretiro;

    /**
     *
     * @var string
     */
    public $tipocamion;

    /**
     *
     * @var string
     */
    public $tipocamionr;

    /**
     *
     * @var double
     */
    public $pesoreal;

    /**
     *
     * @var string
     */
    public $usuariosale;

    /**
     *
     * @var string
     */
    public $usuariomod;

    /**
     *
     * @var string
     */
    public $registro;

    /**
     *
     * @var string
     */
    public $dobleticket;

    /**
     *
     * @var string
     */
    public $ticketenano;

    /**
     *
     * @var double
     */
    public $disponible;

    /**
     *
     * @var string
     */
    public $fechabarco;

    /**
     *
     * @var string
     */
    public $fechabarco2;

    /**
     *
     * @var double
     */
    public $pesoinv1;

    /**
     *
     * @var double
     */
    public $pesoinv2;

    /**
     *
     * @var string
     */
    public $remision;

    /**
     *
     * @var string
     */
    public $mercancia;

    /**
     *
     * @var string
     */
    public $licencia;

    /**
     *
     * @var string
     */
    public $contenedor;

    /**
     *
     * @var double
     */
    public $bultos;

    /**
     *
     * @var string
     */
    public $documentos;

    /**
     *
     * @var string
     */
    public $fechaTemp;

    /**
     *
     * @var double
     */
    public $temperatura;

    /**
     *
     * @var string
     */
    public $basculaEntrada;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->belongsTo('cliente', 'Clientes', 'id', array('alias' => 'Clientes'));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'registros';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Registros[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Registros
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

}
