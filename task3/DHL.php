<?php

require_once './Shipment.php';

class DHL extends Shipment {
    private $DHLServiceData;


    public function getShipmentCost($weight) {
        return $weight * 100;
    }

    public function generateWeight() { // просто для разнообразия
        return rand(1, 100);
    }
}