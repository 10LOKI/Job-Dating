<?php
namespace App\core;

class Validation
{
    private static $errors = [];

    public static function validate(array $data, array $rules) {
        self::$errors = []; // Réinitialise les erreurs

        foreach ($rules as $field => $fieldRules) {
            // On sépare les règles par le caractère "|"
            $rulesArray = explode('|', $fieldRules);

            foreach ($rulesArray as $rule) {
                $params = [];
                
                // Gestion des règles avec paramètres comme "min:8"
                if (strpos($rule, ':') !== false) {
                    list($rule, $paramValue) = explode(':', $rule);
                    $params = [$paramValue];
                }

                $value = $data[$field] ?? null;

                // Appel dynamique de la méthode de validation
                if (!method_exists(self::class, $rule)) {
                    continue; // Saute si la règle n'existe pas
                }

                if (!self::$rule($value, ...$params)) {
                    self::$errors[$field][] = "The field {$field} failed the {$rule} validation.";
                }
            }
        }

        return empty(self::$errors);
    }

    public static function getErrors() {
        return self::$errors;
    }

    // --- Tes méthodes existantes (adaptées) ---

    public static function required($value) {
        return isset($value) && !empty(trim($value));
    }

    public static function email($value) {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function min($value, $min) {
        return mb_strlen(trim($value ?? '')) >= (int)$min;
    }
}