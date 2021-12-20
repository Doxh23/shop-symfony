<?php


namespace App\Classe;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;



use Symfony\Component\HttpFoundation\RequestStack;




class Cart
{
private $RequestStack;
private $EntityManager;

public function __construct(RequestStack $RequestStack ,EntityManagerInterface $EntityManager)
{
    $this->RequestStack = $RequestStack;
    $this->EntityManager = $EntityManager;
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
public function decrease($id){
    $session = $this->RequestStack->getSession();
    $cart = $session->get('cart',[]);
if($cart[$id] > 1){
$cart[$id]--;
}else{
    unset($cart[$id]);

}
return $session->set('cart',$cart);

}
public function getfull() {
    $cartComplete = [];
    if($this->get()){
    foreach($this->get() as $id => $quantity){
        $productobject =$this->EntityManager->getRepository(Product::class)->findOneById($id);
        if (!$productobject){
            $this->delete($id);
            continue;
        }
        $cartComplete[] = [
            'product' => $productobject,
            'quantity' => $quantity
        ];
}
}else{
    
}
return $cartComplete;
}

};

?>