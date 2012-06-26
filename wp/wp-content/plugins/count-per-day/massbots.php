<?php 
if (!session_id()) session_start();
$cpd_wp = (!empty($_SESSION['cpd_wp'])) ? $_SESSION['cpd_wp'] : '../../../';
require_once($cpd_wp.'wp-load.php');

if ( isset($_GET['dmbip']) && isset($_GET['dmbdate']) )
{
	$sql = $wpdb->prepare("
	SELECT	c.page post_id, p.post_title post,
			t.name tag_cat_name,
			t.slug tag_cat_slug,
			x.taxonomy tax
	FROM	$wpdb->cpd_counter c
	LEFT	JOIN $wpdb->posts p
			ON p.ID = c.page
	LEFT	JOIN $wpdb->terms t
			ON t.term_id = 0 - c.page
	LEFT	JOIN $wpdb->term_taxonomy x
			ON x.term_id = t.term_id
	WHERE	c.ip = %d
	AND		c.date = %s
	ORDER	BY p.ID",
	$_GET['dmbip'], $_GET['dmbdate'] );
	$massbots = $count_per_day->mysqlQuery('rows', $sql, 'showMassbotPosts');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="de-DE">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Count per Day</title>
<link rel="stylesheet" type="text/css" href="counter.css" />
</head>
<body class="cpd-thickbox">
<h2><?php _e('Mass Bots', 'cpd') ?></h2>
<ol>
<?php
foreach ( $massbots as $r )
{
	if ( $r->post_id < 0 && $r->tax == 'category' )
	{
		$name = '- '.$row->tag_cat_name.' -';
		$link = get_bloginfo('url').'?cat='.abs($r->post_id);
	}
	else if ( $r->post_id < 0 )
	{
		$name = '- '.$r->tag_cat_name.' -';
		$link = get_bloginfo('url').'?tag='.$r->tag_cat_slug;
	}
	else if ( $r->post_id == 0 )
	{
		$name = '- '.__('Front page displays').' -';
		$link =	get_bloginfo('url');
	}
	else
	{
		$postname = $r->post;
		if ( empty($postname) ) 
			$postname = '---';
		$name = $postname;
		$link =	get_permalink($r->post_id);
	}
	echo '<li><a href="'.$link.'" target="_blank">'.$name.'</a></li>';
}
?>
</ol>
<?php if ($count_per_day->options['debug']) $count_per_day->showQueries(); ?>
</body>
</html>