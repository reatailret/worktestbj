<?php
namespace Worktest\Model;

use Worktest\Core\Config;
/**
 * Base class for models
 */
class BaseModel
{
    /**
     * Instance of MysqliDb - mysqli wraper
     * https://github.com/ThingEngineer/PHP-MySQLi-Database-Class
     * @var [type]
     */
    protected $mysqlConection;

    /**
     * Table name 
     *
     * @var string
     */
    protected $tableName;

    /**
     * Key-val pairs for filter_var_array
     * Kyes are model fields
     * @var array
     */
    public $validates = [

    ];

    /**
     * Validation errors
     * 
     * Store the validation errors after validate call;
     *
     * @var array
     */
    public $validates_errors_result = [];

    /**
     * Sanitized data
     * 
     * Store the sanitized data after validate call;
     *
     * @var array
     */
    public $sanitized_data = [];

    /**
     * Last error after DB query
     *
     * @var [type]
     */
    public $lastError;

    public function __construct()
    {
        $this->mysqlConection = new \MysqliDb(Config::$mysql_options['host'], Config::$mysql_options['username'], Config::$mysql_options['password'], Config::$mysql_options['database']);

    }

    /**
     * Find record by id
     *
     * @param int $id
     * @return array
     */
    public function find($id)
    {
        $this->mysqlConection->where('id', $id);
        return $this->mysqlConection->getOne($this->tableName);
    }

    /**
     * Update record from array
     *
     * @param int $id
     * @param array $data
     * @return bool
     */
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

    /**
     * Get records with pagination
     *
     * @param integer $page
     * @param integer $recordsPerPage
     * @param array $sorting
     * @return void
     */
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

    /**
     * Validate array
     *
     * @param array $data
     * @return bool
     */
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

    /**
     * Create record from array
     *
     * @param array $data
     * @return boolean|int
     */
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
