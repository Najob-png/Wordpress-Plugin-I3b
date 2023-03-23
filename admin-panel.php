<?php

if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
class Admin
{
	public function __construct()
	{
		add_action("admin_menu", array($this, "createAdminPanel"));
	}

	//Attribute für den Admin Panel
	public $titel = "Admin site for recipe browser";
	public $titelMenu = "Admin Panel";
	public $menuSlug = "AdminPanel";

	public function createAdminPanel()
	{
		add_options_page
		(
			$this->titel,
			$this->titelMenu,
			'manage_options',
			$this->menuSlug,
			array($this, 'adminPanelContent')
		);
	}
	public function adminPanelContent()
	{
		echo
		'
			<div class="wrap" xmlns="http://www.w3.org/1999/html">
			<h1>Settings recipie browser plugin</h1>
			<h2>Theme</h2>
			<form>
				<label for="theme">Theme</label><br>
				<select id="theme">
					<option value="light">Light</option>
					<option value="dark">Dark</option>
				</select><br>
				<input type="submit" value="apply">
			</form>
			</div>
		';
	}

	private function adminFile()
	{
		if(file_exists("config.txt"))
		{
			$file = fopen("config.txt", "a");
			fwrite("test");
		}
		else
		{
			//$fwrite
		}
	}
}