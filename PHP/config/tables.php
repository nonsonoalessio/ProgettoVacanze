<?php 
namespace PHP\App\Config;
use PHP\App\Config\Database as DB;

return [

    'clienti' => [

            'nome' =>  DB::Varchar(), 
            'cognome' => DB::Varchar(),
            'data_di_nascita' => DB::Date(),
            'codiceFiscale' => DB::Varchar() . DB::PrimaryKey(),
            'luogoNascita' => DB::Varchar(),
            'sesso' => DB::Enum(['m' , 'f']),
            'immagine_documento_scannerizzato' => DB::Varchar(200)

    ],        
    










    
];



?>