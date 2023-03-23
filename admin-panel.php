<?php

if ( ! defined( 'ABSPATH' ) )
{
	exit;
}

class Admin
{
	//Attribute für den Admin Panel
	public $titel = "Admin site for recipe browser";
	public $titelMenu = "Admin"; //Name ändern
	public $description = "Setting for the recipiebrowser plugin";
	public $urlSlug = "Admin"; //Name ändern
	public $icon = "🍳";
	public $position = 0;

	public function createAdminPanel()
	{
		//Schaut nach, ob Admin Panel bereits existiert
		$menu_url = menu_page_url( 'Admin', false );

		if(!$menu_url)
		{
			add_menu_page
			(
				$this->titel,
				$this->titelMenu,
				$this->description,
				$this->urlSlug,
				$this->adminPanelContent(),
				$this->icon,
				$this->position
			);
			add_action("adminmenu", "createAdminPanel");
		}
	}
	public function adminPanelContent()
	{
		echo '<div class="wrap">';
		echo '<h1>Test</h1>';
		echo '<p>Inhalt</p>';
		echo '</div>';
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
