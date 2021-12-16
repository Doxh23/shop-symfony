<?php


namespace App\Classe;

use Symfony\Component\HttpFoundation\RequestStack;




class Cart
{
private $RequestStack;

public function __construct(RequestStack $RequestStack)
{
    $this->RequestStack = $RequestStack;
}
public function add($id){


$session = $this->RequestStack->getSession();

$session->set('cart',[
    [
        'id'=> $id,
        'quantity' => 1
    ]
    ]);
}

public function get() {
    $session = $this->RequestStack->getSession();

    dd($session->get('cart'));

}
};

?>