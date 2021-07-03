var asInitVals = new Array();
var matchesTable;
$(document).ready(function() {
	
	initDatePickers();
	
	matchesTable = $("#matches").dataTable({
		"sDom" : 'T<"clear">lfrtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_cvs_xls_pdf.swf"
		},
		"oLanguage": {
            "sSearch": "Search all columns:"
        }
	});
	fnEnableSelection(matchesTable);

	var oTable = matchesTable;
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

	// initialize form validation
	// jQuery("#addUserAdmin").validate(getValidationConfig("Admin"));
});
/* Add a click handler to the rows - this could be used as a callback */
function fnEnableSelection(table) {

	var oTable = table;
	var tableId = $(oTable).attr('id');

	$("#" + tableId + " tbody").click(function(event) {
		$(oTable.fnSettings().aoData).each(function() {
			$(this.nTr).removeClass('row_selected');
		});
		$(event.target.parentNode).addClass('row_selected');

		updateTableActions(oTable);
	});
}

function initDatePickers() {
	$( "#matchDate" ).datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1
	});
}

/* Get the rows which are currently selected */
function fnGetSelected(oTableLocal) {
	var aReturn = new Array();
	var aTrs = oTableLocal.fnGetNodes();

	for(var i = 0; i < aTrs.length; i++) {
		if($(aTrs[i]).hasClass('row_selected')) {
			aReturn.push(aTrs[i]);
		}
	}
	return aReturn;
}

/**
 * Updates the activate/delete/edit actions based on the selected row
 *
 * @param table table whose controls should be updated
 */
function updateTableActions(table) {
	var tableId = $(table).attr('id');

	// get selected row
	var selectedRow = fnGetSelected(table);

	var controls = $("#" + tableId + "Controls li").each(function(index, li) {
		$(li).children('input').each(function(index, input) {
			$(this).attr('disabled', false);
			$(this).removeClass('disabled');
		});
	});
}

/**
 * Click handler for delete button
 *
 * @param userType type of user being deleted (mentor, mentee, admin)
 */
function deleteClicked() {
	
	// display confirmation dialog before deleting
	$("#dialog-deleteConfirm").dialog({
		modal: true,
		width: 350,
		buttons: {
			"Delete Match" : function() {

				// get selected row in the table
				var selectedRow = fnGetSelected(matchesTable);
			
				// determine the id of the match to be deleted
				var matchId = $(selectedRow).attr('id');
				var idx = matchId.lastIndexOf('row');
				matchId = matchId.substr(idx + 3);
			
				// delete the user
				deleteMatch(matchId);
				
				// close the dialog
				$(this).dialog('close');
			},
			Cancel : function() {
				$(this).dialog('close');
			}
		}
	});
}

/**
 * Calls the delete match function on the server. On success, removes the match 
 * from the list in the page.
 * 
 * @param matchId id of the match to delete
 */
function deleteMatch(matchId) {
	var request = $.ajax({
		url : "ajax.php?command=delete",
		type : "POST",
		data : "id=" + matchId + "&type=match&table=matches" ,
		dataType : 'json',
		success : function(data) { deleteMatchSuccess(data);
		},
		error : function(jqXHR, textStatus) { error(jqXHR, textStatus);
		}
	});
}

/**
 * Success handler for deleting a match. Removes the match from the list on the 
 * page.
 * 
 * @param data data object containing the match id
 */
function deleteMatchSuccess(data) {
	if(data.error) {
		alert(data.error);
	} else {
		var matchId = data.id;
		var row = $("#matches_row" + matchId)[0];
		matchesTable.fnDeleteRow(row);
	}
}

/**
 * Click handler for edit button
 */
function editClicked() {
	
	document.forms['editMatch'].reset();
	
	// get table and edit form from user type
	var table = matchesTable;
	var editForm = 'editMatch';
	
	// get the currently selected table row (user to edit)
	var selectedRow = fnGetSelected(table);

	// get the id of the user being edited
	var matchId = $(selectedRow).attr('id');
	var idx = matchId.lastIndexOf('row');
	matchId = matchId.substr(idx + 3);

	// pull out values from the row
	var values = table.fnGetData(selectedRow[0]);

	// set user id
	$("#" + editForm + "Id").val(matchId);

	// put current values into edit form
	$("#mentorNameField").text(values[0]);
	$("#menteeNameField").text(values[1]);
	$("#matchDateField").val(values[2]);
	
	var notes = values[3];
	if (notes != '' && notes != '<pre></pre>') {
		notes = notes.substring(5,notes.length - 6);
		$('#matchNotesField').val(notes);
	}
	
	// display edit box
	$("#" + editForm + "Form").dialog({
		width : 500,
		modal : true,
		buttons : {
			"Update Match" : function() {
				updateMatch();
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});
}

/**
 * Calls the update match function on the server.
 */
function updateMatch() {

	var matchId = document.forms['editMatchForm']['matchId'].value;
	var matchDate = document.forms['editMatchForm']['matchDate'].value;
	var matchNotes = document.forms['editMatchForm']['notes'].value;
	
	// build data string for ajax call
	var params = 'id=' + matchId + '&matchDate=' + matchDate + "&notes=" + matchNotes;
	
	// make the call to the server
	var request = $.ajax({
		url : "ajax.php?command=updateMatch",
		type : "POST",
		data : params,
		dataType : 'json',
		success : function(data) {
			updateMatchSuccess(data);
		},
		error : function(jqXHR, textStatus) {
			error(jqXHR, textStatus);
		}
	});
}

/**
 * Success handler for the update user function. Displays success message.
 *
 * @param data data object containing the new table row
 * @param formName name of the edit form used to update the user
 */
function updateMatchSuccess(data) {

	if (data.error) {
		alert(data.error);
	} else {

		var mentorName = jQuery("#mentorNameField").text();
		var menteeName = jQuery("#menteeNameField").text();
		var matchDate = document.forms['editMatchForm']['matchDate'].value;
		var matchNotes = document.forms['editMatchForm']['notes'].value;
		
		// convert object to array
		var updated = [mentorName,menteeName,matchDate,'<pre>' + matchNotes + '</pre>'];
		
		// get row index
		var selected = fnGetSelected(matchesTable);
		var index = matchesTable.fnGetPosition(selected[0]);

		// update data in row
		matchesTable.fnUpdate(updated, index);
		
		$("#editMatchForm").dialog('close');
	}
}

/**
 * Calls the add match function on the server. 
 */
function addMatch() {
	var mentor = document.forms['addMatch']['mentor'].value;
	var mentee = document.forms['addMatch']['mentee'].value;
	var matchDate = document.forms['addMatch']['matchDate'].value;
	var notes = document.forms['addMatch']['notes'].value;

	// make the call to the server
	var request = $.ajax({
		url : "ajax.php?command=addMatch",
		type : "POST",
		data : "mentor=" + mentor + "&mentee=" + mentee + "&matchDate=" + matchDate + "&notes=" + notes,
		dataType : 'json',
		success : function(data) { addMatchSuccess(data);},
		error : function(jqXHR, textStatus) { error(jqXHR, textStatus);}
	});
}

/**
 * Success handler for the add match function. Adds the match to the matches table.
 * 
 * @param data data object containing the new table row
 */
function addMatchSuccess(data) {
	if (data.error) {
		alert(data.error);
	} else {
		
		// add new row
		var oSettings = matchesTable.fnSettings();
		var aiAdded = matchesTable.fnAddData(data.match);
		var row = oSettings.aoData[aiAdded[0]].nTr;

		// set row id
		var tableId = matchesTable.attr('id');
		var rowId = tableId + '_row' + data.matchId;
		$(row).attr('id', rowId);
		
		// reset fields
		$("#matchDate").val("");
		$("#notes").val("");
		
		// $("#matches").append(data.html);
	}
}