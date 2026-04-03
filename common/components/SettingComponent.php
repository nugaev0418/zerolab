<?php
namespace common\components;

use common\models\Setting;

class SettingComponent
{
    private $_model;

    public function get()
    {
        if ($this->_model === null) {
            $this->_model = Setting::findOne(1);
        }
        return $this->_model;
    }
}