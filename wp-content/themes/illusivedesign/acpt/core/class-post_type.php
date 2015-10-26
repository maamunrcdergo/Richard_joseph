<?php
/**
  * Post Type
  *
  * This is the long description for a DocBlock. This text may contain
  * multiple lines and even some _markdown_.
  *
  * * Markdown style lists function too
  * * Just try this out once
  *
  * The section after the long description contains the tags; which provide
  * structured meta-data concerning the given element.
  *
  * @author  Kevin Dees
  *
  * @since 0.6
  * @version 0.6
  *
  * @global string $acpt_version
  */
class acpt_post_type extends acpt {

	public $singular = null;
	public $plural = null;
	public $icon = null;
	public $icon_pos = array(
		'notebook' => array('a' => '6px 0px', 'i' => '6px -35px'),
		'refresh' => array('a' => '-34px 0px', 'i' => '-34px -35px'),
		'thumbs-up' => array('a' => '-64px 0px', 'i' => '-64px -35px'),
		'box' => array('a' => '-90px 0px', 'i' => '-90px -35px'),
		'bug' => array('a' => '-139px 0px', 'i' => '-139px -35px'),
		'cake' => array('a' => '-163px 0px', 'i' => '-163px -35px'),
		'calendar' => array('a' => '-186px 0px', 'i' => '-186px -35px'),
		'card-biz' => array('a' => '-234px 0px', 'i' => '-234px -35px'),
		'task' => array('a' => '-258px 0px', 'i' => '-258px -35px'),
		'clock' => array('a' => '-283px 0px', 'i' => '-279px -35px'),
		'color' => array('a' => '-307px 0px', 'i' => '-307px -35px'),
		'compass' => array('a' => '-330px 0px', 'i' => '-330px -35px'),
		'dine' => array('a' => '-354px 0px', 'i' => '-354px -35px'),
		'ipad' => array('a' => '-375px 0px', 'i' => '-375px -35px'),
		'ticket' => array('a' => '-396px 0px', 'i' => '-396px -35px'),
		'shirt' => array('a' => '-424px 0px', 'i' => '-424px -35px'),
		'pulse' => array('a' => '-446px 0px', 'i' => '-446px -35px'),
		'card-play' => array('a' => '-468px 0px', 'i' => '-468px -35px'),
		'dine-plate' => array('a' => '-489px 0px', 'i' => '-489px -35px'),
		'pill' => array('a' => '-514px 0px', 'i' => '-514px -35px'),
		'plane' => array('a' => '-535px 0px', 'i' => '-535px -35px'),
		'paint' => array('a' => '-561px 0px', 'i' => '-561px -35px'),
		'mic' => array('a' => '-584px 0px', 'i' => '-584px -35px'),
		'location' => array('a' => '-605px 0px', 'i' => '-605px -35px'),
		'leaf' => array('a' => '-626px 0px', 'i' => '-626px -35px'),
		'music' => array('a' => '-647px 0px', 'i' => '-647px -35px'),
		'wine' => array('a' => '-669px 0px', 'i' => '-669px -35px'),
		'dashboard' => array('a' => '-692px 0px', 'i' => '-692px -35px'),
		'person' => array('a' => '-715px 0px', 'i' => '-715px -35px'),
		'weather' => array('a' => '-735px 0px', 'i' => '-735px -35px')
	);

	function __construct( $singular = null, $plural = null, $cap = false, $settings = array(), $icon = null ) {
		return $this->make($singular, $plural, $cap, $settings);
	}

  /**
   * Add Icon to Post Type Menu Item
   *
   * @param $name
   *
   * @return $this
   */
  function icon($name) {
		if(!array_key_exists($name, $this->icon_pos)) exit('Adding Icon: You need to enter a valid icon name. You used ' . $name);

		$this->icon = $name;
		add_action( 'admin_head', array($this, 'set_icon_css') );

    return $this;
	}

  /**
   * Add CSS for Post Type Menu Icon
   */
  function set_icon_css() { ?>

		<style type="text/css">
			#adminmenu #menu-posts-<?php echo $this->singular; ?> .wp-menu-image:before {
			  background-image: url('<?php echo ACPT_LOCATION; ?>/<?php echo ACPT_FOLDER_NAME; ?>/core/img/menu.png');
                          content: " ";
			}

			#adminmenu #menu-posts-<?php echo $this->singular; ?> .wp-menu-image:before {
			  background-position: <?php echo $this->icon_pos[$this->icon]['a']; ?>;
			}

			#adminmenu #menu-posts-<?php echo $this->singular; ?>:hover div.wp-menu-image,
			#adminmenu #menu-posts-<?php echo $this->singular; ?>.wp-has-current-submenu div.wp-menu-image,
			#adminmenu #menu-posts-<?php echo $this->singular; ?>.current div.wp-menu-image {
			  background-position: <?php echo $this->icon_pos[$this->icon]['a']; ?>;
			}
                        
		</style>

	<?php }

	/**
	 * Make Post Type. Do not use before init.
	 *
	 * @param string $singular singular name is required
	 * @param string $plural plural name is required
	 * @param boolean $cap turn on custom capabilities
	 * @param array $settings args override and extend
   * @return $this
	 */
	function make($singular = null, $plural = null, $cap = false, $settings = array() ) {
		if(!$singular) exit('Making Post Type: You need to enter a singular name.');
		if(!$plural) exit('Making Post Type: You need to enter a plural name.');

		// make lowercase
		$singular = strtolower($singular);
		$plural = strtolower($plural);

		// setup object for later use
		$this->plural = $plural;
		$this->singular = $singular;

		// make uppercase
		$upperSingular = ucwords($singular);
		$upperPlural = ucwords($plural);

		$labels = array(
			'name' => $upperPlural,
			'singular_name' => $upperSingular,
			'add_new' => 'Add New',
			'add_new_item' => 'Add New '.$upperSingular,
			'edit_item' => 'Edit '.$upperSingular,
			'new_item' => 'New '.$upperSingular,
			'view_item' => 'View '.$upperSingular,
			'search_items' => 'Search '.$upperPlural,
			'not_found' =>  'No '.$plural.' found',
			'not_found_in_trash' => 'No '.$plural.' found in Trash',
			'parent_item_colon' => '',
			'menu_name' => $upperPlural,
		);

		$capabilities = array(
			'publish_posts' => 'publish_'.$plural,
			'edit_post' => 'edit_'.$singular,
			'edit_posts' => 'edit_'.$plural,
			'edit_others_posts' => 'edit_others_'.$plural,
			'delete_post' => 'delete_'.$singular,
			'delete_posts' => 'delete_'.$plural,
			'delete_others_posts' => 'delete_others_'.$plural,
			'read_post' => 'read_'.$singular,
			'read_private_posts' => 'read_private_'.$plural,
		);

		if($cap === true) :
			$cap = array(
				'capability_type' => $singular,
				'capabilities' => $capabilities,
			);
		else :
			$cap = array();
		endif;

		$args = array(
			'labels' => $labels,
			'description' => $plural,
			'rewrite' => array( 'slug' => sanitize_title($singular)),
			'public' => true,
			'has_archive' => true,
		);

		$args = array_merge($args, $cap, $settings);               
		// Register post type
		register_post_type($singular, $args);

    return $this;
	}
}