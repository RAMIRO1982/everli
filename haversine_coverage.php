<?php

function coverage($location, $shoppers)
{
    foreach($shoppers as $shopper)
    {
        $distance = haversine($location->lat, $location->lng, $shopper->lat, $shopper->lng);
        
        if($distance < 10)
        {
            $corverage[] = [
                'shopper_id' => $shopper->id,
                'coverage' => $distance * 100
            ];
        }
    }

    return $corverage ?? [];
}