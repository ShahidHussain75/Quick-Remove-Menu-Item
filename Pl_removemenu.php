<?php
/**
Plugin Name: Quick Remove Menu Item
Plugin URI: https://github.com/ShahidHussain75/quick-remove-menu
Description: Delete menu item & its sub items quickly
Version: 2.0
Author: Shahid Hocien
Author URI: https://github.com/ShahidHussain75
Author Email: shahidhocien@gmail.com
License: GPL-2.0

  Copyright 2023 shahidhocien@gmail.com

  This program is free software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

class HpRemoveMenu {

	const NAME = 'Quick Remove Menu Item';
	const SLUG = 'hp_remove_menu';

	public function __construct() {
		register_activation_hook( __FILE__, array( $this, 'install_hp_remove_menu' ) );
		add_action( 'admin_footer', array( $this, 'init_hp_remove_menu' ) );
	}

	public function install_hp_remove_menu() {
		// Do not generate any output here.
	}

	public function init_hp_remove_menu() {
		if ( is_admin() && is_super_admin() && 'nav-menus.php' === $GLOBALS['pagenow'] ) {
			$this->register_scripts_and_styles();
		}
	}

	private function register_scripts_and_styles() {
		$this->load_file( self::SLUG . '-admin-script', '/js/removemenu.js', true );
		$this->load_file( self::SLUG . '-admin-style', '/css/removemenu.css' );
	}

	private function load_file( $name, $file_path, $is_script = false ) {
		$url  = plugins_url( $file_path, __FILE__ );
		$file = plugin_dir_path( __FILE__ ) . $file_path;

		if ( is_readable( $file ) ) {
			if ( $is_script ) {
				wp_register_script( $name, $url, array( 'jquery' ) );
				wp_enqueue_script( $name );
			} else {
				wp_register_style( $name, $url );
				wp_enqueue_style( $name );
			}
		}
	}
}

new HpRemoveMenu();
?>
