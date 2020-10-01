<?php
/**
 * Created by PhpStorm.
 * User: Motiur
 * Date: 12/6/2018
 * Time: 10:40 AM
 */

namespace App\Shopping;


use Illuminate\Support\Facades\Session;

class Lol
{


    public function __construct()
    {

    }


    public static function add($id, $qnt, $price)
    {
        Session::push('items', [
            'product_id' => $id,
            'product_quantity' => $qnt,
            'product_price' => $price,
        ]);
        return "Added";
    }

    public static function removeAll()
    {
        Session::flush('items');
    }

    public static function remove($id)
    {
        $items = Session::get('items');
        unset($items[1]);
       /* foreach ($items as $item) {
            if ($id == $item['product_id']) {
                unset($item);
                echo"got it";
            }
        }*/
        return Session::get('items');
    }

    public static function count()
    {

        return count(Session::get('items'));
    }

    public static function getItem()
    {

        return Session::get('items');

    }

}