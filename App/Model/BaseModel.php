<?php
namespace Worktest\Model;

use Worktest\Core\Config;

class BaseModel
{
    protected $mysqlConection;
    protected $tableName;
    public $validates = [

    ];

    public $validates_errors = [

    ];
    public $validates_errors_result = [];
    public $sanitized_data = [];
    public $lastError;
    public function __construct()
    {
        $this->mysqlConection = new \MysqliDb(Config::$mysql_options['host'], Config::$mysql_options['username'], Config::$mysql_options['password'], Config::$mysql_options['database']);

    }
    public function find($id)
    {
        $this->mysqlConection->where('id', $id);
        return $this->mysqlConection->getOne($this->tableName);
    }
    public function updateFromPost($id, $data)
    {
        $this->mysqlConection->where('id', $id);
        $result = filter_var_array($data, $this->validates, false);
        $op = $this->mysqlConection->update($this->tableName, $result);
        if (!$op) {
            $this->lastError = $this->mysqlConection->getLastError();
        }

        return $op;
    }
    public function getList($page, $recordsPerPage = 20, $sorting = null)
    {
        $this->mysqlConection->pageLimit = $recordsPerPage;
        if ($sorting && count($sorting)) {
            foreach ($sorting as $key => $value) {
                if (isset($this->validates[$key])) {
                    $s = 'desc';
                    if ($value == 1) {
                        $s = 'asc';
                    }

                    $this->mysqlConection->orderBy($key, $s);
                }
            }
        }

        return ['data' => $this->mysqlConection->arraybuilder()->paginate($this->tableName, $page),
            'totalPages' => $this->mysqlConection->totalPages,
        ];
    }

    public function validate($data)
    {
        $result = filter_var_array($data, $this->validates, false);
        $errors = [];
        foreach ($result as $key => $value) {
            if ($value === false) {
                $errors[$key] = $this->validates_errors[$key] ?? 'Ошибка валидации';
            }
        }
        $this->sanitized_data = $result;
        $this->validates_errors_result = $errors;
        return count($this->validates_errors_result) == 0;
    }
    public function createFromPost($data)
    {
        $result = filter_var_array($data, $this->validates, false);
        $id = $this->mysqlConection->insert($this->tableName, $result);
        if (!$id) {
            $this->lastError = $this->mysqlConection->getLastError();
        }

        return $id;
    }
}
