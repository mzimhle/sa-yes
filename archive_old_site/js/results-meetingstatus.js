$(document).ready(function() {

	// init summary table
	var resultsTable = $("#summary").dataTable({
		"sDom" : 't',
		"bSort" : false,
		"bPaginate" : false,
		"bFilter" : false,
		"aoColumnDefs": [
        	// widths
        	{ 'sWidth': '22em', 'aTargets' : [0] }
		]
	});
	
	/*
	// init users table
	var usersTable = $("#results").dataTable({
		"sDom" : 'T<"clear">lfrtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
		},
		"aaSorting": [[ 0, "desc" ]],
        "aoColumnDefs": [
        	// widths
        	{ 'sWidth': '3em', 'aTargets' : [0] },
			{ 'sWidth': '10em', 'aTargets' : [2,3,4] }
		],
		"bAutoWidth":false,
		"bPaginate" : false
	});
	initFilters(usersTable);
	*/
	
	initMeetingStatusReportUserTable('resultsMet');
	initMeetingStatusReportUserTable('resultsDidNotMeet');
	initMeetingStatusReportUserTable('resultsDidNotLogIn');
});

function initMeetingStatusReportUserTable(tableId) {
	// init users table
	var usersTable = $("#" + tableId).dataTable({
		"sDom" : 'T<"clear">lrtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
		},
		"aaSorting": [[ 0, "desc" ]],
        "aoColumnDefs": [
        	// widths
        	{ 'sWidth': '3em', 'aTargets' : [0] }
		],
		"bAutoWidth":false,
		"bPaginate" : false
	});
	initFilters(usersTable);
}

var asInitVals = new Array();
function initFilters(oTable) {
	$("tfoot input").keyup( function () {
        /* Filter on the column (the index) of this element */
        oTable.fnFilter( this.value, $("tfoot input").index(this) );
    } );
     
    /*
     * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
     * the footer
     */
    $("tfoot input").each( function (i) {
        asInitVals[i] = this.value;
    } );
     
    $("tfoot input").focus( function () {
        if ( this.className == "search_init" )
        {
            this.className = "";
            this.value = "";
        }
    } );
     
    $("tfoot input").blur( function (i) {
        if ( this.value == "" )
        {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    } );
}