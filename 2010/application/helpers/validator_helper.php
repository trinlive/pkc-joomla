<?php

/**
 *
 *
 * @version $Id$
 * @copyright 2007
 */
function validateCardID($numid){


	$numid  = $_POST["NumID"];
	$n[0] =(int)$numid{0};
	$n[1]= (int)$numid{1};
	$n[2]= (int)$numid{2};
	$n[3]=  (int)$numid{3};
	$n[4]=  (int)$numid{4};
	$n[5]= (int) $numid{5};
	$n[6]= (int) $numid{6};
	$n[7]= (int) $numid{7};
	$n[8]=  (int)$numid{8};
	$n[9]=  (int)$numid{9};
	$n[10]=  (int)$numid{10};
	$n[11]=  (int)$numid{11};


	$j = 13;
	$sum =0;
	for($i = 0; $i<13 ; $i++,$j--){
	//echo $j."<br/>";
		$sum  = $sum + ($n[$i]*($j));
	}
	//echo $sum."<br/>";
	$mod = ($sum%11);
	//echo $mod;
	$mod =11-$mod;  //11 ???????? ??????
	echo $mod;

	$mod = ((string)$mod);
	//echo $mod{0};
	$n[12] = $mod{0}; //always first no.

	for($k=0 ; $k <=12; $k++)
		$text = $text.$n[$k];

	return $numid == $text;
}



//define(CITIZENID_MATCH, 0);
//define(CITIZENID_INCORRECT_SIZE, 1);
//define(CITIZENID_INCORRECT_FORMAT, 1);
//define(CITIZENID_NOT_MATCH, 1);

function checkThaiCitizenID($data){
	$CITIZENID_MATCH = 0;
	$CITIZENID_INCORRECT_SIZE = 1;
	$CITIZENID_INCORRECT_FORMAT = 1;
	$CITIZENID_NOT_MATCH = 1;

	$str = trim($data);
	// Check Lenght of input data
	if (strlen($str) != 13) {
		return $CITIZENID_INCORRECT_SIZE;
	}

	// Check all string are number
	//if (!ereg('^[[:digit:]]+$', $str))
        if (!preg_match('/^[[:digit:]]+$/', $str))
   		return $CITIZENID_INCORRECT_FORMAT;


	// Multiple each char with weight
	$sum = 0;
	$j = 13;
	for ($i=0;$i<12;$i++, $j--) {
		$sum  = $sum + ($str[$i]*($j));
	}

	$pkey = (string)(11 - ($sum%11));

    $pkey_ext = substr($pkey, strlen($pkey)-1);

	return ($str[12] == $pkey_ext?$CITIZENID_MATCH:$CITIZENID_NOT_MATCH);

}
    //---------------------------------------------------------------------------------------------- //
    /*
    *
    *           @Function         :         verify_email
    *           @Parameter        :
    *           @Return           :
    *           @Create By        :         Khwanchai Lao
    *
    */
    //---------------------------------------------------------------------------------------------- //
    function verify_email($email)
    {
        list($email_user,$email_host)=explode("@",$email);
        $host_ip=gethostbyname($email_host);
        if(preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/", $email) && !preg_match($host_ip,$email_host))
        {
            return "TRUE";
	}
        else
        {
            return "FALSE";
	}
    }
	


?>
