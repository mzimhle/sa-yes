$(document).ready(function(){
	
	getMeetingList();
	
	/* Setup Date Range. */
	$( "#from" ).datepicker({
		defaultDate: "+1w",
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#to" ).datepicker( "option", "minDate", selectedDate );
		}
	});
	
	$( "#to" ).datepicker({
		defaultDate: "+1w",
		dateFormat: 'yy-mm-dd',
		changeMonth: true,
		numberOfMonths: 3,
		onClose: function( selectedDate ) {
			$( "#from" ).datepicker( "option", "maxDate", selectedDate );
		}
	});
});

function clearsearch() {
	
	$('#from').val('');
	$('#to').val('');
	$('[name=meetingstatus]').val('');
	$('[name=type]').val('');
	$('[name=withstaff]').val('');
	
	return false;
}


function searchForm() {

	getMeetingList();
	return false;	
}

function getMeetingList() {	
	
	var tblhtml					= '';
	var html 						= ''
	var oMeetingListTable	= null;	
	
	/* Clear table contants first. */			
	$('.content_table').html('<img src="/images/ajax-loader-2.gif" />');
	
	var from			= $('#from').val();
	var to				= $('#to').val();
	var meetingstatus	= $('#meetingstatus :selected').val();
	var type			= $('#type :selected').val();
	var withstaff		= $('#withstaff :selected').val();
	
	$.post("?action=searchmeetings", {
			from					: from,
			to						: to,
			meetingstatus	: meetingstatus,
			type					: type,
			withstaff			: withstaff
		},
		function(data) {
			if(data.result) {
			
				var item = null;

				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
								
					html += '<tr>';
					if(item.mentorship_name == 'null' || item.mentorship_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.mentorship_name +'</td>';
					}					
					if(item.meeting_added == 'null' || item.meeting_added == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.meeting_added +'</td>';
					}				
					html += '<td valign="top"><a href="/mentor/meetings/details.php?code='+item.meeting_code+'">' + item.meeting_date + '</a></td>';
					if(item.meeting_starttime == 'null' || item.meeting_starttime == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.meeting_starttime +'</td>';
					}						
					if(item.mentorname == 'null' || item.mentorname == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.mentorname + '</td>';
					}
					if(item.menteename == 'null' || item.menteename == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.menteename + '</td>';
					}
					if(item.meeting_status == '1') {
						html += '<td valign="top">Yes</td>';
					} else {
						html += '<td valign="top">No</td>';
					}
					if(item.meeting_reason == 'null' || item.meeting_reason == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.meeting_reason + '</td>';
					}
					if(item.meetingtype_name == 'null' || item.meetingtype_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.meetingtype_name + '</td>';
					}
					if(item.meeting_staff == '1') {
						html += '<td valign="top">Yes</td>';
					} else {
						html += '<td valign="top">No</td>';
					}
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th>Mentorship</th><th>Created Date</th><th>Meeting Date</th><th>Start Time</th><th>Mentor Name</th><th>Mentee Name</th><th>Meeting Status</th><th>Reason</th><th>Type</th><th>With Staff</th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
			$(".content_table").html(tblhtml);
			
			// $('#content_table').css('width', '100%');
			
			oMeetingListTable = $('#dataTable').dataTable({											
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