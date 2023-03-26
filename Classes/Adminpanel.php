<?php

if ( ! defined( 'ABSPATH' ) )
{
	exit;
}
class Adminpanel
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
		register_setting
		(
			'recipebrowser_setting_group',
			'font',
			Array('type'=>'string',
			      'show_in_rest'=>'true',
			      'font' => 'Arial')
		);
		register_setting
		(
			'recipebrowser_setting_group',
			'font_color',
			Array('type'=>'string',
			      'show_in_rest'=>'true',
			      'font_color' => '#ee0000')
		);
		//Fügt spezifisches Feld zu der Gruppe hinzu
		//API Key Feld
		add_settings_field
		(
			'key',
			'API Key',
			array($this, 'keyCall'),
			'recipebrowser_setting_section',
			'recipebrowser_setting_group'
		);
		//Theme Feld
		add_settings_field
		(
			'theme',
			'Theme',
			array($this, 'themeCall'),
			'recipebrowser_setting_section',
			'recipebrowser_setting_group'
		);
		//Schriftart Feld
		add_settings_field
		(
			'font',
			'Font',
			array($this, 'fontCall'),
			'recipebrowser_setting_section',
			'recipebrowser_setting_group'
		);
		//Schriftfarbe Feld
		add_settings_field
		(
			'font_color',
			'Font color',
			array($this, 'fontColorCall'),
			'recipebrowser_setting_section',
			'recipebrowser_setting_group'
		);
	}
	public function keyCall()
	{
		$value = get_option('key');
		echo "<input id='key' name='key' type='text' value='$value' required />";
	}
	public function themeCall()
	{
		$value = "<select name='theme' id='theme'>";

		if(get_option("theme") == "dark")
		{
			$value .=
				"
						<option value='light'>Light</option>
	                    <option value='dark' selected>Dark</option>
					</select>
				";
		}
		else
		{
			$value .=
				"
						<option value='light' selected>Light</option>
	                    <option value='dark'>Dark</option>
					</select>
				";
		}
		echo $value;
	}
	public function fontCall()
	{
		$value = "<select name='font' id='font'>";

		if(get_option("font") == "Arial")
		{
			$value .=
				"
						<option value='Arial' selected>Arial</option>
	                    <option value='Helvetica'>Helvetica</option>
					</select>
				";
		}
		else
		{
			$value .=
				"
						<option value='Arial'>Arial</option>
	                    <option value='Helvetica' selected>Helvetica</option>
					</select>
				";
		}
		echo $value;
	}
	public function fontColorCall()
	{
		$value = get_option("font_color");
		echo
		"
			<input type='color' id='font_color' name='font_color' value='$value'>
		";
	}
	//Leere Callback Funktion
	public function sectionCall(){}

	//Sollte Css für Shortcodes hinzufügen
	public function enqeueStyle()
	{
		wp_enqueue_style( 'style', 'style.php');
	}
}