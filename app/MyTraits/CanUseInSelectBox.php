<?php
namespace App\MyTraits;

/**
 * Class CanUseInSelectBox
 * @package app\MyTraits
 * - Used to extend eloquent model for creating data for textbox
 */

trait CanUseInSelectBox
{
    public static function getAllForSelectBox($key = 'id', $col = 'description', $orderby ='description')
    {
        $data = ['' => 'Please Select'];
        foreach (self::orderBy($orderby)->get() as $v) {
            $data[$v->$key] = $v->$col;
        }
        return $data;
    }
}