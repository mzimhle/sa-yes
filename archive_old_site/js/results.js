$(document).ready(function() {
	
	
	insertDetailsColumn('results');
	
	// define hidden columns
	hiddenCols = [5,6,7,8,10,11];
	
	// init data tables
	var resultsTable = $("#results").dataTable({
		"sDom" : 'T<"clear">lfrtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_cvs_xls_pdf.swf"
		},
		"aaSorting": [[ 1, "desc" ]],
        "aoColumnDefs": [
			// don't sort on the details column
        	{ 'bSortable' : false, 'aTargets' : [0] },
        	
        	// hide columns that will be shown in details
        	{ 'bVisible': false, 'aTargets': hiddenCols },
        	
        	// widths
			{ 'sWidth': '2em', 'aTargets' : [0] },
			{ 'sWidth': '10em', 'aTargets' : [1,2,3] }
		],
		"bAutoWidth":false
	});
	
	initDetailsListeners('results',resultsTable);
});
/**
 * Provides the markup for the details display
 */
function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    
    var meetingType = aData[5];
    var withStaff = aData[6];
    var startTime = aData[7];
    var length = aData[8];
    var notes = aData[10];
    var adminNotes = aData[11];
    
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td class="detailsHeader">Meeting Type:</td><td>'+meetingType+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">With Staff:</td><td>'+withStaff+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">Start Time:</td><td>'+startTime+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">Length (hours):</td><td>'+length+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">Mentor Notes:</td><td>'+notes+'</td></tr>';
	sOut += '<tr><td class="detailsHeader">Admin Notes:</td><td>'+adminNotes+'</td></tr>';
    sOut += '</table>';
     
    return sOut;
}