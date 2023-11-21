<?php
namespace App\Helpers;
/**
 * Generates a random from array.
 *
 * @param int[]|string[] $randomElementArray 
 * @return int|string
 */
if (!function_exists('randomElementOfArray')) {
    function randomElementOfArray($randomElementArray) {
        $randomKey = array_rand($randomElementArray);
        return $randomElementArray[$randomKey];
     }
} 



?>