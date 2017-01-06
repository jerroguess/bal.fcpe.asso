<?php

/*
  --------------------------------------------------------------------
  class.bo.redirect.php
  --------------------------------------------------------------------
  Creator : X.ROUILLY 10/02/2015
  --------------------------------------------------------------------
  (c) 2013. All Rights Reserved.  FCPE
  --------------------------------------------------------------------
 */

class common_Redirect {

    private $connection;  ///<b>connect</b>		Connection SQL object

    /**
      boRedirect constructor inits everything related to Redirect.

      @param	connection		<b>connection</b>	Connection to bd
     */

    public function __construct($connection) {
        $this->connection = $connection;
    }

    /**
      Get URL by code.

      @param	strCode         Code
     */
    public function getUrl($strCode) {

        // Sélection de la localité.
        $strRequete = " SELECT url ";
        $strRequete .= " FROM `data_redirect` ";
        $strRequete .= " WHERE code='" . $strCode . "' LIMIT 1; ";
        $rdsRedirect = $this->connection->Execute($strRequete);

        if ($rdsRedirect->RecordCount() == 0){
            return "";
        }else{
            return $rdsRedirect->fields["url"];
        }
    }
    
    /**
      Add redirect.

      @param	strUrl                 URL
     */
    public function addRedirect($strUrl) {

        // Recuperation de l'ip de l'utilisateur meme si celui ci se trouve derriere un proxy.
        if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (isset($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        // Insertion de la redirection.
        $strRequeteInsertion = "INSERT INTO `data_redirect` (`id_redirect`, `code`, `url`, `date`, `ip`)";
        $strRequeteInsertion .= "VALUES( NULL, NULL, '" . $strUrl . "', NOW(), '" . $ip . "');";
        $rdsInsertion = $this->connection->Execute($strRequeteInsertion);
        $iIdRedirect = $this->connection->Insert_ID();
        
        // Mise à jour du code.
        $strRequeteMaj = "UPDATE `data_redirect` SET `code`='" . $this->dec2any($iIdRedirect) . "' WHERE `id_redirect`='" . $iIdRedirect . "' LIMIT 1 ;";
        $rdsMaj = $this->connection->Execute($strRequeteMaj);
       
        // Transfert du code.
        return $this->dec2any($iIdRedirect);
    }
    
    /**
      Custom > Decimal
     */
    private function any2dec( $num, $base=62, $index=false ) {
        if (! $base ) {
            $base = strlen( $index );
        } else if (! $index ) {
            $index = substr( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ", 0, $base );
        }
        $out = 0;
        $len = strlen( $num ) - 1;
        for ( $t = 0; $t <= $len; $t++ ) {
            $out = $out + strpos( $index, substr( $num, $t, 1 ) ) * pow( $base, $len - $t );
        }
        return $out;
    }
    
    /**
      Decimal > Custom
     */
    private function dec2any( $num, $base=62, $index=false ) {
        if (! $base ) {
            $base = strlen( $index );
        } else if (! $index ) {
            $index = substr( "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,0 ,$base );
        }
        $out = "";


        // this fix partially breaks when $num=0, but fixes the $num=238328 bug
        // also seems to break (adds a leading zero) at $num=226981 through $num=238327 *shrug*
        // for ( $t = floor( log10( $num ) / log10( $base - 1 ) ); $t >= 0; $t-- ) {

        // original code:
        for ( $t = floor( log10( $num ) / log10( $base ) ); $t >= 0; $t-- ) {
            $a = floor( $num / pow( $base, $t ) );
            $out = $out . substr( $index, $a, 1 );
            $num = $num - ( $a * pow( $base, $t ) );
        }
        return $out;
    }
}

?>