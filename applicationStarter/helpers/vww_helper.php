<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    // valid_email    
    function valid_email( $email ) {
        // Remove all illegal characters from email
        $email 										=	trim($email) ;
        $email 										= 	filter_var($email, FILTER_SANITIZE_EMAIL);

        // Validate e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false)  {
             // echo("$email is a valid email address");
             return TRUE ;

        } else  {
            // echo("$email is not a valid email address");
            return FALSE ;
        }	       
    }  
    //-----/valid_email


	/**
	 * format_datum_1($geef_datum) 
	 *
	 * Returns date 
	 *	yyyy-mm-dd
	 *
	 * @access	public
	 * @param	date human 
	 * @return	date
	 */	
	 function format_datum_1($geef_datum_1) {
         //
			$jaar  = substr($geef_datum_1,6,4);
			$maand = substr($geef_datum_1,3,2);
			$dag   = substr($geef_datum_1,0,2);

		return($jaar.'-'.$maand.'-'.$dag);
	}
	//-----/format_datum_1
	

	/**
	 * format_datum_2($geef_datum) 
	 *
	 * Returns date 
	 *	dd-mm-yyyy
	 *
	 * @access	public
	 * @param	date mysql 
	 * @return	date human
	 */	
	function format_datum_2($geef_datum_2) {
        //
			$jaar  = substr($geef_datum_2,0,4);
			$maand = substr($geef_datum_2,5,2);
			$dag   = substr($geef_datum_2,8,2);

		return( $dag .'-'. $maand .'-'. $jaar );
	}
	//-----/format_datum_2
	

	/**
	 * datum_nu
	 *
	 * Returns date 
	 *	dd-mm-yyyy
	 *
	 * @access	public
	 */	
	function datum_nu() {
		//
		$datestring 				= "%d-%m-%Y" ; 
		$time 						= time();			
		
		return date($datestring, $time);
		//-----/
	}
	//-----/datum_nu

	
	/**
	 * datum_nu2
	 *
	 * Returns date 
	 *	yyyy-mm-dd 
	 *
	 * @access	public
	 */	
	function datum_nu2() {
        //
			$datestring 				= "%Y-%m-%d" ; 
			$time 						= time();			
			return mdate($datestring, $time);
	}
	//-----/datum_nu2
    
    
    //  leesbareTijd
    //  -   $tijd
    function leesbareTijd( $tijd )
    {
        $tijdA      =   explode(":", $tijd) ;
        
        return $tijdA['0'] .':'. $tijdA['1'] ;
    }
	//-----/leesbareTijd
    

    //  rapportVww    
    //  rapportVww( __FILE__ , __LINE__ , 'De code is zover gekomen omdat..' ) ;
    function rapportVww($file, $line, $message)
    {
        //       
        if(isset($_POST)) {
            //
            $bert = print_r($_POST, TRUE);

        }  else {
            //
            $bert = 'no post array';
        }
        
        if(isset($_SESSION)) {
            //
            $sid = print_r($_SESSION, TRUE);

        } else {	
            //
            $sid = 'no session array';
        }

        $time = Gmdate("H:i j-M-Y");
        
        // full report
        $longstring =  $time .'-'. $file .'-'. $line .':'. $message .': POST array:'.  $bert .'SESSION array:'.  $sid ;

        // short report 
        $shortstring =  $file .' - '.  $line .': '.  $message ;


        // set $action to 'long' if you want to log long error report 
        // set $action to 'short' if you want to log short error report 
        $action  =  'short';        
       
        if( $action == 'long' ) {	
            //
            log_message('error', $longstring);

        } elseif( $action == 'short' ) {	
            //
            log_message('error', $shortstring);
        }
        //-----/    
    }     
    //-----/rapportVww
    
    
    //  alle_post
    //  echo alle_post( $_POST ) ;
    //  die() ;
    function alle_post( $post) {
        //
        $output     =       '' ;
        
        //	$this->post->input
        foreach( $post as $k => $v ) 
        {	
            $output  .= '$'.$k.' &nbsp; = &nbsp; $this->input->post(\''.$k.'\', TRUE) ;<br />'."\n";	
        }
        //-----/$this->post->input

        $output  .= '<br /><br />'."\n" ;	        
        
        
        //	$this->post->input
        foreach( $post as $k => $v ) 
        {	
            $output  .= '$'. $k .' &nbsp; = &nbsp; '. $v .'<br />'."\n";	
        }
        //-----/$this->post->input        
        
        
        
        $output  .= '<br /><br />'."\n" ;			
        
        //	database
        foreach ($_POST as $k => $v) 
        {	
            if( $k <> 'submit')
            {
                $output  .= '$this->db->set(\''.$k.'\', $'.$k.' ) ; '."<br />\n";
            }		
        }
        //-----/database
			
		// $output  .= '<br />'."\n" ;
		// $output  .= '<br />'."\n" ;        
        
        
        return $output ;
        //-----/
    }
    //-----/alle_post
    
    
    //  leesbaar_to_mysql
    //  -   $datum    
	function leesbaar_to_mysql($datum = '')
	{
        //
        $datumArray                                 =  explode("-", $datum);
        
        //
        $dag                                        =  $datumArray[0];
        $maand                                      =  $datumArray[1];
        $jaar                                       =  $datumArray[2];
      
        //
        $datumTmp       =       $jaar .'-'. $maand .'-'. $dag ;      
      
        //
		return $datumTmp;
        
        //-----/
	}
    //-----/leesbaar_to_mysql   
    
    
    //  unix_to_leesbaar
    //  -   $time    
	function unix_to_leesbaar($time = '')
	{
		$r = date('d', $time) .'-'. date('m', $time) .'-'. date('Y', $time) ;
      
		return $r;
	}
    //-----/unix_to_leesbaar
    
    
    //  leesbaar_to_unix
    //  -   $datum    
	function leesbaar_to_unix( $datum )
	{
        //
        $datumArray                                 =  explode("-", $datum);
        
        //
        $dag                                        =  $datumArray[0];
        $maand                                      =  $datumArray[1];
        $jaar                                       =  $datumArray[2];
        
        //
        $datumTmp                                   =   $jaar .'-'. $maand .'-'. $dag ;
        
        //
        return  mysql_to_unix( $datumTmp ) ;
        //-----/
	}    
    //-----/leesbaar_to_unix
    
    
    //  unix_to_mysql
    //  -   $time
	function unix_to_mysql( $time = '')
	{
		$r = date('Y', $time) .'-'. date('m', $time) .'-'. date('d', $time) ;
      
		return $r;
	}
    //-----/unix_to_mysql
    
    
    //  unix_to_mysqlExt
    //  -   $time
	function unix_to_mysqlExt( $time = '')
	{
		$r = date('Y', $time) .'-'. date('m', $time) .'-'. date('d', $time) .' '. date('H', $time) .':'.  date('i', $time) .':'.  date('s', $time) ;
      
		return $r;
	}
    //-----/unix_to_mysqlExt    
    
    
    //  geefJaar
    //  -   $datum    
    function geefJaar( $datum )
    {
        $datumA     =   explode("-", $datum) ;
        
        return $datumA['0'] ; 
    }
    //-----/geefJaar 

    
    //  geefMaand
    //  -   $datum    
    function geefMaand( $datum )
    {
        $datumA     =   explode("-", $datum) ;
        
        return $datumA['1'] ; 
    }
    //-----/geefMaand
 
    
    //  geefDag
    //  -   $datum
    function geefDag( $datum )
    {
        $datumA     =   explode("-", $datum) ;
        
        return $datumA['2'] ; 
    }
    //-----/geefDag
    
    
    //  geefNlDag
    //  -   $day
    //  -   $hoofdletter
    function geefNlDag( $day, $hoofdletter=NULL )
    {
        //
        $output     =       '' ; 
        
        if( 'Monday'  ==  $day )
        {
           $output     .= 'maandag' ;
        }
        elseif( 'Tuesday'  ==  $day )
        {
            $output     .= 'dinsdag' ;
        }
        elseif( 'Wednesday'  ==  $day )
        {
            $output     .= 'woensdag' ;
        }
        elseif( 'Thursday'  ==  $day )
        {
            $output     .= 'donderdag' ;
        }
        elseif( 'Friday'  ==  $day )
        {
            $output     .= 'vrijdag' ;
        }
        elseif( 'Saturday'  ==  $day )
        {
            $output     .= 'zaterdag' ;
        }
        elseif( 'Sunday'  ==  $day )
        {
            $output     .= 'zondag' ;
        }
       
        if( 'hoofdletter'  ==  $hoofdletter )
        {
             return ucfirst($output) ;           
        }
        else
        {
            return $output ;
        }
    }
    //-----/geefNlDag 
    
    
/* End of file vww_helper.php */
/* Location: ./application/helpers/vww_helper.php */