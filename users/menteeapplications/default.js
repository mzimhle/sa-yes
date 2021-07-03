$(document).ready(function(){
	
	getMenteeList();
	
	/* Search for mentees. */
	$( "#usersearch").autocomplete({
		source: "/feeds/menteeapp.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#smenteeidname').html('');
				$('#usercode').val('');					
			} else { 
				$('#smenteeidname').html('<b>' + ui.item.value + '</b>');
				$('#usercode').val(ui.item.id);									
			}				
			$('#usersearch').val('');										
		}
	});	
});

function clearsearch() {
	
	$('#usercode').val('');
	$('#usersearch').val('');
	$('[name=status]').val('');
	$('[name=programme]').val('');
	
	return false;
}


function searchForm() {
	getMenteeList();
	return false;	
}	

function deleteapp(appcode, program) {
	if(confirm('Are you sure you want to delete this application?')) {
	$.post("?action=deleteapp", {
			appcode : appcode,
			program : program
		},
		function(data) {
			if(data.result) {
				getMenteeList();
			} else {
				alert(data.message);
			}			
		},
		'json'
	);		
	}
}

function getMenteeList() {	
	
	var tblhtml					= '';
	var html 						= ''
	var oMenteeListTable	= null;	
	
	/* Clear table contants first. */			
	$('.content_table').html('<img src="/images/ajax-loader-2.gif" />');
	
	var usercode		= $('#usercode').val();
	var status				= $('#status :selected').val();
	var programme		= $('#programme :selected').val();
	
	$.post("?action=searchmentees", {
			usercode		: usercode,
			status			: status,
			programme	: programme
		},
		function(data) {
			if(data.result) {
			
				var item = null;
				var count = 0;
				
				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
					count	= i + 1;
					
					html += '<tr>';																
					html += '<td valign="top">' + count +'</td>';
					html += '<td valign="top">' + item.menteeapp_added +'</td>';
					html += '<td valign="top">' + item.mentorship_name +'</td>';
					html += '<td valign="top">' + item.menteeapp_name + ' ' + item.menteeapp_surname + ' ( '+item.partner_name+' )</td>';	
					if(item.user_image_path != '' && item.user_image_path != 'null' && item.user_image_path != null) {
						html += '<td valign="top"><img src="'+item.user_image_path+'tny_'+item.user_image_name+item.user_image_ext+'" /></td>';
					} else {
						html += '<td valign="top"><img src="/media/user/avatar.jpg" width="100" height="100" /></td>';
					}
					html += '<td valign="top">' + item.menteeapp_gender +'</td>';
					html += '<td valign="top">' + item.applicationstatus_name +'</td>';									
					html += '<td valign="top"><a href="/users/menteeapplications/details.php?code='+item.menteeapp_code+'">User Details</a></td>';	
					html += '<td valign="top"><a href="/users/menteeapplications/application.php?code='+item.menteeapp_code+'">User Application</a></td>';	
					html += '<td valign="top"><button onclick="deleteapp(\''+item.menteeapp_code+'\', \''+item.mentorship_code+'\');">Delete</button></td>';
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th>Count</th><th>Added</th><th>Programme</th><th>Full Name</th><th>Image</th><th>Gender</th><th>Status</th><th></th><th></th><th></th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
			$(".content_table").html(tblhtml);
			
			// $('#content_table').css('width', '100%');
			
			oMenteeListTable = $('#dataTable').dataTable({											
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