<?php

namespace app\models;

use \yii\db\ActiveRecord;

class t_book extends ActiveRecord
{
    public function attributeLabels()
    {
        return [
            'name' => '姓名',
            'author' => '作者',
            'desc' => '描述',
        ];
    }

    public function rules()
    {
        return [
            ['name', 'required'],
            ['author', 'required'],
            ['desc', 'required'],
        ];
    }
}

?>