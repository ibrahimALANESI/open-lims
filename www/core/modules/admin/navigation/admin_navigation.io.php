<?php
/**
 * @package base
 * @version 0.4.0.0
 * @author Roman Konertz
 * @copyright (c) 2008-2010 by Roman Konertz
 * @license GPLv3
 * 
 * This file is part of Open-LIMS
 * Available at http://www.open-lims.org
 * 
 * This program is free software;
 * you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation;
 * version 3 of the License.
 * 
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY;
 * without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
 * See the GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License along with this program;
 * if not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Administration Navigation IO Class
 * @package base
 */
class AdminNavigationIO
{
	public static function navigation()
	{
		$template = new Template("languages/en-gb/template/navigation/left/administration.html");
		

		$paramquery[username] = $_GET[username];
		$paramquery[session_id] = $_GET[session_id];
		$paramquery[nav] = "admin";
		$paramquery[run] = "system_log";
		$params = http_build_query($paramquery,'','&#38;');
		
		$template->set_var("system_log_params", $params);
		
		
		$paramquery[username] = $_GET[username];
		$paramquery[session_id] = $_GET[session_id];
		$paramquery[nav] = "admin";
		$paramquery[run] = "system_message";
		$params = http_build_query($paramquery,'','&#38;');
		
		$template->set_var("system_message_params", $params);
		
		
		
		$organisation_admin_navigation_array = array();
		$counter = 0;
		
		$organisation_dialog_array = ModuleDialog::list_dialogs_by_type("organisation_admin");
		
		if (is_array($organisation_dialog_array) and count($organisation_dialog_array) >= 1)
		{
			foreach ($organisation_dialog_array as $key => $value)
			{
				$paramquery[username] 	= $_GET[username];
				$paramquery[session_id] = $_GET[session_id];
				$paramquery[nav]		= "admin";
				$paramquery[run]		= "organisation";
				$paramquery[dialog]		= $value[internal_name];
				$params 				= http_build_query($paramquery,'','&#38;');
				
				/**
				 * @todo icon
				 */
				$organisation_admin_navigation_array[$counter][icon] = "equipment.png";
				$organisation_admin_navigation_array[$counter][params] = $params;
				$organisation_admin_navigation_array[$counter][title] = $value[display_name];
				$counter++;
			}
		}
		
		$template->set_var("organisation_admin", $organisation_admin_navigation_array);
		
		
		
		$module_admin_navigation_array = array();
		$counter = 0;
		
		$module_dialog_array = ModuleDialog::list_dialogs_by_type("module_admin");
		
		if (is_array($module_dialog_array) and count($module_dialog_array) >= 1)
		{
			foreach ($module_dialog_array as $key => $value)
			{
				$paramquery[username] 	= $_GET[username];
				$paramquery[session_id] = $_GET[session_id];
				$paramquery[nav]		= "admin";
				$paramquery[run]		= "module";
				$paramquery[dialog]		= $value[internal_name];
				$params 				= http_build_query($paramquery,'','&#38;');
				
				/**
				 * @todo icon
				 */
				$module_admin_navigation_array[$counter][icon] = "equipment.png";
				$module_admin_navigation_array[$counter][params] = $params;
				$module_admin_navigation_array[$counter][title] = $value[display_name];
				$counter++;
			}
		}
		
		$template->set_var("module_admin", $module_admin_navigation_array);
		
		$template->output();
	}
}

?>