<?php

class Usuario
{
    private $id_usuario;
    private $nombre;
    private $direccion;
    private $correo;
    private $tipo;
    private $contraseña;

    public function __construct($id_usuario, $nombre, $direccion, $correo, $tipo, $contraseña)
    {
        $this->id_usuario = $id_usuario;
        $this->nombre = $nombre;
        $this->direccion = $direccion;
        $this->correo = $correo;
        $this->tipo = $tipo;
        $this->contraseña = $contraseña;
    }

    public function getIdUsuario()
    {
        return $this->id_usuario;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getContraseña()
    {
        return $this->contraseña;
    }
}
