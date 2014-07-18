<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Channel_form_author_ext {
	
	var $name			= 'Channel Form Author';
	var $version		= '1.0';
	var $description	= 'Allows you to set an alternate author to your entries submited via channel form';
	var $settings_exist	= 'n';
	var $docs_url		= '';
	
	var $settings	= array();
	


	/**
	 * Constructor
	 *
	 * @param mixed Settings array or empty string if none exists.
	 */
	function __construct($settings='')
	{
		$this->settings = $settings;
	}



	/**
	 * Activate Extension
	 *
	 * This function enters the extension into the exp_extensions table
	 *
	 * @see http://ellislab.com/codeigniter/user-guide/database/index.html for
	 * more information on the db class
	 *
	 * @return void
	 */
	function activate_extension()
	{
		$data = array(
			'class'		=> __CLASS__,
			'method'	=> 'channel_form_submit_entry_end',
			'hook'		=> 'channel_form_submit_entry_end',
			'settings'	=> '',
			'priority'	=> 10,
			'version'	=> $this->version,
			'enabled'	=> 'y'
		);
		
		ee()->db->insert('extensions', $data);
	}
	
	
	/**
	 * Update Extension
	 *
	 * This function preforms any necessary db updates when the extension
	 * page is visited
	 *
	 * @return mixed  void on update / false if none
	 */
	function update_extension($current = '')
	{
		if ($current == '' OR $current == $this->version)
		{
			return FALSE;
		}
		
		if ($current < '1.0')
		{
			//something if we change the extension
		}
		
		ee()->db->where('class', __CLASS__);
		ee()->db->update(
			'extensions',
			array('version' => $this->version)
		);
	}
	
	
	/**
	 * Disable Extension
	 *
	 * THis method removes information from the exp_extensions table
	 *
	 * @return void
	 *
	 */
	function disable_extension()
	{
		ee()->db->where('class', __CLASS__);
		ee()->db->delete('extensions');
	}
	
	function channel_form_submit_entry_end($obj)
	{
		$author = ee()->input->post('cfaid', TRUE);
		if (isset($obj->entry['entry_id']) && $author && $obj->entry['entry_id']) 
		{
			$author = reset(array_filter(preg_split("/\D+/", $author)));
			ee()->db->update(
			'channel_titles',
			array(
				'author_id' => $author
			),
			array(
				'entry_id' => $obj->entry['entry_id']
			)
			);
		}
	}
}
