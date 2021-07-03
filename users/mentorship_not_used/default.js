$(document).ready(function(){
	
	getUserList();
	
	/* Search for mentees. */
	$( "#usersearch").autocomplete({
		source: "/feeds/participants.php?type=all",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				//$('#smenteeidname').html('');
				$('#usercode').val('');		
				$('#usersearch').val('');				
			} else { 
				//$('#smenteeidname').html('<b>' + ui.item.value + '</b>');
				$('#usercode').val(ui.item.id);									
			}				
			$('#usersearch').val('');	
			$('#usersearch').val('');			
		}
	});	
});

function clearsearch() {
	
	$('#usercode').val('');
	$('#usersearch').val('');
	$('[name=mentorship]').val('');
	$('[name=type]').val('');

	
	return false;
}

function searchForm() {
	getUserList();
	return false;	
}	

function assigntomentorship() {
	
	var mentorship		= $('#assignmentorship :selected').val();
	var users					= '';
	
	$('input[type="checkbox"]').each(function() {
	if ($(this).is(':checked')) {
			users = users + ',' + $(this).attr('value');
		}
	});
	
	if(mentorship != '' && users != '') {	
		if(confirm('Are you sure you want to assign these users to the ' + mentorship+ ' Mentorship Program?')) {
			$.post("?action=assignusers", {
					users			: users,
					mentorship	: mentorship
				},
				function(data) {
					if(data.result) {
						alert('Users have been successfully assiged.');
						clearsearch();
						var mentorship		= $('#mentorship :selected').val(mentorship);
						getUserList();
					} else {
						alert(data.error);
					}
				},
				'json'
			);			
		}
	} else {
		alert('Please select mentorship program as well as users to assign.');
	}
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
	var mentorship		= $('#mentorship :selected').val();
	
	$.post("?action=searchusers", {
			usercode		: usercode,
			type				: type,
			mentorship	: mentorship
		},
		function(data) {
			if(data.result) {
			
				var item = null;

				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
								
					html += '<tr>';																
					if(item.usermentorship_added == 'null' || item.usermentorship_added == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.usermentorship_added +'</td>';
					}
					if(item.mentorship_name == 'null' || item.mentorship_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.mentorship_name +'</td>';
					}							
					html += '<td valign="top">' + item.usertype_name +'</td>';
					if(item.partner_name == 'null' || item.partner_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.partner_name +'</td>';
					}					
					html += '<td valign="top">' + item.user_name + ' ' + item.user_surname + '</td>';
					html += '<td valign="top">' + item.user_email +'</td>';
					if(item.user_cell == 'null' || item.user_cell == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.user_cell +'</td>';
					}
					html += '<td valign="top"><input type="checkbox" value="'+item.user_code+'" /></td>';
					html += '<td valign="top"><button value="De-Activate" onclick="deactivate(\''+item.user_code+'\', \''+item.mentorship_code+'\')">De-Activate</button></td>';
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th>Added</th><th>Mentorship</th><th>Type</th><th>Partner</th><th>Full name</th><th width="15%">Email</th><th>Cell</th><th></th><th></th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
			$(".content_table").html(tblhtml);
			
			// $('#content_table').css('width', '100%');
			
			oUserListTable = $('#dataTable').dataTable({											
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",							
				"bSort": true,
				"bFilter": false,
				"bInfo": false,
				"iDisplayLength": 20,
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

function deactivate(code, mentorship) {

		if(confirm('Are you sure you want to remove this person from the selected year\'s program?')) {
			$.post("?action=deactivate", {
					code			: code,
					mentorship	: mentorship
				},
				function(data) {
					if(data.result) {
						alert('Person has been successfully removed.');
						clearsearch();
						getUserList();
					} else {
						alert(data.error);
					}
				},
				'json'
			);			
		}

}
