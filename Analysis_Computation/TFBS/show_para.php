<?php

	$version=$_GET['A_V'];
	$cluster=$_GET['cluster'];
	$types=isset($_GET["type"])?$_GET['type']:array();
	$status=isset($_GET['status'])?$_GET['status']:array();
	$level=isset($_GET['level'])?$_GET['level']:array();
	$total_len=$_GET['type_len'];
	
	//now link type with group
	$type_group=array();
	$group_index=0;
	for($i=0;$i<count($types);$i++)
	{
		for(;$group_index<$total_len;$group_inedx++)
		{
			if(isset($_GET['group'.$group_index]))
			{
				$type_group[$types[$i]]=$_GET['group'.$group_index];
				$group_index++;
				break;
			}
		}
	}
	
	$para_list=array();
	$is_first=true;
	foreach($type_group as $key=>$value)
	{
		if(!isset($para_list[$value]))
			$para_list[$value]=$key;
		else
			$para_list[$value].=','.$key;
	}

	$is_first=true;
	foreach($para_list as $key=>$value)
	{
		if($is_first==true)
		{
			$cmd_type=$value;
			$is_first=false;
		}
		else
			$cmd_type.='-'.$value;
	}

	//now process para-status and para-level
	$is_first=true;
	foreach($status as $key=>$value)
	{
		if($is_first==true)
		{
			$cmd_status=$value;
			$is_first=false;
		}
		else
			$cmd_status.=','.$value;
	}

	 $is_first=true;
        foreach($level as $key=>$value)
        {
                if($is_first==true)
                {
                        $cmd_level=$value;
                        $is_first=false;
                }
                else
                        $cmd_level.=','.$value;
        }

	$cmd_path="/home/polncr/software/script/perl/gtf_divide.pl";
	$gtf_file="/home/polncr/dataset/gene_annotation";
	
	$script=$cmd_path.' -g '.$gtf_file.$version.' -c '.$cluster.' -t '.$cmd_type.' -s '.$cmd_status.' -l '.$cmd_level;
	
	exec($script,$output,$res_code);
	if($res_code==0)
	{
		$text='<ul>';
		for($i=0;$i<count($para_list);$i++)
		{
			$text.="<li><a href=./group$i.gtf >group$i</a>: generated from ( $para_list[$i] ) </li>";
		}
		$text.='</ul>';
		$jscode='<script type="text/javascript">var midd=window.frames;var top=midd.parent;var right=top.frames["right"];';
		$jscode.='right.document.getElementById("step1").innerHTML='.$text.';';
		$jscode.='</script>';	
	}
	else
	{
		$jscode='<script>alert("Something wrong!");</script>';
	}
	echo $jscode;


	
?>
