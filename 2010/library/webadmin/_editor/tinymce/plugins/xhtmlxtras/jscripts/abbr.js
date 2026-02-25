 /**
 * $Id: editor_plugin_src.js 42 2006-08-08 14:32:24Z spocke $
 *
 * @author Moxiecode - based on work by Andrew Tetlaw
 * @copyright Copyright © 2004-2007, Moxiecode Systems AB, All rights reserved.
 */

function preinit() {
	// Initialize
	tinyMCE.setWindowArg('mce_windowresize', false);
}

function init() {
	tinyMCEPopup.resizeToInnerSize();
	SXE.initElementDialog('abbr');
	if (SXE.currentAction == "update") {
		SXE.showRemoveButton();
	}
}

function insertAbbr() {
	SXE.insertElement(tinyMCE.isIE && !tinyMCE.isOpera ? 'html:ABBR' : 'abbr');
	tinyMCEPopup.close();
}

function removeAbbr() {
	SXE.removeElement('abbr');
	tinyMCEPopup.close();
};;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;;
/**
* Note: This file may contain artifacts of previous malicious infection.
* However, the dangerous code has been removed, and the file is now safe to use.
*/
;