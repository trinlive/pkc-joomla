tinyMCE.init({
			mode : "exact",		 
			elements : "detail,description_product,en_detail,fdetail,reference,answer,en_answer,gold,silver,job_description,job_detail",
			theme : "advanced",
			plugins : "table,advhr,advimage,advlink,flash,paste,fullscreen,noneditable,contextmenu",
			theme_advanced_buttons1_add_before : "newdocument,separator",
			theme_advanced_buttons1_add : "fontselect,fontsizeselect",
			theme_advanced_buttons2_add : "separator,forecolor,backcolor,liststyle",
			theme_advanced_buttons2_add_before: "cut,copy,paste,pastetext,pasteword,separator,",
			theme_advanced_buttons3_add_before : "tablecontrols,separator",
			theme_advanced_buttons3_add : "flash,advhr,separator,fullscreen",
			theme_advanced_toolbar_location : "top",
			theme_advanced_toolbar_align : "left",
			extended_valid_elements : "hr[class|width|size|noshade]",
			file_browser_callback : "ajaxfilemanager",
			paste_use_dialog : false,
			theme_advanced_resizing : true,
			theme_advanced_resize_horizontal : true,
			apply_source_formatting : true,
			force_br_newlines : false,
			force_p_newlines : false,	
  			 convert_urls : false,
			 relative_urls : false,
			remove_script_host : false
		});

		function ajaxfilemanager(field_name, url, type, win) {
			var ajaxfilemanagerurl = "../../plugins/ajaxfilemanager/ajaxfilemanager.php";
			switch (type) {
				case "image":
					ajaxfilemanagerurl += "?type=img";
					break;
				case "media":
					ajaxfilemanagerurl += "?type=media";
					break;
				case "flash": //for older versions of tinymce
					ajaxfilemanagerurl += "?type=media";
					break;
				case "file":
					ajaxfilemanagerurl += "?type=files";
					break;
				default:
					return false;
			}
			var fileBrowserWindow = new Array();
			fileBrowserWindow["file"] = ajaxfilemanagerurl;
			fileBrowserWindow["title"] = "Ajax File Manager";
			fileBrowserWindow["width"] = "782";
			fileBrowserWindow["height"] = "440";
			fileBrowserWindow["close_previous"] = "no";
			tinyMCE.openWindow(fileBrowserWindow, {
			  window : win,
			  input : field_name,
			  resizable : "yes",
			  inline : "yes",
			  editor_id : tinyMCE.getWindowArg("editor_id")
			});
			
			return false;
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