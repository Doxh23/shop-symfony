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

$cart = $session->get('cart',[]);
if (!empty($cart[$id])){
    $cart[$id]++;
}else{
    $cart[$id] = 1;
};
$session->set('cart',$cart);
// $session->set('cart',[
//     [
//         'id'=> $id,
//         'quantity' => 1
//     ]
//     ]);
}

public function get() {
    $session = $this->RequestStack->getSession();

   return $session->get('cart');

}
public function remove() {
    $session = $this->RequestStack->getSession();

   return $session->remove('cart');

}
public function delete($id) {

    $session = $this->RequestStack->getSession();

    $cart = $session->get('cart',[]);
    unset($cart[$id]);
    return $session->set('cart',$cart);
    

}

};

?>