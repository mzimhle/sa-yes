var asInitVals = new Array();
var meetingsTable;
$(document).ready(function() {
	
	$("#meetingTime").timepicker({});
	$("#meetingTimeEdit").timepicker({});
	
	initDatePickers();
	initTables();
	initValidation();
	
	// change listener for displaying the status options list 
	$("input[name='status']").change(function() {
		var value = $("input[name='status']:checked").val();
		toggleReasonOpts('status','statusReasonOpts','statusReasonOther');
		toggleYesFields('status','statusYesItems','typeOpts','withStaffYes');
	});
	$("input[name='meetingStatus']").change(function() {
		toggleReasonOpts('meetingStatus','statusReasonOptsEdit','statusReasonOtherEdit');
		toggleYesFields('meetingStatus','statusYesItemsEdit','typeOptsEdit','withStaffYesEdit');
	});
	
	// change listener for displaying the other reason field
	$("#statusReasonOpts").change(function() {
		toggleOtherReasonField("statusReasonOpts","statusReasonOther");
	});
	$("#statusReasonOptsEdit").change(function() {
		toggleOtherReasonField("statusReasonOptsEdit","statusReasonOtherEdit")
	});
	
	
});

/**
 * Initializes the date picker for meeting date
 */
function initDatePickers() {
	$( "#meetingDate" ).datepicker({
		dateFormat: 'yy-mm-dd',
		constrainInput: true,
		firstDay: 1
	});
	$( "#meetingDateField" ).datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1
	});
}

/**
 * Initializes the meetings table
 */
function initTables() {
	
	insertDetailsColumn('meetings');
	
	// define hidden columns
	var hiddenCols = hiddenCols = [3,4,5,6,8];
	var isAdminPage = $('.adminMeetings').length > 0;
	if (isAdminPage) {
		hiddenCols = [5,6,7,8,10,11,12];
	}
	
	meetingsTable = $("#meetings").dataTable({
		"oLanguage": {
            "sSearch": "Search all columns:"
       },
       "sDom" : 'T<"clear">l<"#tam">frtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_csv_xls_pdf.swf"
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
	fnEnableSelection(meetingsTable);

	initDetailsListeners('meetings',meetingsTable);
	initFilters(meetingsTable);
	
	if (isAdminPage) {
		initToggleInactive();
	}
}

/**
 * Provides the markup for the details display
 */
function fnFormatDetails ( oTable, nTr )
{
    var aData = oTable.fnGetData( nTr );
    
    // check to see if this is the admin or user meetings page
    var isAdminPage = $('.adminMeetings').length > 0;
    
    var meetingType = aData[3];
    var withStaff = aData[4];
    var startTime = aData[5];
    var length = aData[6];
    var notes = aData[8];
    
    if (isAdminPage) {
    	meetingType = aData[5];
    	withStaff = aData[6];
    	startTime = aData[7];
    	length = aData[8];
    	notes = aData[10];
    	adminNotes = aData[11];
    }
    
    var sOut = '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">';
    sOut += '<tr><td class="detailsHeader">Meeting Type:</td><td>'+meetingType+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">With Staff:</td><td>'+withStaff+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">Start Time:</td><td>'+startTime+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">Length:</td><td>'+length+'</td></tr>';
    sOut += '<tr><td class="detailsHeader">Mentor Notes:</td><td>'+notes+'</td></tr>';
    if (isAdminPage) {
	    sOut += '<tr><td class="detailsHeader">Admin Notes:</td><td id="' + nTr.id + 'AdminNotes">'+adminNotes;
    	sOut += '<input class="button activate" type="button" onclick="addNotesClicked(\'' + nTr.id + '\')" value="Add/Edit Notes" />';
	    sOut += '</td></tr>';
    }
    sOut += '</table>';
    
     
    return sOut;
}

/**
 * Sets up the row filters for the table.
 * 
 * @param oTable data table to add filters to
 */
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

/**
 * Sets up validation for the add and edit meeting forms
 */
function initValidation() {
	jQuery("#addMeeting").validate({
		submitHandler : function(form) {
			addMeeting();
		},
		rules : {
			date : { required: true },
			length: { number: true  }
		},
		messages : {
			date : "Please enter the meeting date"
		}
	});
	jQuery("#editMeetingForm").validate({
		submitHandler : function(form) {
			updateMeeting();
		},
		rules : {
			date : "required"
		},
		messages : {
			date : "Please enter the meeting date"
		},
		wrapper : "div"
	});
}

function getValidationConfig(passwordId) {
	var config = {
		submitHandler : function(form) {
			updateUser(form.name);
		},
		rules : {
			firstname : "required",
			lastname : "required",
			password2 : {
				equalTo : "#" + passwordId
			},
			email : {
				required : true,
				email : true
			}
		},
		messages : {
			firstname : "Please enter your first name",
			lastname : "Please enter your last name",
			password2 : {
				equalTo : "Please enter the same password as above"
			},
			email : "Please enter a valid email address"
		}
	};
	
	return config;
}

function resetReasonFields(optsFieldId,otherFieldId) {
	$("#" + optsFieldId + " option[value='Holiday']").attr('selected','selected');
	$("#" + optsFieldId + "Wrap").hide();

	resetOtherReasonField(otherFieldId);
}


function resetOtherReasonField(otherFieldId) {
	$("#" + otherFieldId).val("");
	$("#" + otherFieldId + "Wrap").hide();	
}

function toggleReasonOpts(statusFieldName,optsFieldId,otherFieldId) {
	if ($("input[name='" + statusFieldName + "']:checked").val() == 0) {
		$("#" + optsFieldId + "Wrap").show();
	} else {
		resetReasonFields(optsFieldId,otherFieldId);
	}
}

function toggleYesFields(statusFieldName,yesFieldsId,optsFieldId,withStaffFieldId) {
	if ($("input[name='" + statusFieldName + "']:checked").val() == 0) {
		$("#" + yesFieldsId).hide();
		
		// reset fields
		$("#meetingTime").val('');
		$("#meetingLength").val('');
		$("#" + optsFieldId + " option[value='In Person']").attr('selected','selected');
		$("#" + withStaffFieldId).attr('checked','checked');
	} else {
		$("#" + yesFieldsId).show();
	}
}

function toggleOtherReasonField(optsFieldId,otherFieldId) {
	$("#" + optsFieldId + " option:selected").each(function() {
		if ($(this).val().indexOf("Other") == 0) {
			$("#" + otherFieldId + "Wrap").show();
		} else {
			resetOtherReasonField(otherFieldId)
		}
	});
}

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
			"Delete Meeting" : function() {

				// get selected row in the table
				var selectedRow = fnGetSelected(meetingsTable);
			
				// determine the id of the match to be deleted
				var meetingId = $(selectedRow).attr('id');
				var idx = meetingId.lastIndexOf('row');
				meetingId = meetingId.substr(idx + 3);
			
				// delete the user
				deleteMeeting(meetingId);
				
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
 * Calls the delete meeting function on the server. 
 */
function deleteMeeting(meetingId) {
	var request = $.ajax({
		url : "ajax.php?command=delete",
		type : "POST",
		data : "id=" + meetingId + "&type=meeting",
		dataType : 'json',
		success : function(data) { meetingDeleteSuccess(data);
		},
		error : function(jqXHR, textStatus) { error(jqXHR, textStatus);
		}
	});
}

/**
 * Success handler for the delete meeting function. Removes the deleted row from
 * the table
 * 
 * @param data data object containing the id of the deleted row
 */
function meetingDeleteSuccess(data) {
	if (data.error) {
		alert(data.error);
	} else {
		var meetingId = data.id;
		var row = $("#meetings_row" + meetingId)[0];
		meetingsTable.fnDeleteRow(row);
	}
}

/**
 * Click handler for edit button
 */
function editClicked() {
	
	document.forms['editMeeting'].reset();
	
	// get table and edit form from user type
	var table = meetingsTable;
	var editForm = 'editMeeting';
	
	// get the currently selected table row (user to edit)
	var selectedRow = fnGetSelected(table);

	// get the id of the user being edited
	var meetingId = $(selectedRow).attr('id');
	var idx = meetingId.lastIndexOf('row');
	meetingId = meetingId.substr(idx + 3);

	// pull out values from the row
	var values = table.fnGetData(selectedRow[0]);
	var date = values[1];
	var status = values[2];
	var meetingType = values[3];
	var withStaff = values[4];
	var startTime = values[5];
	var length = values[6];
	var reason = values[7];
	var notes = values[8];

	// set user id
	$("#" + editForm + "Id").val(meetingId);

	// put current values into edit form
	$("#meetingDateField").val(date);
	if (status == "Yes") {
		$("#meetingStatusYes").attr('checked','checked');
	} else {
		$("#meetingStatusNo").attr('checked','checked');
		$("#statusReasonOptsEditWrap").show();
		
		// hide the "yes" fields
		$("#statusYesItemsEdit").hide();
	}
	
	// set the meeting type
	if (meetingType != '') {
		$("#typeOptsEdit option[value^='" + meetingType + "']").attr('selected','selected');
	}
	
	// set 'with staff'
	if (withStaff == 'No') {
		$('#withStaffNoEdit').attr('checked','checked');
	} else {
		$('#withStaffYesEdit').attr('checked','checked');
	}
	
	// set the start time
	if (startTime != '') {
		$('#meetingTimeEdit').val(startTime);
	}
	
	// set the length
	if (length != '') {
		$('#meetingLengthEdit').val(length);
	}
	
	// set reason fields
	if (reason.indexOf('[Other]') == 0) {
		$("#statusReasonOptsEdit option[value^='Other']").attr('selected','selected');

		// parse out "other" reason
		var other = reason.substr(8);
		$("#statusReasonOtherEdit").val(other);
		$("#statusReasonOtherEditWrap").show();
		
	} else {
		$("#statusReasonOptsEdit option[value='" + reason + "']").attr('selected','selected');
		$("#statusReasonOtherEdit").val('');
		$("#statusReasonOtherEditWrap").hide();
	}
	
	// set the notes
	if (notes != '' && notes != '<pre></pre>') {
		notes = notes.substring(5,notes.length - 6);
		$('#meetingNotesEdit').val(notes);
	}
	
	$('#meetingStatusYes').focus();
	
	// display edit box
	$("#" + editForm + "Form").dialog({
		title: "Edit Meeting",
		width : 500,
		modal : true,
		buttons : {
			"Update Meeting" : function() {
				updateMeeting();
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});
}

/**
 * Calls the update meeting function on the server.
 */
function updateMeeting() {

	var meetingId = document.forms['editMeetingForm']['meetingId'].value;
	var meetingDate = document.forms['editMeetingForm']['meetingDate'].value;
	var meetingStatus = $("input[name='meetingStatus']:checked").val();

	var statusReason = $("#statusReasonOptsEdit option:selected").val();
	
	// if other, get additional reason
	var otherReason = '';
	if (statusReason.indexOf('Other') == 0) {
		otherReason = document.forms['editMeetingForm']['statusReasonOther'].value;
		statusReason = '[Other] ' + otherReason;
	}
	
	// if status is yes, clear reason fields
	if (meetingStatus == 1) {
		statusReason = '';
		otherReason = '';
	}
	
	var meetingType = document.forms['editMeetingForm']['typeOpts'].value;
	var startTime = document.forms['editMeetingForm']['time'].value;
	var length = document.forms['editMeetingForm']['length'].value;
	var withStaff = $("input[name='withStaffEdit']:checked").val();
	
	var notes = document.forms['editMeetingForm']['notes'].value;

	// build data string for ajax call
	var params = 'id=' + meetingId + '&date=' + meetingDate + 
			'&status=' + meetingStatus + '&reason=' + statusReason + 
			'&startTime=' + startTime + '&length=' + length +
			'&meetingType=' + meetingType + '&withStaff=' + withStaff + 
			'&notes=' + notes;
	
	// make the call to the server
	var request = $.ajax({
		url : "ajax.php?command=updateMeeting",
		type : "POST",
		data : params,
		dataType : 'json',
		success : function(data) {
			// convert status and 'with staff' to human readable form
			if (meetingStatus == 0) { meetingStatus = 'No'; } else { meetingStatus = 'Yes'; }
			if (withStaff == 0) { withStaff = 'No'; } else { withStaff = 'Yes'; }
			
			// ensure notes are wrapped in pre tags
			notes = '<pre>' + notes + '</pre>';
			
			var updated = [meetingDate,meetingStatus,meetingType,withStaff,startTime,length,statusReason,notes];
			updateMeetingSuccess(data,updated);
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
function updateMeetingSuccess(data,updated) {

	if (data.error) {
		alert(data.error);
	} else {

		// var meetingDate = document.forms['editMeetingForm']['meetingDate'].value;
// 		
		// // convert status to human readable form
		// if (meetingStatus == 0) {
			// meetingStatus = 'No';
		// } else {
			// meetingStatus = 'Yes';
		// }
// 		
		// // convert object to array
		// var updated = [meetingDate,meetingStatus,statusReason];
		
		// get row index
		var selected = fnGetSelected(meetingsTable)[0];
		var index = meetingsTable.fnGetPosition(selected);

		// get details column value to insert into updated array
		var detailsCell = selected.childNodes[0];
		var detailsIcon = detailsCell.innerHTML;
		updated.splice(0,0,detailsIcon);

		// update data in row
		meetingsTable.fnUpdate(updated, index);
		
		// update details display, if necessary
		var isOpen = meetingsTable.fnIsOpen(selected);
		if (isOpen) {
			meetingsTable.fnOpen( selected, fnFormatDetails(meetingsTable, selected), 'details' );
		}
		
		$("#editMeetingForm").dialog('close');
	}
}

/**
 * Calls the add meeting function on the server. 
 */
function addMeeting() {
	
	var data = "";
	
	var date = document.forms['addMeeting']['date'].value;
	data = "date=" + date;

	// get status
	var status = 0;
	if (document.forms['addMeeting']['status'][0].checked) {
		status = 1;
	}
	data += "&status=" + status;
	
	// if no meeting, get reason
	var reason = '';
	if (status == 0) {
		// check for options
		reason = $("#statusReasonOpts option:selected").val();
		
		if (reason == "Other") {
			reason = "[Other] " + $("#statusReasonOther").val();
		}
		
		data += "&reason=" + reason;
	} else {
		
		// get start time
		var startTime = document.forms['addMeeting']['time'].value;
		data += "&startTime=" + startTime;
		
		// get length
		var length = document.forms['addMeeting']['length'].value;
		data += "&length=" + length;
		
		// get meeting type
		var meetingType = $("#typeOpts option:selected").val();
		data += "&meetingType=" + meetingType;
		
		// get 'with staff'
		var withStaff = $("input[name='withStaff']:checked").val();
		data += "&withStaff=" + withStaff;
	}
	
	// get notes
	var notes = document.forms['addMeeting']['notes'].value;
	data += "&notes=" + notes;
	
	// make the call to the server
	var request = $.ajax({
		url : "ajax.php?command=addMeeting",
		type : "POST",
		data : data,
		dataType : 'json',
		success : function(data) { addMeetingSuccess(data);},
		error : function(jqXHR, textStatus) { error(jqXHR, textStatus);}
	});
}

/**
 * Success handler for the add meeting function. Adds the meeting to the 
 * meetings table.
 * 
 * @param data data object containing the new table row
 */
function addMeetingSuccess(data) {
	if (data.error) {
		alert(data.error);
	} else {
		
		// get the meeting date and insert the details column
		var meeting = data.meeting;
		meeting.splice(0,0,'<img src="' + detailsOpen + '"/>');
		
		// add new row
		var oSettings = meetingsTable.fnSettings();
		var aiAdded = meetingsTable.fnAddData(data.meeting);
		var row = oSettings.aoData[aiAdded[0]].nTr;

		// set row id
		var tableId = meetingsTable.attr('id');
		var rowId = 'meetings_row' + data.meetingId;
		$(row).attr('id', rowId);
		
		// clear add fields
		document.forms['addMeeting'].reset();
		resetReasonFields('statusReasonOpts','statusReasonOther');
	}
}

/**
 * Click handler for add notes button
 */
function addNotesClicked(rowId) {
	
	document.forms['addAdminNotes'].reset();
	
	// get table and edit form from user type
	var table = meetingsTable;
	
	// get the row to add notes to
	var selectedRow = document.getElementById(rowId);

	// pull out values from the row
	var meeting = table.fnGetData(selectedRow);
	var notes = meeting[11];

	// set user id
	var meetingId = rowId.substr(3,rowId.length-1);
	$("#addNotesId").val(meetingId);

	// set the notes
	if (notes != '' && notes != '<pre></pre>') {
		notes = notes.substring(5,notes.length - 6);
		$('#addAdminNotesField').val(notes);
	} else {
		$('#addAdminNotesField').val('');	
	}
	
	// display edit box
	$("#addAdminNotes").dialog({
		title: "Add/Edit Admin Notes",
		width : 450,
		modal : true,
		buttons : {
			"Update Notes" : function() {
				
				var theMeeting = meeting;
				var theRow = selectedRow;
					
				var newNotes = document.forms['addAdminNotes']['adminNotes'].value;
				var data = 'id=' + meetingId;
				data += '&notes=' + newNotes;	
					
				// make the call to the server
				var request = $.ajax({
					url : "ajax.php?command=addMeetingNotes",
					type : "POST",
					data : data,
					dataType : 'json',
					success : function(data) { 
					
						// get row index
						var index = meetingsTable.fnGetPosition(theRow);

						// prepare notes for display
						theMeeting[11] = '<pre>' + newNotes + '</pre>';			
				
						// update data in row
						meetingsTable.fnUpdate(theMeeting, index);
					
						// update the displayed notes
						meetingsTable.fnOpen( theRow, fnFormatDetails(meetingsTable, theRow), 'details' );
					},
					error : function(jqXHR, textStatus) { error(jqXHR, textStatus);}
				});
				
				$(this).dialog("close");
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});
}

/**
 * Inserts the checkbox for toggling the visibility of meetings owned by inactive mentors.
 * 
 * This function is written to worth with the admin meeting table only.
 */
function initToggleInactive() {
	
	// create checkbox
	var checkbox = document.createElement('input');
	jQuery(checkbox).attr('type','checkbox');
	jQuery(checkbox).attr('name','tamCheck');
	jQuery(checkbox).change(function() {
		var checked = jQuery(checkbox).attr('checked');
		if (checked) {
			meetingsTable.fnFilter('',12);
			meetingsTable.fnFilter('');
		} else {
			meetingsTable.fnFilter(1,12);
		}
	});
	
	// create label
	var label = document.createElement('label');
	jQuery(label).attr('for','tamCheck');
	jQuery(label).attr('title','Show meetings owned by archived mentors');
	jQuery(label).text('Show Archived');
	
	// a div with the id "tam" is inserted during table initialization
	jQuery('#tam').append(checkbox, label);
	
	// perform initial filter
	meetingsTable.fnFilter(1,12);
}
