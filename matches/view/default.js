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

function deactivate(code) {	
	if(confirm('Are you sure you want to de-activate this match?')) {

			$.ajax({ 
					type: "GET",
					url: "default.php",
					data: "&code_delete="+code,
					dataType: "json",
					success: function(data){
							if(data.result == 1) {
								alert('De-Activated');
								getMatchList();
							} else {
								alert(data.error);
							}
					}
			});								
		}
		return false;
}		

function searchForm() {

	getMatchList();
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

	$.post("?action=searchmatches", {

			smentorid		: smentorid,
			smenteeid		: smenteeid
		},
		function(data) {
			if(data.result) {
			
				var item = null;

				for(var i = 0; i < data.records.length; i++) {

					item 	= data.records[i];
								
					html += '<tr>';
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
					html += '<td valign="top">'+ item.mentorname + '</td>';
					if(item.menteename == 'null' || item.menteename == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.menteename +'</td>';
					}						
					if(item.match_notes == 'null' || item. match_notes == null) {
						html += '<td valign="top"></td>';
					} else {
						html += '<td valign="top">' + item.match_notes + '</td>';
					}
					
					// html += '<td valign="top"><button value="de-activate" onclick="deactivate(\''+item.match_code+'\')">de-activate</button></td>';
					html += '</tr>';
				}
			} else {
				html = '';
			}
			
			tblhtml = '<table id="dataTable" class="display" style="table-layout: fixed"><thead><tr><th>Created Date</th><th>Mentorship</th><th>Mentor Name</th><th>Mentee Name</th><th>Notes</th></tr></thead><tbody id="dataTableContent">'+html+'</tbody></table>';
	
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