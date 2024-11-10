<?php

function arrotondaUscita($datetime, $rounding, $bonus) {
    
    // convert to dateTime
    if (!($datetime instanceof DateTime)) {
        
        $datetime = new DateTime($datetime);
    }
    
    // get minutes from dateTime
    $minutes = (int) $datetime->format('i');
    
    // calculate rounded time
    $previousRoundedMinutes = floor($minutes / $rounding) * $rounding;
    
    // calculate next rounded time
    $nextRoundedMinutes = $previousRoundedMinutes + $rounding;
    
    // apply bonus for exit rounding
    if ($minutes >= $nextRoundedMinutes - $bonus) {
        // round up if in the bonus range of the next interval
        $roundedMinutes = $nextRoundedMinutes;
    } else {
        // otherwise round down to the previous interval
        $roundedMinutes = $previousRoundedMinutes;
    }
    
    // case where rounded minutes are more than 60
    if ($roundedMinutes >= 60) {
        $roundedMinutes -= 60;
        $datetime->modify('+1 hour');
    }
    
    // set new rounded time
    $datetime->setTime((int)$datetime->format('H'), $roundedMinutes, 0);
    
    return $datetime;
}

?>