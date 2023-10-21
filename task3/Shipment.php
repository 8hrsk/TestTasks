<?php

class Shipment {
    private $shipment;                                      // Здесь можем хранить данные о доставке

    public function createShipment($shipmentData) {
        $this->shipment = $shipmentData;
    }

    public function payShipment($credentials) {             // Здесь можно будет оплатить доставку
        // подключаем эквайринг, проверку доставки
        // $this->orderCost->pay($userCredentials);         // Оплата (через class Order)
        echo '<br> Shipment ' . $this->shipment . ' paid successfully! Thanks, ' . $credentials;
    }

    public function getShipmentCost($weight) {              // Тут можем поставить расчет стоимости доставки,
        // defaul cost counting                             // если следущий программист не указал её
    }
}