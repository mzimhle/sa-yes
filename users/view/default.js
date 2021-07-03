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
				var count = 0;
				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
					count 	= i +1;
					
					html += '<tr>';																
					html += '<td valign="top">'+count+'</td>';
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
					html += '<td valign="top"><a href="/users/view/details.php?code='+item.user_code+'">' + item.user_name + ' ' + item.user_surname + '</a></td>';
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
					if(item.usertype_code == 2) {
					html += '<td valign="top"><button value="Send Login Details" onclick="sendLogin(\''+item.user_code+'\'); return false;">Send Login Details</button></td>';
					} else {
					html += '<td valign="top"></td>';
					}
					html += '</tr>';
				}
			} else { 
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th>Count</th><th>Added</th><th>Type</th><th>Partner</th><th>Area</th><th>Full name</th><th width="15%">Email</th><th>Telephone</th><th>Cell</th><th>Race</th><th></th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
			$(".content_table").html(tblhtml);
			
			// $('#content_table').css('width', '100%');
			
			oUserListTable = $('#dataTable').dataTable({											
				"bJQueryUI": true,
				"sPaginationType": "full_numbers",							
				"bSort": true,
				"bFilter": true,
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
