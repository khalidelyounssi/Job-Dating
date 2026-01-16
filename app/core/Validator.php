<?php
namespace App\Core;

use App\Core\Database;

class Validator {

    private $errors = [];

    public function validate(array $data, array $rules) {
        $this->errors = [];

        foreach ($rules as $field => $ruleString) {
            $rulesArray = explode('|', $ruleString);

            foreach ($rulesArray as $rule) {
                $params = explode(':', $rule);
                $ruleName = $params[0];
                $ruleValue = $params[1] ?? null;
                
                $value = $data[$field] ?? null;
                
                if (method_exists($this, $ruleName)) {
                    $this->$ruleName($field, $value, $ruleValue, $data);
                }
            }
        }

        return empty($this->errors);
    }

    private function required($field, $value, $param) {
        if (empty(trim($value)) && $value !== '0') {
            $this->errors[$field][] = "Le champ {$field} est requis.";
        }
    }

    private function email($field, $value, $param) {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $this->errors[$field][] = "L'email n'est pas valide.";
        }
    }

    private function min($field, $value, $min) {
        if (strlen($value) < (int)$min) {
            $this->errors[$field][] = "Le champ {$field} doit contenir au moins {$min} caractères.";
        }
    }

    private function max($field, $value, $max) {
        if (strlen($value) > (int)$max) {
            $this->errors[$field][] = "Le champ {$field} ne peut pas dépasser {$max} caractères.";
        }
    }

    private function unique($field, $value, $table) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT id FROM {$table} WHERE {$field} = ?");
        $stmt->execute([$value]);
        
        if ($stmt->fetch()) {
            $this->errors[$field][] = "Ce {$field} est déjà utilisé.";
        }
    }

    private function confirmed($field, $value, $param, $data) {
        $confirmField = $field . '_confirm'; 
        if (isset($data[$confirmField]) && $value !== $data[$confirmField]) {
            $this->errors[$field][] = "Les mots de passe ne correspondent pas.";
        }
    }

   public function getErrors() {
        return $this->errors;
    }
}