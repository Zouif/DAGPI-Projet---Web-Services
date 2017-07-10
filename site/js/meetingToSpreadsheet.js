function onConnected() {
    console.info('onConnected');
    var title       = document.getElementById('post_title').value;
    var date_start  = document.getElementById('post_date_start').value;
    var date_end    = document.getElementById('post_date_end').value;
    var location    = document.getElementById('post_location').value;
    var meetingId   = parseInt(document.getElementById('post_meetingId').value);
    var sheetId     = document.getElementById('post_sheetId').value;

    gapi.client.sheets.spreadsheets.values.batchUpdate({
        "spreadsheetId" : sheetId,
        "valueInputOption": "USER_ENTERED",
        "data": [
            {
                "values": [
                    [
                        "Ordre du jour",
                        "Début",
                        "Fin",
                        "Lieu",
                    ]
                ],
                "range": "A1:D1",
            }
        ]
    }).then(function(response) {
        console.dir(response);
    }, function(response) {
        console.dir(response.result.error.message);
    });

    var res = gapi.client.sheets.spreadsheets.values.batchUpdate({
        "spreadsheetId" : sheetId,
        "valueInputOption": "USER_ENTERED",
        "data": [
            {
                "values": [
                    [
                        title,
                        date_start,
                        date_end,
                        location,
                    ]
                ],
                "range": "A" + (1+meetingId) + ":D" + (1+meetingId),
            }
        ]
    }).then(function(response) {
        console.dir(response);
    }, function(response) {
        console.dir(response.result.error.message);
    });

}

