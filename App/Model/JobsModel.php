<?php
namespace Worktest\Model;

use Worktest\Model\BaseModel;

class JobsModel extends BaseModel
{
    protected $tableName = "tmpjobs";

    public $validates = [
        'email' => FILTER_VALIDATE_EMAIL,
        'author' => FILTER_SANITIZE_STRING,
        'text' => FILTER_SANITIZE_STRING,
        'status' => FILTER_SANITIZE_NUMBER_INT,

    ];
    public $validates_errors = [
        'email' => 'Некорректное поле email',
        'author' => 'Некорректное поле Автор',
        'text' => 'Некорректное поле Текст',
    ];

    public function createFromPost($data)
    {
        $data['status'] = 0;
        return parent::createFromPost($data);
    }
}
