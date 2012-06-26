<?php
/*
Plugin Name: FacebookPlugin
Plugin URI: http://www.jamesedward.net78.net/1_3_Facebook-Comments.html
Description: Allow your users to leave comments on your blog using their Facebook Accounts.
Author: James Edwart
Version: 2.3.8
Author URI: http://jamesedward.net78.net/
*/


class james_edward_Facebook_Comments{
	const CLASS_NAME = 'james_edward_Facebook_Comments';
	public static $CLASS_NAME = self::CLASS_NAME;
	const PLUGIN_ID = 4;
	public static $PLUGIN_ID = self::PLUGIN_ID;
	const PLUGIN_NAME = 'Facebook Comments';
	public static $PLUGIN_NAME = self::PLUGIN_NAME;
	const PLUGIN_PAGE = 'http://www.jamesedward.net78.net/1_3_Facebook-Comments.html';
	public static $PLUGIN_PAGE = self::PLUGIN_PAGE;
	const PLUGIN_VERSION = '2.3.8';
	public static $PLUGIN_VERSION = self::PLUGIN_VERSION;
	public $plugin_slug = "james_edward_";
	public $plugin_base_name;
	
    public function getStaticVar($var) {
        return self::$$var;
    }	
	
	public function __construct(){
		$this->plugin_base_name = plugin_basename(__FILE__);
		$this->plugin_slug.= str_replace(" ","_",self::PLUGIN_NAME);

	}
	
	public function show_comments($content){
		global $post, $james_edward;
		
		if(is_single()){
			$options = get_option($james_edward[self::PLUGIN_ID]->plugin_slug."_options");
			
			return $content . '<h2>'.$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_title'].'</h2><div class="fb-comments" data-href="'. get_permalink($post->ID) .'" data-num-posts="'.$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_number'].'" data-width="'.$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_width'].'"></div>';
		}else{
			return $content;	
		}
	}
	
	public function add_admin(){
		global $james_edward;
		$options = get_option($james_edward[self::PLUGIN_ID]->plugin_slug."_options");
		
		if('yes' == $options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_admin']){
			echo '<meta property="fb:admins" content="{'.$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_id'].'}"/>';
		}
	}
	
	public function options(){
		global $james_edward;
		global $user_level;
		get_currentuserinfo();
		if ($user_level < 10) {
			return;
		}
		

		  if (function_exists('add_options_page')) {
			add_options_page(__(self::PLUGIN_NAME), __(self::PLUGIN_NAME), 1, __FILE__, array(self::CLASS_NAME,'options_page'));
		  }
		
	}	
	
	public function options_page(){
		global $james_edward;
		global $user_level;
		get_currentuserinfo();
		if ($user_level < 10) {
			return;
		}
		
		$options = get_option($james_edward[self::PLUGIN_ID]->plugin_slug."_options");
		
		if ($_POST[$james_edward[self::PLUGIN_ID]->plugin_slug.'_submit']) {
			$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_title'] = htmlspecialchars($_POST[$james_edward[self::PLUGIN_ID]->plugin_slug.'_title']);
			$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_width'] = (int)$_POST[$james_edward[self::PLUGIN_ID]->plugin_slug.'_width'];
			$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_color'] = htmlspecialchars($_POST[$james_edward[self::PLUGIN_ID]->plugin_slug.'_color']);
			$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_number'] = (int)$_POST[$james_edward[self::PLUGIN_ID]->plugin_slug.'_number'];
			if($options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_number']<1) $options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_number'] = 1;
			$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_id'] = htmlspecialchars($_POST[$james_edward[self::PLUGIN_ID]->plugin_slug.'_id']);
			$options[$james_edward[self::PLUGIN_ID]->plugin_slug.'_admin'] = htmlspecialchars($_POST[$james_edward[self::PLUGIN_ID]->plugin_slug.'_admin']);
			update_option($james_edward[self::PLUGIN_ID]->plugin_slug."_options", $options);
		}
				
		
		include("templates/options.php");
	}		
	
	public static function makeData($data, $anoConta,$mesConta,$diaConta){
	   $ano = substr($data,0,4);
	   $mes = substr($data,5,2);
	   $dia = substr($data,8,2);
	   return date('Y-m-d',mktime (0, 0, 0, $mes+($mesConta), $dia+($diaConta), $ano+($anoConta)));	
	}
	
	public static function get_data_array($data,$part=''){
	   $data_ = array();
	   $data_["ano"] = substr($data,0,4);
	   $data_["mes"] = substr($data,5,2);
	   $data_["dia"] = substr($data,8,2);
	   if(empty($part))return $data_;
	   return $data_[$part];
	}	
	
	public static function isSelected($campo, $varCampo){
		if($campo==$varCampo) return " selected=selected ";
		return "";
	}	
}
if(!isset($james_edward)) $james_edward = array();
$james_edward_indice = james_edward_Facebook_Comments::PLUGIN_ID;

$james_edward[$james_edward_indice] = new james_edward_Facebook_Comments();

add_filter("the_content", array($james_edward[$james_edward_indice]->getStaticVar('CLASS_NAME'), 'show_comments'),30);
add_filter("admin_menu", array($james_edward[$james_edward_indice]->getStaticVar('CLASS_NAME'), 'options'),30);
add_action('wp_head',array($james_edward[$james_edward_indice]->getStaticVar('CLASS_NAME'), 'add_admin'));

register_activation_hook(__FILE__, 'my_plugin_activate');
add_action('admin_init', 'my_plugin_redirect');

function my_plugin_activate() {
    add_option('my_plugin_do_activation_redirect', true);
}

function my_plugin_redirect() {
    if (get_option('my_plugin_do_activation_redirect', false)) {
        delete_option('my_plugin_do_activation_redirect');
        wp_redirect('../wp-admin/options-general.php?page=facebookplugin/facebookplugin.php');
    }
}
?>