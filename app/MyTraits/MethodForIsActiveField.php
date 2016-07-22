<?php
namespace App\MyTraits;

/**
 * Class MethodForIsActiveField
 * @package app\MyTraits
 * - This trait is used for extension for eloquent model to used for is_active field
 */
trait MethodForIsActiveField
{

    /**
     * query scope for is_active column
     * @param $query
     * @param bool|true $is_active
     * @return mixed
     */
    public function scopeActive($query, $is_active = true) {
        return $query->where('is_active', $is_active);
    }

    /**
     * Transfer is_active to word
     * @return string
     */
    public function isActiveDesc()
    {
        return $this->is_active ? 'Yes' : 'No';
    }
}