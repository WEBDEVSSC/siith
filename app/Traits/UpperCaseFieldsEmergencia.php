<?php

namespace App\Traits;

trait UpperCaseFieldsEmergencia
{
    /**
     * Convertir todos los campos de texto a mayúsculas antes de guardar
     */
    protected static function bootUpperCaseFieldsEmergencia()
    {
        static::saving(function ($model) {
            foreach ($model->getAttributes() as $key => $value) {
                if (is_string($value)) {
                    $model->{$key} = strtoupper($value);
                }
            }
        });
    }
}
