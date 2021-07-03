$(document).ready(function(){
	
	getUserList();
	
	/* Search for mentees. */
	$( "#usersearch").autocomplete({
		source: "/feeds/participants.php?type=1",
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

	
	return false;
}


function searchForm() {
	getUserList();
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
	
	$.post("?action=searchusers", {
			usercode		: usercode,
			type					: type
		},
		function(data) {
			if(data.result) {
			
				var item = null;

				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
								
					html += '<tr>';				
					if(item.user_image_path != '' && item.user_image_path != 'null' && item.user_image_path != null) {
						html += '<td valign="top" width="10%"><img src="'+item.user_image_path+'tny_'+item.user_image_name+item.user_image_ext+'" width="100" /></td>';
					} else {
						html += '<td valign="top"><img src="/media/user/avatar.jpg" width="100" /></td>';
					}					
					if(item.user_added == 'null' || item.user_added == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.user_added +'</td>';
					}				
					if(item.area_name == 'null' || item.area_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.area_name +'</td>';
					}						
					html += '<td valign="top"><a href="/users/admins/details.php?code='+item.user_code+'">' + item.user_name + ' ' + item.user_surname + '</a></td>';
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
					html += '<td valign="top"><button value="Send Login Details" onclick="sendLogin(\''+item.user_code+'\'); return false;">Send Login Details</button></td>';
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th></th><th>Added</th><th>Area</th><th>Full name</th><th width="15%">Email</th><th>Telephone</th><th>Cell</th><th>Race</th><th></th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
			$(".content_table").html(tblhtml);
			
			// $('#content_table').css('width', '100%');
			
			oUserListTable = $('#dataTable').dataTable({											
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",							
				"bSort": true,
				"bFilter": false,
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

function sendLogin(id) {
	if(confirm('Are you sure you want to send this administrator his/her login details?')) {
		$.post("?action=sendlogin", {
				usercode : id,
			},
			function(data) {
				if(data.result) {
					alert('Email sent to administrator');
					window.open(data.link,'_blank');		
				} else {
					alert(data.message);
				}					
			},
			'json'
		);
	}
	return false;
}
