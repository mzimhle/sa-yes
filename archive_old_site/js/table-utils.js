// var detailsOpen = '<img src="css/images/details_open.png">';
// var detailsClose = '<img src="css/images/details_close.png">';

var detailsOpen = 'css/images/details_open.png';
var detailsClose = 'css/images/details_close.png';

/**
 * Adds a details column as the first column of the meetings table. Column 
 * contains the expand/collapse icons.
 * 
 * @tableId id of the table to insert the column in
 */
function insertDetailsColumn(tableId) {
	/*
     * Insert a 'details' column to the table
     */
    var nCloneTh = document.createElement( 'th' );
    var nCloneTh2 = document.createElement( 'th' );
    var nCloneTd = document.createElement( 'td' );
    nCloneTd.innerHTML = '<img src="' + detailsOpen + '"/>';
    nCloneTd.className = "center";
     
    $('#' + tableId + ' thead tr').each( function () {
        this.insertBefore( nCloneTh, this.childNodes[0] );
    } );
     
    $('#' + tableId + ' tbody tr').each( function () {
        this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
    } );
    
    $('#' + tableId + ' tfoot tr').each( function () {
        this.insertBefore( nCloneTh2, this.childNodes[0] );
    } );
}

/**
 * Sets up the click listeners for expanding and collapsing the details display
 * 
 * @param tableId id of the table to add listeners to
 * @param oTable data table with details display
 */
function initDetailsListeners(tableId, oTable) {
	/* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    $('#' + tableId + ' tbody td img').live('click', function () {
        var nTr = $(this).parents('tr')[0];
        if ( oTable.fnIsOpen(nTr) )
        {
            /* This row is already open - close it */
            this.src = detailsOpen;
            oTable.fnClose( nTr );
        }
        else
        {
            /* Open this row */
            this.src = detailsClose;
            oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
        }
    } );
}