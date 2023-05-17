<?php

namespace App\Traits;

trait CreatedBy
{
    protected static function bootCreatedBy()
    {
        static::creating(function ($model) {
            if (!$model->created_by) {
                $model->created_by = auth()->check() ? auth()->id() : null;
            }
        });
    }

    public function checkOwner() {
        return $this->created_by == (auth()->check() ? auth()->id() : null);
    }
}
