<?php

// enum to define if arrotondaOrario() is rounding entry or exit
enum TipoArrotondamento: string {
    
    case INGRESSO = 'ingresso';
    case USCITA = 'uscita';
}

/**
 * Arrotonda l'orario fornito in base a un valore di arrotondamento e un bonus opzionale.
 *
 * La funzione arrotonda un oggetto DateTime al valore più vicino in base a un intervallo specificato.
 * Se il valore del bonus è attivato, l'orario viene arrotondato al prossimo intervallo se
 * ci si trova entro un margine specificato.
 *
 * @param DateTime $datetime L'orario da arrotondare. Può essere un oggetto DateTime o una stringa valida per il costruttore DateTime.
 * @param int $rounding Il valore di arrotondamento in minuti. Definisce a quale intervallo il tempo deve essere arrotondato (es. 15 per arrotondare a blocchi di 15 minuti).
 * @param int $bonus Il margine di minuti per decidere se arrotondare verso l'alto o verso il basso. Se il tempo corrente è entro questo margine dal prossimo intervallo, si arrotonda verso l'alto.
 * @param TipoArrotondamento $tipo Il tipo di arrotondamento da applicare in base a ingresso o uscita.
 *
 * @return DateTime L'orario arrotondato come oggetto DateTime.
 */
function arrotondaOrario(DateTime $datetime, int $rounding, int $bonus, TipoArrotondamento $tipo): DateTime {
    
    // validate input types
    if (!in_array($rounding, [0, 2, 5, 6, 10, 12, 15, 20, 30])) {
        
        throw new InvalidArgumentException("Rounding must be one of the following values: 0, 2, 5, 6, 10, 12, 15, 20, 30.");
    }
    
    if ($bonus < 0 || $bonus > 60) {
        
        throw new InvalidArgumentException("Bonus must be between 0 and 60.");
    }
    
    // get minutes from datetime
    $minutes = (int) $datetime->format('i');
    
    // calculate rounded time
    $previousRoundedMinutes = floor($minutes / $rounding) * $rounding;
    
    // calculate next rounded time
    $nextRoundedMinutes = $previousRoundedMinutes + $rounding;
    
    // apply bonus for entry or exit based on type
    if ($tipo === TipoArrotondamento::INGRESSO) {
        // entry rounding
        $diff = $minutes - $previousRoundedMinutes;
        
        if ($diff > $bonus) {
            
            $roundedMinutes = $nextRoundedMinutes;
        } else {
            $roundedMinutes = $previousRoundedMinutes;
        }
        
    } elseif ($tipo === TipoArrotondamento::USCITA) {
        // exit rounding
        if ($minutes >= $nextRoundedMinutes - $bonus) {
            
            $roundedMinutes = $nextRoundedMinutes;
        } else {
            
            $roundedMinutes = $previousRoundedMinutes;
        }
    }
    
    // case where rounded minutes >= 60
    if ($roundedMinutes >= 60) {
        
        $roundedMinutes -= 60;
        $datetime->modify('+1 hour');
    }
    
    // set new rounded time
    $datetime->setTime((int)$datetime->format('H'), $roundedMinutes, 0);
    
    return $datetime;
}

?>
