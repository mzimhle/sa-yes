$(document).ready(function(){
	
	getUserList();
	
	/* Search for mentees. */
	$( "#usersearch").autocomplete({
		source: "/feeds/participants.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				//$('#smenteeidname').html('');
				$('#usercode').val('');					
			} else { 
				//$('#smenteeidname').html('<b>' + ui.item.value + '</b>');
				$('#usercode').val(ui.item.id);									
			}				
			$('#usersearch').val('');										
		}
	});	
});

function clearsearch() {
	
	$('#usercode').val('');
	$('[name=type]').val('');
	$('[name=mentorship]').val('');
	$('#usersearch').val('');
	return false;
}


function searchForm() {
	getUserList();
	return false;	
}	

function downloadcvs() {
	
	var usercode			= $('#usercode').val();
	var type					= $('#type :selected').val();
	var mentorship 		= $('#mentorship :selected').val();
	
	window.location = '/reports/users/?action=searchusers&cvs=1&usercode='+usercode+'&type='+type+'&mentorship='+mentorship;
	
	return false;
}

function getUserList() {	
	
	var tblhtml					= '';
	var html 						= ''
	var oUserListTable	= null;	
	
	/* Clear table contants first. */			
	$('.content_table').html('<img src="/images/ajax-loader-2.gif" />');
	
	var usercode			= $('#usercode').val();
	var type					= $('#type :selected').val();
	var mentorship 		= $('#mentorship :selected').val();
	
	$.post("?action=searchusers", {
			usercode		: usercode,
			type				: type,
			mentorship	: mentorship
		},
		function(data) {
			if(data.result) {
			
				var item = null;
				var counter  = 0;
				
				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
					counter = i + 1;
					
					html += '<tr>';		
					html += '<td valign="top">' + counter +'</td>';
					if(item.mentorship_name == 'null' || item.mentorship_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.mentorship_name +'</td>';
					}						
					if(item.user_added == 'null' || item.user_added == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.user_added +'</td>';
					}				
					html += '<td valign="top">' + item.usertype_name +'</td>';
					if(item.partner_name == 'null' || item.partner_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.partner_name +'</td>';
					}
					if(item.area_name == 'null' || item.area_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.area_name +'</td>';
					}						
					html += '<td valign="top">' + item.user_name + ' ' + item.user_surname + '</td>';
					html += '<td valign="top">' + item.user_email +'</td>';
					if(item.user_telephone == 'null' || item.user_telephone == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.user_telephone +'</td>';
					}
					if(item.user_cell == 'null' || item.user_cell == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.user_cell +'</td>';
					}
					if(item.user_race == 'null' || item.user_race == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.user_race +'</td>';
					}		
					if(item.user_last_login == 'null' || item.user_last_login == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.user_last_login +'</td>';
					}						
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th></th><th>Mentorship</th><th>Added</th><th>Type</th><th>Partner</th><th>Area</th><th>Full name</th><th width="15%">Email</th><th>Telephone</th><th>Cell</th><th>Race</th><th>Last Login</th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
			$(".content_table").html(tblhtml);
			
			// $('#content_table').css('width', '100%');
			
			oUserListTable = $('#dataTable').dataTable({					
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",							
				"bSort": true,
				"bFilter": true,
				"bInfo": false,
				"iDisplayLength": 40,
				"bLengthChange": false					
			});				
			 		

			$('#content_table tr td.dataTables_empty').html('There are no items to display.');	

			$('#content_table_filter').hide();
			$('.content_table_filter').hide();		
		
		},
		'json'
	);
	
	return false;
}