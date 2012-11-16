<?php

/**
 * Function to Sort Array
 * @param $a The Array to Sort
 * @param &b The Fields to Sort
 */
function array_sort_func($a,$b=NULL) { 
   static $keys; 
   if($b===NULL) return $keys=$a; 
   foreach($keys as $k) { 
      if(@$k[0]=='!') { 
         $k=substr($k,1); 
         if(@$a[$k]!==@$b[$k]) { 
            return strcmp(@$b[$k],@$a[$k]); 
         } 
      } 
      else if(@$a[$k]!==@$b[$k]) { 
         return strcmp(@$a[$k],@$b[$k]); 
      } 
   } 
   return 0; 
} 

function array_sort(&$array) { 
   if(!$array) return $keys; 
   $keys=func_get_args(); 
   array_shift($keys); 
   array_sort_func($keys); 
   usort($array,"array_sort_func");        
}

function cmp($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a < $b) ? -1 : 1;
}
function cmp2($a, $b)
{
    if ($a == $b) {
        return 0;
    }
    return ($a > $b) ? -1 : 1;
}