// NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
// IT'S ALL JUST JUNK FOR OUR DOCS!
// ++++++++++++++++++++++++++++++++++++++++++

!function ($) {

  $(function(){

    
    if( $('#kunden').length > 0 ){
	$.getCSS('/assets/templates/datatables/media/css/DT_bootstrap.css');		
	$.getScript("/assets/templates/datatables/media/js/jquery.dataTables.js", function(){  
	$.getScript("/assets/templates/datatables/media/js/TableTools.js", function(){  
	$.getScript("/assets/templates/datatables/media/js/dataTables.editor.js", function(){  
	$.getScript("/assets/templates/bootstrap/themes/default/js/libs/DT_bootstrap.js", function(){ 
	    

		var editor = new $.fn.DataTable.Editor( {
		    "sAjaxSource": "/json",
		    "domTable": "#datatable",
		    "fields": [ {
			    "label": "Kundencode:",
			    "name": "mbcode_ku"
			}, {
			    "label": "Detail:",
			    "name": "status_ku"
			}, {
			    "label": "Vorname:",
			    "name": "vorname_ku"
			}, {
			    "label": "Nachname:",
			    "name": "nachname_ku"
			}
		    ]
		});			
		$('#kunden').dataTable( {
		    "sAjaxSource": "/json",
		    "sDom": "<'row-fluid'<'span6'T><'span6'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
		    "sPaginationType": "bootstrap",
		    "iDisplayLength": 100, 			    		    
		    "aoColumns": [
			{ "mDataProp": "mbcode_ku" },
			{ "mDataProp": "status_ku" },
			{ "mDataProp": "vorname_ku" },
			{ "mDataProp": "nachname_ku", "sClass": "center" }
		    ],
		    "fnServerParams": function ( aoData ) {
			aoData.push( 
			    { "name": "action" , "value": "mbkunden" },
			    { "name": "columns" , "value": "mbcode_ku,status_ku,vorname_ku,nachname_ku" } 
			);
		    },			    
		    "oTableTools": {
			"sRowSelect": "multi",
			"aButtons": [
			    { "sExtends": "editor_create", "editor": editor },
			    { "sExtends": "editor_edit",   "editor": editor },
			    { "sExtends": "editor_remove", "editor": editor }
			]
		    },
		    "oLanguage": {
			"sLengthMenu": "_MENU_ Eintr&auml;ge",
			"sZeroRecords": "Nichts gefunden - sorry",
			"sSearch": "",
			"sInfo": "_START_ - _END_ von total _TOTAL_",
			"sInfoEmpty": "Zeige 0 - 0 von 0 Total",
			"sPrevious":"zur&uuml;ck",
			"sNext":"weiter",                                
			"sInfoFiltered": "(filtered from _MAX_ total records)"
		    } 			    
	    });
	});});});});
    }
  })
}(window.jQuery);
