$(document).ready(function() {
	initMeetingReport();
	initMeetingStatusReport();
});

function initMeetingReport() {

	// initialize date pickers
	$("#startDate").datepicker({
		dateFormat : 'yy-mm-dd',
		firstDay : 1
	});
	$("#endDate").datepicker({
		dateFormat : 'yy-mm-dd',
		firstDay : 1
	});

	// add change handler for all dates
	$("input[name='alldates']").change(function() {

		if ($(this).is(":checked")) {
			$("input[name='startDate']").attr('disabled', true);
			$("input[name='endDate']").attr('disabled', true);
		} else {
			$("input[name='startDate']").attr('disabled', false);
			$("input[name='endDate']").attr('disabled', false);
		}
	});
}

function initMeetingStatusReport() {

	// Meeting Status Report date pickers
	$("#msrStartDate").datepicker({
		dateFormat : 'yy-mm-dd',
		firstDay : 1
	});
	$("#msrEndDate").datepicker({
		dateFormat : 'yy-mm-dd',
		firstDay : 1
	});

	initDateField($('#msrStartDate'),-7);
	initDateField($('#msrEndDate'));
}

/**
 * Initializes the given date field with the current date, or a date offset from the current date
 * @param {Object} field
 * @param {Integer} offset offset in days from current date. Can be positive or negative.
 */
function initDateField(field, offset) {
	
	// get current time/date in milliseconds
	var milliNow = new Date().valueOf();

	// convert offset to milliseconds
	var milliOffset = 0;
	if (offset !== null && offset !== undefined) {
		milliOffset = offset * 24 * 60 * 60 * 1000;
	}

	// create a date object
	var date = new Date(milliNow + milliOffset);
	var year = date.getFullYear();
	var month = date.getMonth();
	var day = date.getDate();
	
	// ensure month and date have two digits
	month++;
	if (month < 10) {
		month = "0" + month;
	}
	if (day < 10) {
		day = "0" + day;
	}

	// build string yyyy-mm-dd
	var dateStr = year + "-" + month + "-" + day;
	field.val(dateStr);
}
