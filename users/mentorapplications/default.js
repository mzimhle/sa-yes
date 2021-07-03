$(document).ready(function(){
	
	getMenteeList();
	
	/* Search for mentors. */
	$( "#usersearch").autocomplete({
		source: "/feeds/mentorapp.php",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#smentoridname').html('');
				$('#usercode').val('');					
			} else { 
				$('#smentoridname').html('<b>' + ui.item.value + '</b>');
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
	
	var usercode		= $('#usercode').val();
	var status				= $('#status :selected').val();
	var programme		= $('#programme :selected').val();
	
	$.post("?action=searchmentors", {
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
					count = i +1;
					
					html += '<tr>';		
					html += '<td valign="top" width="10px">' + count +'</td>';					
					if(item.user_image_path != '' && item.user_image_path != 'null' && item.user_image_path != null) {
						html += '<td valign="top" width="5%"><img src="'+item.user_image_path+'tny_'+item.user_image_name+item.user_image_ext+'" /></td>';
					} else {
						html += '<td valign="top" width="5%"><img src="/media/user/avatar.jpg" width="100" height="100" /></td>';
					}
					html += '<td valign="top">' + item.mentorship_name +'</td>';
					html += '<td valign="top">' + item.mentorapp_name + ' ' + item.mentorapp_surname + '</td>';
					html += '<td valign="top">' + item.mentorapp_email + '</td>';
					html += '<td valign="top">' + item.mentorapp_cell + '</td>';
					if(item.menteename == null || item.menteename == 'null') {
						html += '<td valign="top">N/A</td>';									
					} else {
						html += '<td valign="top">' + item.menteename +'</td>';
					}						
					if(item.applicationstatus_code == null || item.applicationstatus_code == 'null') {
						html += '<td valign="top">N/A</td>';									
					} else {
						html += '<td valign="top">' + item.applicationstatus_name +'</td>';									
					}					
					html += '<td valign="top"><a href="/users/mentorapplications/details.php?code='+item.mentorapp_code+'">Details</a></td>';	
					html += '<td valign="top"><a href="/users/mentorapplications/application.php?code='+item.mentorapp_code+'">Application</a></td>';	
					if(item.applicationstatus_code == 'matched') {
					html += '<td valign="top"><button value="Send Login Details" onclick="sendLogin(\''+item.user_code+'\'); return false;">Send Login</button></td>';
					} else {
						html += '<td valign="top">Not Matched</td>';		
					}
					html += '<td valign="top"><button onclick="deleteapp(\''+item.mentorapp_code+'\', \''+item.mentorship_code+'\');">Delete</button></td>';
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th width="5%">Count</th><th width="15%">Image</th><th>Programme</th><th>(prospective) Mentor</th><th  width="18%">Email Address</th><th>Cellphone number</th><th>Mentee</th><th>Status</th><th></th><th></th><th></th><th></th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
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

function sendLogin(id) {
	if(confirm('Are you sure you want to send this mentor his/her login details?')) {
		$.post("?action=sendlogin", {
				usercode : id,
			},
			function(data) {
				if(data.result) {
					alert('Email sent to mentor');
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