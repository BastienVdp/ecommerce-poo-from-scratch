<?php 

namespace App\Core;

class Validation
{
    public static function validate($request, $rules): array
    {
        $errors = [];

        foreach ($rules as $key => $rule) {
            $rules = explode('|', $rule);

            foreach ($rules as $rule) {
                $rule = explode(':', $rule);

                switch ($rule[0]) {
                case 'required':
                    if (!isset($request->body[$key]) || $request->body[$key] === '') {
                        $errors[$key] = 'The ' . $key . ' field is required.';
                    }
                    break;
                case 'min':
                    if (strlen($request->body[$key]) < $rule[1]) {
                        $errors[$key] = 'The ' . $key . ' field must be at least ' . $rule[1] . ' characters.';
                    }
                    break;
                case 'max':
                    if (strlen($request->body[$key]) > $rule[1]) {
                        $errors[$key] = 'The ' . $key . ' field must be less than ' . $rule[1] . ' characters.';
                    }
                    break;
                case 'email':
                    if (!filter_var($request->body[$key], FILTER_VALIDATE_EMAIL)) {
                        $errors[$key] = 'The ' . $key . ' field must be a valid email address.';
                    }
                    break;
                case 'unique':
                    $explodeRule = explode(",", $rule[1]);

                    $model = 'App\\Models\\' . $explodeRule[0];
                    $column = $explodeRule[1];

                    $result = $model::find([$column => $request->body[$key]]);

                    if ($result) {
                        $errors[$key] = 'The ' . $key . ' field must be unique.';
                    }
                    break;
                case 'confirmed':
                    if ($request->body[str_replace('_confirmation', '', $key)] !== $request->body[$key]) {
                        $errors[$key] = 'The ' . $key . ' field confirmation does not match.';
                    }
                    break;
                case 'numeric':
                    if (!is_numeric((int)$request->body[$key])) {
                        $errors[$key] = 'The ' . $key . ' field must be a number.';
                    }
                    break;
                case 'image':
                    $allowedExtensions = explode(',', $rule[1]);
                    $extension = pathinfo($request->body[$key]['name'], PATHINFO_EXTENSION);

                    if (!in_array($extension, $allowedExtensions)) {
                        $errors[$key] = "The " . $key . " field must be a file of type: " . $rule[1];
                    }
                    break;
                }
            }
        }
        
        return $errors;
    }
}
