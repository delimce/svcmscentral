// JavaScript Document
tinyMCE.init({
		// General options
		mode : "exact",
		elements : "r_descrip,r-descrip,desc",
        theme : "advanced",
        language: "es",
        theme_advanced_blockformats : "p,h1,h2,h3,h4,h5,div",
        apply_source_formatting : false,
        remove_script_host : false,
        convert_urls : false,
		inline_styles: true,
		plugins : "autoresize,autolink,lists,table,save,advhr,advimage,advlink,inlinepopups,preview,media,searchreplace,contextmenu,paste,fullscreen,advlist,style",



		// Theme options
		theme_advanced_buttons1 : "undo,redo,|,cut,copy,paste,pastetext,pasteword,|,search,replace,|,image,media,|,tablecontrols",
		theme_advanced_buttons2 : "formatselect,fontselect,fontsizeselect,forecolor,backcolor,|,justifyleft,justifycenter,justifyright,justifyfull,|,bold,italic,underline,strikethrough,sub,sup",
		theme_advanced_buttons3 : "bullist,numlist,|,outdent,indent,blockquote,|,link,unlink,anchor,|,hr,advhr,|,charmap,attribs,styleprops,|,|,|,cleanup,removeformat,preview,code,fullscreen",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "none",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",
       


	});