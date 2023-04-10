<?php




class tienda
{

    public $view;
    public $header;

    public function __construct()
    {
        $this->view = 'principal';
    }

    public function principal()
    {
        $this->view = 'principal';
    }
}
