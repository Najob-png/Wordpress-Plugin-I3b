<?php

if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
class Admin
{
	//Attribute für den Admin Panel
	public $titel = 'Admin Panel Recipebrowser';
	public $titelMenu = 'Admin Panel';
	public $menuSlug = 'AdminPanel';

	//Erstellt den Admin Panel
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
	//Inhalt des Admin Panels
	public function adminPanelContent() : void
	{
		echo "<form action='options.php' method='post'>";

		settings_fields('recipebrowser_setting_group');
		do_settings_sections('recipebrowser_setting_section');
		submit_button('Apply', 'primary', 'submit', false);

		echo "</form>";
	}
	//Funktionen (Inputfelder) für den Admin Panel
	public function adminPanelSettingFields()
	{
		//Erstellt eine Gruppe
		add_settings_section
		(
			'recipebrowser_setting_group',
			'RecipeBrowser Settings',
			array($this, 'sectionCall'), //nutzlose funktion, muss aber funktionieren
			'recipebrowser_setting_section'
		);
		//Sagt das die Fields Setting Felder sind
		register_setting
		(
			'recipebrowser_setting_group',
			'key',
			Array('type'=>'string',
			      'show_in_rest'=>'true',
			      'default' => 'default')
		);
		register_setting
		(
			'recipebrowser_setting_group',
			'theme',
			Array('type'=>'string',
			      'show_in_rest'=>'true',
			      'theme' => 'light')
		);
		//Fügt spezifisches Feld zu der Gruppe hinzu
		add_settings_field
		(
			'key',
			'API Key',
			array($this, 'keyCall'),
			'recipebrowser_setting_section',
			'recipebrowser_setting_group'
		);
		add_settings_field
		(
			'theme',
			'Theme',
			array($this, 'themeCall'),
			'recipebrowser_setting_section',
			'recipebrowser_setting_group'
		);
	}
	public function keyCall()
	{
		$val = get_option('key');
		echo "<input id='key' name='key' type='text' value='$val' required />";
	}
	public function themeCall()
	{
		$val = "<select name='theme' id='theme'>";

		if(get_option("theme") == "light")
		{
			$val .= "<option value='light' selected>Light</option>
  				<option value='dark'>Dark</option>
				</select>";
		}
		else
		{
			$val .= "<option value='light'>Light</option>
  				<option value='dark' selected>Dark</option>
				</select>";
		}
		echo $val;
	}
	public function sectionCall(){}
}