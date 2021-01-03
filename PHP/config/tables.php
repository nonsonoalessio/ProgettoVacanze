<?php 
namespace PHP\App\Config;
use PHP\App\Config\Database as DB;

return [

    'clienti' => [

            'nome' =>  DB::Varchar() . DB::NotNull(), 
            'cognome' => DB::Varchar() . DB::NotNull(),
            'data_di_nascita' => DB::Date() . DB::NotNull(),
            'codiceFiscale' => DB::Varchar() . DB::PrimaryKey(),
            'luogoNascita' => DB::Varchar() . DB::NotNull(),
            'sesso' => DB::Enum(['m' , 'f']) . DB::NotNull(),
            'immagine_documento_scannerizzato' => DB::Varchar(200) . DB::NotNull()

    ],     
    
    'piani' => [

        'id' => DB::Integer() . DB::PrimaryKey('auto'),
        'costo_base_stanza_24h' => DB::Integer() . DB::NotNull(),
        'giorno_pulizie' => DB::Enum(['lunedi' , 'martedi' , 'mercoledi', 'giovedi' , 'sabato' , 'domenica']),
    
    ],

    'stanze' => [

        'codiceStanza' => DB::Integer() . DB::PrimaryKey('auto'),
        'capienza_massima' => DB::Integer() . DB::NotNull(),
        'piano' => DB::Integer() . DB::NotNull(),
        
        "Foreign Key (piano)" => DB::ForeignKey('piani','id') 
        
    ],

    'dipendenti' => [

        'stipendio' => DB::Float() . DB::NotNull(),
        'id' => DB::Integer() . DB::PrimaryKey('auto'),
        'giorno_settimanale_festivo' => DB::Enum(['lunedi' , 'martedi' , 'mercoledi', 'giovedi' , 'sabato' , 'domenica']) . DB::NotNull(),
        'nome' => DB::Varchar() . DB::NotNull(),
        'cognome' => DB::Varchar() . DB::NotNull(),
        'email' => DB::Varchar() . DB::NotNull(),
        'data_inizio_turno' => DB::Timestamp() . DB::NotNull(),
        'data_fine_turno' => DB::Timestamp() . DB::NotNull()

    ],

    'prenotazioni' => [

        'codicePrenotazione' => DB::Integer() . DB::PrimaryKey('auto'),
        'effettuataDa' => DB::Varchar() . DB::NotNull(),
        'codiceStanza' => DB::Integer() . DB::NotNull(),
        'data_inizio_prenotazione' => DB::Timestamp() . DB::NotNull(),
        'data_fine_prenotazione' => DB::Timestamp() . DB::NotNull(),
        'costo_totale_da_pagare' => DB::Float() . DB::NotNull(),
        'prenotazionePresaDa' => DB::Integer() . DB::NotNull(),
        'mezzo_di_pagamento' => DB::Enum(['carta' , 'contanti']) . DB::NotNull(),
        
        'Foreign Key (effettuataDa)' => DB::ForeignKey('clienti','codiceFiscale'),
        'Foreign Key (codicestanza)' => DB::ForeignKey('stanze','codicestanza'),
        'Foreign Key (prenotazionePresaDa)' => DB::ForeignKey('dipendenti','id')

    ],

    'tracciamenti_economici_mensili' => [

        'id' => DB::Integer() . DB::PrimaryKey('auto'),
        'guadagno' => DB::Float() . DB::NotNull(),
        'spese' => DB::Float() . DB::NotNull(),
        'entrate_totali' => DB::Float() . DB::NotNull(),
        'mese' => DB::Enum([1,2,3,4,5,6,7,8,9,10,11,12]) . DB::NotNull(),
        'anno' => 'YEAR ' . DB::NotNull()

    ]










    
];



?>