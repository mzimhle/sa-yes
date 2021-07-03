$(document).ready(function(){
	
	getMatchList();

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
	$('#smentorid').val('');
	$('#smenteeid').val('');
	$('#mentorsearch').val('');
	$('#menteesearch').val('');
	$('[name=mentorship]').val('');
	$('[name=partner]').val('');
}

function searchForm() {

	getMatchList();
	return false;	
}	

function downloadcvs() {
	
	var smentorid		= $('#smentorid').val();
	var smenteeid		= $('#smenteeid').val();
	var mentorship	= $('#mentorship :selected').val();
	var partner 			= $('#partner :selected').val();
	
	window.location = '/reports/matches/?action=searchmatches&cvs=1&smenteeid='+smenteeid+'&smentorid='+smentorid+'&mentorship='+mentorship+'&partner='+partner;
	
	return false;
}

function getMatchList() {	
	
	var tblhtml					= '';
	var html 						= ''
	var oMatchListTable	= null;	
	
	/* Clear table contants first. */			
	$('.content_table').html('<img src="/images/ajax-loader-2.gif" />');
	
	var smentorid		= $('#smentorid').val();
	var smenteeid		= $('#smenteeid').val();
	var mentorship	= $('#mentorship :selected').val();
	var partner 			= $('#partner :selected').val();
	
	$.post("?action=searchmatches", {

			smentorid	: smentorid,
			smenteeid	: smenteeid,
			mentorship	: mentorship,
			partner		: partner
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
					if(item.partner_name == 'null' || item.partner_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.partner_name +'</td>';
					}						
					if(item.match_added == 'null' || item.match_added == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.match_added +'</td>';
					}	
					if(item.mentorship_name == 'null' || item.mentorship_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.mentorship_name +'</td>';
					}						
					html += '<td valign="top">' + item.mentorapp_name + ' ' + item.mentorapp_surname + '</td>';
					if(item.menteeapp_name == 'null' || item.menteeapp_name == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.menteeapp_name + ' ' + item.menteeapp_surname + '</td>';
					}						
					if(item.match_notes == 'null' || item. match_notes == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.match_notes + '</td>';
					}
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th></th><th>Partner</th><th>Created Date</th><th>Mentorship</th><th>Mentor Name</th><th>Mentee Name</th><th>Notes</th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
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