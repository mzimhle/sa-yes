var mentorsTable;
var menteesTable;
var adminsTable;
$(document).ready(function() {
	// init tab display
	$("#userTabs").tabs();

	// init data tables
	mentorsTable = $("#usersMentor").dataTable({
		"sDom" : 'T<"clear">lfrtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_cvs_xls_pdf.swf"
		},
		"aaSorting": [[ 1, "asc" ]]
	});
	fnEnableSelection(mentorsTable);
	menteesTable = $("#usersMentee").dataTable({
		"sDom" : 'T<"clear">lfrtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_cvs_xls_pdf.swf"
		},
		"aaSorting": [[ 1, "asc" ]]
	});
	fnEnableSelection(menteesTable);
	adminsTable = $("#usersAdmin").dataTable({
		"sDom" : 'T<"clear">lfrtip',
		"oTableTools" : {
			"sSwfPath" : "js/extras/TableTools/media/swf/copy_cvs_xls_pdf.swf"
		},
		"aaSorting": [[ 1, "asc" ]]
	});
	fnEnableSelection(adminsTable);

	// initialize form validation
	jQuery("#addUserAdmin").validate(getValidationConfig("Admin"));
	jQuery("#addUserMentee").validate(getValidationConfig("Mentee"));
	jQuery("#addUserMentor").validate(getValidationConfig("Mentor"));
	jQuery("#editMentorForm").validate(getEditValidationConfig("passwordEditMentor"));
	jQuery("#editMenteeForm").validate(getEditValidationConfig("passwordEditMentee"));
	jQuery("#editAdminForm").validate(getEditValidationConfig("passwordEditAdmin"));
	jQuery("#editUserSelfForm").validate(getEditValidationConfig("passwordEditSelf"));
	
	// initialize date pickers
	$( "#joinDate" ).datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1
	});
	$( "#joinDateEdit" ).datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1
	});
	$( "#joinDateMentee" ).datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1
	});
	$( "#joinDateEditMentee" ).datepicker({
		dateFormat: 'yy-mm-dd',
		firstDay: 1
	});
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

	// check for activated/deactivated
	var active = !$(selectedRow).hasClass('deactivated');

	var controls = $("#" + tableId + "Controls li").each(function(index, li) {
		if(index == 0) {
			// activate/deactivate

			if(active) {
				$(li).children('input').each(function(index, input) {
					$(this).val('Deactivate')
					$(this).attr('disabled', false);
					$(this).removeClass('disabled');
				});
			} else {
				$(li).children('input').each(function(index, input) {
					$(this).val('Activate')
					$(this).attr('disabled', false);
					$(this).removeClass('disabled');
				});
			}
		} else if(index == 1) {
			$(li).children('input').each(function(index, input) {
				$(this).attr('disabled', false);
				$(this).removeClass('disabled');
			});
		} else if(index == 2) {
			$(li).children('input').each(function(index, input) {
				$(this).attr('disabled', false);
				$(this).removeClass('disabled');
			});
		}
	});
}

/**
 * Calls the deactivate user function on the server.
 *
 * @param userId id of the user to activate
 * @param tableId id of the table containing the user to activate
 * @param row table row element
 */
function deactivateUser(userId, table, row) {
	
	var tableId = $(table).attr('id');
	
	var request = $.ajax({
		url : "ajax.php?command=deactivate",
		type : "POST",
		data : "userId=" + userId + "&type=user&active=false",
		dataType : 'json',
		success : function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				$(row).addClass('deactivated');
				updateTableActions(table);
			}
		},
		error : function(jqXHR, textStatus) {
			error(jqXHR, textStatus);
		}
	});
}

/**
 * Click handler for activate/deactivate button
 *
 * @param userType type of user being activated/deactivate (mentor, mentee, admin)
 */
function activateClicked(userType) {
	
	var table = getTable(userType);
	
	var selectedRow = fnGetSelected(table);
	
	var userId = $(selectedRow).attr('id');
	var idx = userId.lastIndexOf('row');
	userId = userId.substr(idx + 3);

	if($(selectedRow).hasClass('deactivated')) {
		activateUser(userId,table,selectedRow);
	} else {
		deactivateUser(userId,table,selectedRow);
	}

}

/**
 * Calls the activate user function on the server.
 *
 * @param userId id of the user to activate
 * @param tableId id of the table containing the user to activate
 * @param row table row element
 */
function activateUser(userId, table, row) {
	
	var tableId = $(table).attr('id');
	
	var request = $.ajax({
		url : "ajax.php?command=activate",
		type : "POST",
		data : "userId=" + userId + "&type=user&active=true",
		dataType : 'json',
		success : function(data) {
			if (data.error) {
				alert(data.error);
			} else {
				$(row).removeClass('deactivated');
				updateTableActions(table);
			}
		},
		error : function(jqXHR, textStatus) {
			error(jqXHR, textStatus);
		}
	});
}

/**
 * Click handler for delete button
 *
 * @param userType type of user being deleted (mentor, mentee, admin)
 */
function deleteClicked(userType) {
	
	// display confirmation dialog before deleting
	$("#dialog-deleteConfirm").dialog({
		modal: true,
		width: 350,
		buttons: {
			"Delete User" : function() {
				// get current table
				var table = getTable(userType);
				
				// get selected row in the table
				var selectedRow = fnGetSelected(table);
			
				// determine the id of the user to be deleted
				var userId = $(selectedRow).attr('id');
				var idx = userId.lastIndexOf('row');
				userId = userId.substr(idx + 3);
			
				// get the id of the table
				var tableId = $(table).attr('id');
				
				// delete the user
				deleteUser(userId, tableId);
				
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
 * Calls the delete user function on the server. On success, removes the user
 * from the list in the page.
 *
 * @param userId id of the user to delete
 * @param tableId id of the table containing the user to delete
 */
function deleteUser(userId, tableId) {
	var request = $.ajax({
		url : "ajax.php?command=delete",
		type : "POST",
		data : "id=" + userId + "&table=" + tableId + "&type=user",
		dataType : 'json',
		success : function(data) {
			deleteUserSuccess(data);
		},
		error : function(jqXHR, textStatus) {
			error(jqXHR, textStatus);
		}
	});
}

/**
 * Success handler for deleting a user. Removes the user from the list on the
 * page.
 *
 * @param data data object containing the user id
 */
function deleteUserSuccess(data) {
	if(data.error) {
		alert(data.error);
	} else {
		var tableId = data.tableId;
		var userId = data.id;

		var row = $("#" + tableId + "_row" + userId)[0];
		$('#' + tableId).dataTable().fnDeleteRow(row);
	}
}

/**
 * Click handler for edit button
 *
 * @param table table whose selected row should be edited
 */
function editClicked(userType) {
	
	// get table and edit form from user type
	var table = getTable(userType);
	var editForm = getEditForm(userType);
	
	// get the currently selected table row (user to edit)
	var selectedRow = fnGetSelected(table);

	// get the id of the user being edited
	var userId = $(selectedRow).attr('id');
	var idx = userId.lastIndexOf('row');
	userId = userId.substr(idx + 3);

	// pull out values from the row
	var values = table.fnGetData(selectedRow[0]);

	// set user id
	$("#" + editForm + "Id").val(userId);

	// put current values into edit form
	$("#" + editForm + "Fields").children('p').children(':input').each(function(index, input) {
		// if($(input).attr('type') == "text" || $(input).attr('type') == "password") {
		if ($(input).attr('type') != 'button') {
			
			var value = values[index];
			if (value && value.indexOf('<pre>') == 0) {
				value = value.substring(5,value.length - 6);
			}
			$(input).val(value);
		}
		// }
	});
	
	// display edit box
	$("#" + editForm + "Form").dialog({
		title: "Edit User",
		width : 500,
		modal : true,
		buttons : {
			"Update User" : function() {
				jQuery("#" + editForm + "Form").submit();
			},
			Cancel : function() {
				$(this).dialog("close");
			}
		}
	});
}

/**
 * Returns the data table for the given user type
 * 
 * @param userType type of user (mentor, mentee, admin)
 * @return data table object for the user type
 */
function getTable(userType) {
	if (userType == "mentor") {
		return mentorsTable;
	} else if (userType == "mentee") {
		return menteesTable;
	} else if (userType == "admin") {
		return adminsTable;
	}
}

/**
 * Returns the name of the edit form for the given user type
 * 
 * @param userType type of user (mentor, mentee, admin)
 * @return name of the edit form for the user type
 */
function getEditForm(userType) {
	if (userType == "mentor") {
		 return "editMentor";
	} else if (userType == "mentee") {
		 return "editMentee";
	} else if (userType == "admin") {
		return "editAdmin";
	}
}

/**
 * Calls the update user function on the server.
 * 
 * @param formName name of the form to pull values from
 */
function updateUser(formName) {

	var values = '';
	if (formName == "editMentor") {
		values = getEditValues_Mentor();
	} else if (formName == "editMentee") {
		values = getEditValues_Mentee();
	} else if (formName == "editAdmin") {
		values = getEditValues_Admin();
	} else if (formName == "editUserSelf") {
		values = getEditValues('editUserSelf');
	}
	
	// build data string for ajax call
	var params = '';
	for (var val in values) {
		if (val == "password") {
			if (values[val] != null && values[val] != '') {
				params += val + '=' + values[val] + '&';
			} 
		} else {
			params += val + '=' + values[val] + '&';
		}
	}
	
	// remove trailing &
	params = params.substring(0,params.length-1);
	
	// make the call to the server
	var request = $.ajax({
		url : "ajax.php?command=updateUser",
		type : "POST",
		data : params,
		dataType : 'json',
		success : function(data) {
			updateUserSuccess(data,formName);
		},
		error : function(jqXHR, textStatus) {
			error(jqXHR, textStatus);
		}
	});
}

/**
 * Returns the values from the user edit form. Values are a returned as an 
 * object where the property names are the parameter names expected by the 
 * server in the update user call.
 */
function getEditValues_Mentor(ignoreEmpty) {
	var values = getEditValues('editMentor');
	values['userType'] = 'mentor';
	
	var joinDate = document.forms['editMentor']['date'].value;
	values['date'] = joinDate;
	
	return values;
}

/**
 * Returns the values from the mentee edit form. Values are a returned as an 
 * object where the property names are the parameter names expected by the 
 * server in the update user call.
 */
function getEditValues_Mentee() {
	
	var values = getEditValues('editMentee');
	values['userType'] = 'mentee';
	
	var home = document.forms['editMentee']['home'].value;
	values['home'] = home;	
	
	var homeDetails = document.forms['editMentee']['homeDetails'].value;
	values['homeDetails'] = homeDetails;
	
	var joinDate = document.forms['editMentee']['date'].value;
	values['date'] = joinDate;
	
	return values;	
}

/**
 * Returns the values from the admin edit form. Values are a returned as an 
 * object where the property names are the parameter names expected by the 
 * server in the update user call.
 */
function getEditValues_Admin() {
	var values = getEditValues('editAdmin');
	values['userType'] = 'admin';
	
	return values;	
}

/**
 * Returns the values from the common fields of a user edit form. Values are a 
 * returned as an object where the property names are the parameter names 
 * expected by the server in the update user call.
 * 
 * @param formName name of the form to pull values from
 */
function getEditValues(formName) {
	
	var values = new Object();
	
	var userId = document.forms[formName]['userId'].value;
	var email = document.forms[formName]['email'].value;
	var fname = document.forms[formName]['firstname'].value;
	var lname = document.forms[formName]['lastname'].value;
	var phone = document.forms[formName]['phone'].value;
	var cphone = document.forms[formName]['cphone'].value;
	var password = document.forms[formName]['password'].value;
	var notes = document.forms[formName]['notes'].value;
	
	values['id'] = userId;
	values['email'] = email;
	values['fname'] = fname;
	values['lname'] = lname;
	values['phone'] = phone;
	values['cphone'] = cphone;
	values['notes'] = notes;
	
	if (password != null && password != '') {
		values['password'] = password;
	}

	// check for home field
	var home = document.forms[formName]['home'];
	if (home != null) {
		home = home.value;
		values['home'] = home;
	}
	
	return values;
}

/**
 * Success handler for the update user function. Displays success message.
 *
 * @param data data object containing the new table row
 * @param formName name of the edit form used to update the user
 */
function updateUserSuccess(data,formName) {

	if (data.error) {
		alert(data.error);
	} else {

		var values = '';
		var order = new Array();
		var table;
		if (formName == "editMentor") {
			values = getEditValues_Mentor();
			order = ['fname','lname','email','phone','cphone','date','notes'];
			table = mentorsTable;			
		} else if (formName == "editMentee") {
			values = getEditValues_Mentee();
			order = ['fname','lname','email','phone','cphone','home','homeDetails','date','notes'];
			table = menteesTable;
		} else if (formName == "editAdmin") {
			values = getEditValues_Admin();
			order = ['fname','lname','email','phone','cphone','notes'];
			table = adminsTable;			
		} else if (formName == "editUserSelf") {
			values = getEditValues('editUserSelf');
			order = ['fname','lname','email','phone','cphone'];
			table = null;
			
			$("#message").text('User information updated successfully.');
			$("#message").show();
		}
		
		// ensure notes are wrapped in pre tags
		if (values['notes']) {
			values['notes'] = '<pre>' + values['notes'] + '</pre>';
		}
		
		// ensure home details are wrapped in pre tags
		if (values['homeDetails']) {
			values['homeDetails'] = '<pre>' + values['homeDetails'] + '</pre>';
		}
		
		if (table != null) {
			
			// convert object to array
			var updated = new Array();
			for (var i = 0; i < order.length; i++) {
				updated.push(values[order[i]]);
			}
			
			// update the table
			updateUserTable(table, updated);
			
			$("#" + formName + "Form").dialog('close');
		}
	}
}

/**
 * Updates the currently selected row in the given table with the values from
 * the given array
 *
 * @param table data table to update
 * @param updated array of values to update the table with
 */
function updateUserTable(table, updated) {
	// get row index
	var selected = fnGetSelected(table);
	var index = table.fnGetPosition(selected[0]);

	// update data in row
	table.fnUpdate(updated, index);
}

/**
 * Calls the add user function on the server.
 */
function addUser(formName) {
	var email = document.forms[formName]['email'].value;
	var fname = document.forms[formName]['firstname'].value;
	var lname = document.forms[formName]['lastname'].value;
	var password = document.forms[formName]['password'].value;
	var group = document.forms[formName]['group'].value;
	var phone = document.forms[formName]['phone'].value;
	var cphone = document.forms[formName]['cphone'].value;
	var notes = document.forms[formName]['notes'].value;

	var data = "email=" + email + "&fname=" + fname + "&lname=" + lname + 
				"&password=" + password + "&group=" + group + "&phone=" + phone + 
				"&cphone=" + cphone + "&notes=" + notes;

	var tableId = '';
	if(formName.indexOf("Mentor") > -1) {
		// var menteeId = document.forms[formName]['mentee'].value;
		// data += "&mentee=" + menteeId;

		var joinDate = document.forms[formName]['date'].value;
		data += "&joinDate=" + joinDate;
		
		tableId = "usersMentor";
	} else if(formName.indexOf("Mentee") > -1) {
		var home = document.forms[formName]['home'].value;
		data += "&home=" + home;
		
		var homeDetails = document.forms[formName]['homeDetails'].value;
		data += "&homeDetails=" + homeDetails;
		
		var joinDate = document.forms[formName]['date'].value;
		data += "&joinDate=" + joinDate;
		
		tableId = "usersMentee";
	} else {
		tableId = "usersAdmin";
	}
	data += "&table=" + tableId;

	// make the call to the server
	var request = $.ajax({
		url : "ajax.php?command=addUser",
		type : "POST",
		data : data,
		dataType : 'json',
		success : function(data) {
			addUserSuccess(data);
		},
		error : function(jqXHR, textStatus) {
			error(jqXHR, textStatus);
		}
	});
}

/**
 * Success handler for the add user function. Displays the new user
 * entry in the table.
 *
 * @param data data object containing the new table row
 */
function addUserSuccess(data) {

	if(data.error) {
		alert(data.error);
	} else {
		var colIdx = 4;
		if (data.userType == "Administrator") {
			document.forms['addUserAdmin'].reset();
		} else if(data.userType == "Mentor") {
			document.forms['addUserMentor'].reset();
		} else if(data.userType == "Mentee") {
			document.forms['addUserMentee'].reset();
		}
		
		// add new row
		var oSettings = $('#' + data.tableId).dataTable().fnSettings();
		var aiAdded = $('#' + data.tableId).dataTable().fnAddData(data.user);
		var row = oSettings.aoData[aiAdded[0]].nTr;

		// set row id
		var rowId = data.tableId + '_row' + data.userId;
		$(row).attr('id', rowId);
	}
}

function getValidationConfig(userType) {
	var config = {
		submitHandler : function(form) {
			addUser('addUser' + userType);
		},
		rules : {
			firstname : "required",
			lastname : "required",
			password : {
				required : true,
				minlength : 5
			},
			password2 : {
				required : true,
				minlength : 5,
				equalTo : "#password" + userType
			},
			email : {
				required : true,
				email : true
			}
		},
		messages : {
			firstname : "Please enter your first name",
			lastname : "Please enter your last name",
			password : {
				required : "Please provide a password",
				minlength : "Your password must be at least 5 characters long"
			},
			confirm_password : {
				required : "Please provide a password",
				minlength : "Your password must be at least 5 characters long",
				equalTo : "Please enter the same password as above"
			},
			email : "Please enter a valid email address"
		}
	};

	return config;
}

function getEditValidationConfig(passwordId) {
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

