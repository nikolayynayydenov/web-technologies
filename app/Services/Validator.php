<?php

namespace App\Services;

use \Exception;

class Validator
{
    /**
     * @var array Initial data
     */
    protected $data;

    /**
     * @var array Validated data
     */
    public $validated;

    public $errors = [];

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param array $rules
     */

    public function str_starts_with($string, $official_string){
        $cnt=0;
        for($i=0; $i<mb_strlen($string); $i++){
            if($string[$i]==$official_string[$i]){
                $cnt++;
            }
        }
        if($cnt==mb_strlen($string)){
            return true;
        }
        else{
            return false;
        }
    }

    public function validate(array $columns)
    {
        foreach ($columns as $column => $rules) {
            if (!array_key_exists($column, $this->data)) {
                $this->errors[] = "Полето $column не присъства в заявката";
                break;
            }

            $value = $this->data[$column];

            foreach ($rules as $rule) {

                if ($rule === 'required') {
                    if ($value === '') {
                        $this->errors[] = "Полето $column е задължително";
                    }
                } else if ($rule === 'time') {
                    if (!preg_match('/\d{2}:\d{2}:\d{2}/', $value)) {
                        $this->errors[] = "Полето $column трябва да е във формат xx:xx:xx";
                    }
                } else if ($rule === 'date') {
                    if (!preg_match('/\d{4}-\d{2}-\d{2}/', $value)) {
                        $this->errors[] = "Полето $column трябва да е във формат xx-xx-xx";
                    }
                } else if (str_starts_with($rule, 'minLen')) {
                    $segments = explode(':', $rule);
                    if (count($segments) !== 2) {
                        throw new Exception('Invalid rule min');
                    }

                    if (mb_strlen($value) < intval($segments[1])) {
                        $this->errors[] = "Полето $column трябва да е с минимална дължина " . $segments[1];
                    }
                } else if (str_starts_with($rule, 'maxLen')) {
                    $segments = explode(':', $rule);
                    if (count($segments) !== 2) {
                        throw new Exception('Invalid rule min');
                    }
                    
                    if (mb_strlen($value) > intval($segments[1])) {
                        $this->errors[] = "Полето $column трябва да е с максимална дължина " . $segments[1];
                    }
                } else if (str_starts_with($rule, 'min')) {
                    // For numeric values
                    $segments = explode(':', $rule);
                    if (count($segments) !== 2) {
                        throw new Exception('Invalid rule min');
                    }

                    if (!is_numeric($value)) {
                        $this->errors[] = "Полето $column трябва да е с числена стойност " . $segments[1];
                    }

                    if (intval($value) < intval($segments[1])) {
                        $this->errors[] = "Полето $column трябва да е с минимална стойност " . $segments[1];
                    }
                } else if (str_starts_with($rule, 'max')) {
                    $segments = explode(':', $rule);
                    if (count($segments) !== 2) {
                        throw new Exception('Invalid rule min');
                    }

                    if (!is_numeric($value)) {
                        $this->errors[] = "Полето $column трябва да е с числена стойност " . $segments[1];
                    }

                    if (intval($value) > intval($segments[1])) {
                        $this->errors[] = "Полето $column трябва да е с м максимална стойност " . $segments[1];
                    }
                } elseif (str_starts_with($rule, 'before')) {
                    $segments = explode(':', $rule);

                    if (count($segments) !== 2) {
                        throw new Exception('Invalid rule before');
                    }

                    if (strtotime($value) > strtotime($this->data[$segments[1]])) {
                        $this->errors[] = "Полето $column трябва да е по-ранен час от " . $segments[1];
                    }
                } else {
                    throw new Exception('Invalid rule: ' . $rule);
                }
            }

            $this->validated[$column] = $value;
        }
    }

    /**
     * @return bool
     */
    public function isValid()
    {
        return count($this->errors) === 0;
    }
}
