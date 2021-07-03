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
	
	/* Search for mentors. */
	$( "#mentorsearch").autocomplete({
		source: "/feeds/participants.php?type=2",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#smentoridname').html('');
				$('#smentorid').val('');					
			} else { 
				$('#smentoridname').html('<b>' + ui.item.value + '</b>');
				$('#smentorid').val(ui.item.id);									
			}				
			$('#mentorsearch').val('');										
		}
	});
	
	/* Search for mentees. */
	$( "#menteesearch").autocomplete({
		source: "/feeds/participants.php?type=3",
		minLength: 2,
		select: function( event, ui ) {
		
			if(ui.item.id == '') {
				$('#smenteeidname').html('');
				$('#smenteeid').val('');					
			} else { 
				$('#smenteeidname').html('<b>' + ui.item.value + '</b>');
				$('#smenteeid').val(ui.item.id);									
			}				
			$('#menteesearch').val('');										
		}
	});	
});

function clearsearch() {
	
	$('#from').val('');
	$('#to').val('');
	$('#mentorsearch').val('');
	$('#smentorid').val('');
	$('#smentoridname').html('');
	$('#menteesearch').val('');
	$('#smenteeid').val('');
	$('#smenteeidname').html('');
	$('[name=meetingstatus]').val('');
	$('[name=type]').val('');
	$('[name=withstaff]').val('');
	
	getMeetingList();
	
	return false;
}


function searchForm() {

	getMeetingList();
	return false;	
}	

function downloadcvs() {
	
	var from					= $('#from').val();
	var to						= $('#to').val();
	var smentorid			= $('#smentorid').val();
	var smenteeid			= $('#smenteeid').val();
	var meetingstatus	= $('#meetingstatus :selected').val();
	var type					= $('#type :selected').val();
	var withstaff			= $('#withstaff :selected').val();
	
	window.location = '/meetings/view/?action=searchmeetings&cvs=1&from='+from+'&meetingstatus='+meetingstatus+'&smenteeid='+smenteeid+'&smentorid='+smentorid+'&to='+to+'&type='+type+'&withstaff='+withstaff;
	
	return false;
}

function deleteitem(id) {
	if(confirm('Are you sure you want to delete this item?')) {
		$.ajax({
				type: "GET",
				url: "default.php",
				data: "code_delete="+id,
				dataType: "json",
				success: function(data){
						if(data.result == 1) {
							alert('Deleted');
							window.location.href = window.location.href;
						} else {
							alert(data.error);
						}
				}
		});								
	}
}	


function getMeetingList() {	
	
	var tblhtml					= '';
	var html 						= ''
	var oMeetingListTable	= null;	
	
	/* Clear table contants first. */			
	$('.content_table').html('<img src="/images/ajax-loader-2.gif" />');
	
	var from			= $('#from').val();
	var to				= $('#to').val();
	var smentorid		= $('#smentorid').val();
	var smenteeid		= $('#smenteeid').val();
	var meetingstatus	= $('#meetingstatus :selected').val();
	var type			= $('#type :selected').val();
	var withstaff		= $('#withstaff :selected').val();
	
	$.post("?action=searchmeetings", {
			from					: from,
			to						: to,
			smentorid		: smentorid,
			smenteeid		: smenteeid,
			meetingstatus	: meetingstatus,
			type					: type,
			withstaff			: withstaff
		},
		function(data) {
			if(data.result) {
			
				var item = null;
				var counter = 0;
				
				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
					counter = i + 1;
					
					html += '<tr>';
					html += '<td valign="top">' + counter +'</td>';
					if(item.meeting_added == 'null' || item.meeting_added == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.meeting_added +'</td>';
					}				
					html += '<td valign="top"><a href="/meetings/view/details.php?code='+item.meeting_code+'">' + item.meeting_date + '</a></td>';
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
					html += '<td valign="top"><button onclick="javascript:deleteitem(\''+item.meeting_code+'\');">delete</button></td>';
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th></th><th>Created Date</th><th>Meeting Date</th><th>Start Time</th><th>Mentor Name</th><th>Mentee Name</th><th>Meeting Status</th><th>Reason</th><th>Type</th><th>With Staff</th><th></th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
			$(".content_table").html(tblhtml);
			
			// $('#content_table').css('width', '100%');
			
			oMeetingListTable = $('#dataTable').dataTable({											
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