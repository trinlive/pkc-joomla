<?php
/* ======================================================
 # JLogs   for Joomla! - v1.0.6 (free version)
 # -------------------------------------------------------
 # For Joomla! CMS (v4.x)
 # Author: Web357 (Yiannis Christodoulou)
 # Copyright: (©) 2014-2024 Web357. All rights reserved.
 # License: GNU/GPLv3, https://www.gnu.org/licenses/gpl-3.0.html
 # Website: https://www.web357.com
 # Demo: https://demo-joomla.web357.com/jlogs
 # Support: support@web357.com
 # Last modified: Thursday 21 November 2024, 09:58:16 AM
 ========================================================= */
defined('_JEXEC') or die;

require_once __DIR__ . '/script.install.helper.php';

class PlgInstallerJlogsInstallerScript extends PlgInstallerJlogsInstallerScriptHelper
{
	public $name           	= 'JLogs (Free version)';
	public $alias          	= 'jlogs';
	public $extension_type 	= 'plugin';
	public $plugin_folder   = 'installer';
}