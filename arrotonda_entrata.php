<?php

function arrotondaEntrata($datetime, $rounding, $bonus) {
    
    // convert to dateTime
    if (!($datetime instanceof DateTime)) {
        
        $datetime = new DateTime($datetime);
    }
    
    // get minutes from dateTime
    $minutes = (int) $datetime->format('i');
    
    // calculate rounded time
    $roundedMinutes = floor($minutes / $rounding) * $rounding;
    
    // calculate diff between minutes and rounded time
    $diff = $minutes - $roundedMinutes;
    
    // apply bonus for entry rounding
    if ($diff > $bonus) {
        
        $roundedMinutes += $rounding;
    }
    
    // case where rounded minutes are less than 0
    if ($roundedMinutes >= 60) {
        
        $roundedMinutes = 0;
        $datetime->modify('+1 hour');
    }
    
    // set new rounded time
    $datetime->setTime((int)$datetime->format('H'), $roundedMinutes, 0);
    
    return $datetime;
}

?>