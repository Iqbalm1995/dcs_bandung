<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
        function add_months($months, DateTime $dateObject)
        {
            $next   = new DateTime($dateObject->format('Y-m-d'));
            $next->modify('last day of +'.$months.' month');

            if($dateObject->format('d') > $next->format('d')){
                return $dateObject->diff($next);
            }else{
                return new DateInterval('P'.$months.'M');
            }
        }

        function endCycle($d1, $months)
        {
            $date           = new DateTime($d1);
            $newDate        = $date->add(add_months($months, $date));

            $newDate->sub(new DateInterval('P1D'));
            $dateReturned   = $newDate->format('Y-m-d');
            return $dateReturned;
        }