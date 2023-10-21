<?php

/*
    Возможно, я немного не так понял ТЗ к этой задаче, но я мыслил в этом ключе, опустив некоторые детали
*/

require './DHL.php';
require './russianPost.php';


$dhl = new DHL();
$russianPost = new russianPost();

$weightDHL = $dhl->generateWeight();
echo 'Вес посылки DHL: ' . $weightDHL . 'кг<br>';
echo 'DHL ' . $dhl->getShipmentCost($dhl->generateWeight()) . ' руб';
$dhl->createShipment('DHL');
$dhl->payShipment('Ruslan');

echo '<br><br>';

$weightRP = $russianPost->generateWeight();
echo 'Вес посылки Почта России: ' . $weightRP . 'кг<br>';
echo 'Russian ' . $russianPost->getShipmentCost($weightRP) . ' руб';
$russianPost->createShipment('Russian');
$russianPost->payShipment('Ruslan');

/* 

тут по середине где-то ещё затерялся order

желательно должна быть конструкция вроде 
$myShipment = new Shipment();

$myShipment->createShipment($shipmentData);

$myShipment->getShipmentCost();
! Внутри $shipmentData ы передаем и вес,
! считываем его в отельнов классе с данныи заказа, возвращаем myShipment и даем клиенту стоймость оставки

$myShipment->payShipment();

*/