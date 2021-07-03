$(document).ready(function(){
	
	getMenteeList();
});

function clearsearch() {
	
	$('[name=status]').val('');
	$('[name=programme]').val('');
	$('[name=type]').val('');
	
	return false;
}

function searchForm() {
	getMenteeList();
	return false;	
}	

function getMenteeList() {	
	
	var tblhtml					= '';
	var html 						= ''
	var oMenteeListTable	= null;	
	
	/* Clear table contants first. */			
	$('.content_table').html('<img src="/images/ajax-loader-2.gif" />');
	
	var status		= $('#status :selected').val();
	var programme	= $('#programme :selected').val();
	var type		= $('#type :selected').val();
	
	$.post("?action=searchmembers", {
			programme	: programme,
			type		: type,
			status		: status
		},
		function(data) {
			if(data.result) {
			
				var item = null;
				var count = 0;
				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
					count = i +1;
					
					html += '<tr>';		
					html += '<td valign="top">' + count +'</td>';					
					if(item.user_image_path != '' && item.user_image_path != 'null' && item.user_image_path != null) {
						html += '<td valign="top"><img src="'+item.user_image_path+'tny_'+item.user_image_name+item.user_image_ext+'" /></td>';
					} else {
						html += '<td valign="top"><img src="/media/user/avatar.jpg" width="100" height="100" /></td>';
					}					
					html += '<td valign="top">' + item.mentorship_name +'</td>';
					if(typeof item.mentorapp_name != 'undefined') {
						html += '<td valign="top">mentor</td>';
						html += '<td valign="top">' + item.mentorapp_name + ' ' + item.mentorapp_surname + '</td>';
						if(item.mentorapp_email == null || item.mentorapp_email == 'null') {
							html += '<td valign="top">N/A</td>';
						} else {
							html += '<td valign="top">' + item.mentorapp_email + '</td>';
						}	
						if(item.mentorapp_cell == null || item.mentorapp_cell == 'null') {
							html += '<td valign="top">N/A</td>';
						} else {
							html += '<td valign="top">' + item.mentorapp_cell + '</td>';
						}						
					} else {
						html += '<td valign="top">mentee</td>';
						html += '<td valign="top">' + item.menteeapp_name + ' ' + item.menteeapp_surname + '</td>';
						if(item.menteeapp_email == null || item.menteeapp_email == 'null') {
							html += '<td valign="top">N/A</td>';
						} else {
							html += '<td valign="top">' + item.menteeapp_email + '</td>';
						}	
						if(item.menteeapp_cell == null || item.menteeapp_cell == 'null') {
							html += '<td valign="top">N/A</td>';
						} else {
							html += '<td valign="top">' + item.menteeapp_cell + '</td>';
						}												
					}
					if(item.applicationstatus_code == null || item.applicationstatus_code == 'null') {
						html += '<td valign="top">N/A</td>';									
					} else {
						html += '<td valign="top">' + item.applicationstatus_name +'</td>';									
					}					
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th width="5%">Count</th><th width="15%">Image</th><th>Programme</th><th>Type</th><th width="18%">Fullname</th><th width="18%">Email</th><th>Cellphone</th><th>Status</th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
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