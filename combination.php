<?php
	/*
	Rainbow table creation script
	*/

	// init tokens

	$tokens=array();

	if(in_array('*', $token))
		for($i=0;$i<=255;$i++)
			$tokens[]=chr($i);
	else
	{
		if(in_array('a', $token))
			for($i=97;$i<=122;$i++)
				$tokens[]=chr($i);
		if(in_array('A', $token))
			for($i=65;$i<=90;$i++)
				$tokens[]=chr($i);
		if(in_array('1', $token))
			for($i=48;$i<=57;$i++)
				$tokens[]=chr($i);
	}
	
	$tokenLength=count($tokens);
	if(TO_JSON)
		$file = fopen("table_json.json","w");
	else
		$file = fopen("table.txt", "w");
	$outtext = "";

	function gen($str,$len,$maxlen)
	{
		global $outtext,$tokens,$tokenLength;
		if(strlen($str)==$maxlen)
		{
			$outtext.="$str\n";
			echo $str."\n";
		}
		else
			for($i=0;$i<$tokenLength;$i++)
				gen($str.$tokens[$i],$len+1,$maxlen);
	}

	function start_build()
	{
		global $tokenLength,$tokens,$file,$outtext;
		if(!$file)
		{
			echo "failed to open output file. Make sure yout have write permissions.\n";
			return;
		}
		$max=PASSWORD_MAX_LEN;
		if(TRY_ALL)
			$max=1;

		for(;$max<=PASSWORD_MAX_LEN;$max++)
		{
			for($i=0;$i<$tokenLength;$i++)
			{
				gen($tokens[$i],1,$max);
			}
		}
		if($outtext[strlen($outtext)-1] == "\n")
			$outtext = substr($outtext, 0, strlen($outtext)-1);
		if(TO_JSON)
		{
			$outtext = explode("\n", $outtext);
			$outtext = json_encode($outtext);
		}
		fwrite($file, $outtext);
		fclose($file);
	}
?>