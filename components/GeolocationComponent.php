<?php

namespace app\components;

use Dadata\DadataClient;
use app\models\City;
use yii\base\Component;
use yii\helpers\Html;

/**
 *
 * @property-read mixed $city
 */
class GeolocationComponent extends Component {
    public function init() {
        parent::init();
        return null;
    }

    public function getCity() {
        $token = "4ffe29813ad9f908905e230f3f1b9ea7f96a476b";
        $secret = "ef2b8c507125f23231f71dfca6f42bfcef0e40a8";
        $dadata = new DadataClient($token, $secret);
        //$response = $api->iplocate(Yii::$app->getRequest()->getUserIP());
        $response = $dadata->iplocate('46.226.227.20');
        return $response['value'];
    }

    public function inputCity($input) {
        $token = "4ffe29813ad9f908905e230f3f1b9ea7f96a476b";
        $secret = "ef2b8c507125f23231f71dfca6f42bfcef0e40a8";
        $dadata = new DadataClient($token, $secret);
        $result = $dadata->suggest("address", $input);
        if (is_integer($input)) {
            return $input;
        }
        else {
            $echo = $result['0'];
            $echo = $echo['data'];
            return $echo['city'];
        }
    }

}