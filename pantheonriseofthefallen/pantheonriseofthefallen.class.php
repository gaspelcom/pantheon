<?php

if ( !defined('EQDKP_INC') ){
	header('HTTP/1.0 404 Not Found');exit;
}

if(!class_exists('pantheonriseofthefallen')) {
	class pantheonriseofthefallen extends game_generic {	
		public $version			= '0.3';
		protected $this_game	= 'pantheonriseofthefallen';
		protected $types		= array('classes', 'races', 'roles', 'filters', 'professions');
		protected $classes		= array();
		protected $roles		= array();
		protected $races		= array();
		protected $professions	= array();
		public $langs			= array('english', 'german');	
		protected static $apiLevel = 20;
					
		protected $class_dependencies = array(
			array (
				'name'		=> 'race',
				'type'		=> 'races',
				'admin'		=> false,
				'decorate'	=> true,
				'parent' 	=> false,
			),
			array (
				'name'		=> 'class',
				'type'		=> 'classes',
				'admin'		=> false,
				'decorate'	=> true,
				'primary'	=> true,
				'colorize'	=> true,
				'roster'	=> true,
				'recruitment' => true,
				'parent' 		=> array(
					'race'	=> array(
						1	=> array(1,4,6,11,13,14), //Archai
						2	=> array(1,2,3,4,5,6,7,10,12,13,14), //Dark Myr
						3	=> array(1,2,5,8,10,13), //Dwarf
						4	=> array(1,4,5,9,10,11,12,13,14), //Elf
						5	=> array(1,4,9,10,13), //Halfling
						6	=> array(1,2,3,4,5,6,7,8,9,10,11,12,13,14), //Human
						7	=> array(5,7,10,12,14), //Gnome
						8	=> array(3,4,11,13), //Ogre
						9	=> array(3,6,7,10,11,13), //Skar
					),
				),
			),  	
		);
		
		//end $class_dependencies
		public $default_roles = array (
			1	=> array(2,4,8,11), //healer
			2	=> array(1,3,4,5,6,11,12), //supporter
			3	=> array(8,13), //tank
			4	=> array(6,9), //light tank
			5	=> array(6,10,13), //dd melee
			6	=> array(3,4,7,9,14), //dd range
		);
		protected $class_colors = array (
			2 => '#FDFFFF',
			3 => '#C100FF',
			4 => '#00FF4A',
			5 => '#0064FF',
			6 => '#A0FF00',
			8 => '#FFFD00',
			9 => '#14B200',
			10 => '#B0AB00',
			11 => '#00FFF9',
			12 => '#7289FF',
			13 => '#FF0000',
			14 => '#FF00D7',
		);
		
		protected $glang		= array();
		protected $lang_file	= array();
		protected $path			= '';
		protected $filters		= array();
		public $lang			= false;
		//Primary Classtype
		
				
		/* Constructor */
		public function __construct() {
			parent::__construct();
		}
				
		/* Install or Game Change Information */
		public function install($install=false){
			$info = array();
			return $info;
		}

		/**
		* Initialises filters
		*
		* @param array $langs
		*/
		protected function load_filters($langs){
			if(!$this->classes) {
				$this->load_type('classes', $langs);
			}
			foreach($langs as $lang) {
				$names = $this->classes[$this->lang];
				$this->filters[$lang][] = array('name' => '-----------', 'value' => false);
				foreach($names as $id => $name) {
					$this->filters[$lang][] = array('name' => $name, 'value' => 'class:'.$id);
				}
			}
		}
		public function profilefields(){
			// Category 'character' is a fixed one! All others are created dynamically!
			$xml_fields = array(
				'guild' 		=> array(
					'type'			=> 'text',
					'category'		=> 'character',
					'lang'			=> 'uc_guild',
					'size'			=> 32,
					'undeletable'	=> true,
					'sort'			=> 1
				),
				'servername'	=> array(
					'category'		=> 'character',
					'lang'			=> 'servername',
					'type'			=> 'text',
					'size'			=> '21',
					'sort'			=> 2,
					'undeletable'	=> true
				),
				'gender'		=> array(
					'type'			=> 'dropdown',
					'category'		=> 'character',
					'lang'			=> 'uc_gender',
					'options'		=> array('male' => 'uc_male', 'female' => 'uc_female'),
					'tolang'		=> true,
					'undeletable'	=> true,
					'sort'			=> 3
				),
				'level'			=> array(
					'type'			=> 'spinner',
					'category'		=> 'character',
					'lang'			=> 'uc_level',
					'max'			=> 50,
					'min'			=> 1,
					'undeletable'	=> true,
					'sort'			=> 4
				),
			);
			return $xml_fields;
		}
	}#class			

}
?>