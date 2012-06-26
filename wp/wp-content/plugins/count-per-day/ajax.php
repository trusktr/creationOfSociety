<?php
if ( $_GET['f'] == 'count' )
{
	if (!session_id()) session_start();
	$cpd_wp = (!empty($_SESSION['cpd_wp'])) ? $_SESSION['cpd_wp'] : '../../../';
	require_once($cpd_wp.'wp-load.php');

	$cpd_funcs = array ( 'show',
	'getReadsAll', 'getReadsToday', 'getReadsYesterday', 'getReadsLastWeek', 'getReadsThisMonth',
	'getUserAll', 'getUserToday', 'getUserYesterday', 'getUserLastWeek', 'getUserThisMonth',
	'getUserPerDay', 'getUserOnline', 'getFirstCount' );
	
	$page = (int) $_GET['page'];
	if ( is_numeric($page) )
	{
		$count_per_day->count( '', $page );
		foreach ( $cpd_funcs as $f )
		{
			if ( ($f == 'show' && $page) || $f != 'show' )
			{
				echo $f.'===';
				if ( $f == 'getUserPerDay' )
					eval('echo $count_per_day->getUserPerDay('.$count_per_day->options['dashboard_last_days'].');');
				else if ( $f == 'show' )
					eval('echo $count_per_day->show("", "", false, false, '.$page.');');
				else
					eval('echo $count_per_day->'.$f.'();');
				echo '|';
			}
		}
	}
}
