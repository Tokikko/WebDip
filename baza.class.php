<?php


class baza {
    
    const server = "localhost";
    const baza = "WebDiP2013_073";
    const korisnik = "WebDiP2013_073";
    const lozinka = "admin_mbndsse";
    
     function spojiBaza(){
        
        $mysqli = new mysqli(self::server, self::korisnik,  self::lozinka, self::baza);
        
        if ($mysqli->connect_errno){
            echo "Neuspješno spajanje na bazu: {$mysqli->connect_errno}, {$mysqli->connect_error}";
        }
        
        return $mysqli;
    }
    
     function selectUpit($upit){
    
        $veza = self::spojiBaza();
        $rezultat = $veza->query($upit) or 
            trigger_error("Greška kod upita: {$upit} - Greška: ".$veza->error.''.E_USER_ERROR);

       if(!$rezultat){
           $rezultat = null;
       }
       
       return $rezultat;
    }
    
    function ostaliUpiti($upit){
    
        $veza = self::spojiBaza();
      
        if($rezultat = $veza->query($upit)){
            //PREKIDANJE VEZE            
        } else {
            echo "Pogreška: ".$veza->error;
        }
        
        return $rezultat;
    }
    
    static function prekidVeze($mysqli){
        $mysqli ->close();
    }
}

?>
