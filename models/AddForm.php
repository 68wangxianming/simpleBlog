<?php

namespace app\models;

use yii\base\Model;

class AddForm extends Model
{
    public $name;
    public $author;

    /*重写label*/
    public function attributeLabels()
    {
        return [
            'name' => '姓名',
            'author' => '作者'
        ];
    }

    /*校验规则重写*/
    public function rules()
    {
        return [
            ['name', 'required'],
            ['author', 'required'],
        ];
    }

}