// Client ID and API key from the Developer Console
var CLIENT_ID = "";

// Array of API discovery doc URLs for APIs used by the quickstart
var DISCOVERY_DOCS = ["https://sheets.googleapis.com/$discovery/rest?version=v4"];

// Authorization scopes required by the API; multiple scopes can be
// included, separated by spaces.
var SCOPES = "https://www.googleapis.com/auth/spreadsheets https://www.googleapis.com/auth/drive";


/**
 *  On load, called to load the auth2 library and API client library.
 */
function handleClientLoad() {
    gapi.load('client:auth2', initClient);
}

/**
 *  Initializes the API client library and sets up sign-in state
 *  listeners.
 */
function initClient() {
    console.log(1);
    gapi.client.init({
        discoveryDocs: DISCOVERY_DOCS,
        clientId: CLIENT_ID,
        scope: SCOPES
    }).then(function () {
        console.log(2);
        // Listen for sign-in state changes.
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSigninStatus);

        // Handle the initial sign-in state.
        updateSigninStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
        var authorizeButton = document.getElementById('authorize-button');
        var signoutButton = document.getElementById('signout-button');
        authorizeButton.onclick = handleAuthClick;
        signoutButton.onclick = handleSignoutClick;
    });
}

/**
 *  Called when the signed in status changes, to update the UI
 *  appropriately. After a sign-in, the API is called.
 */
function updateSigninStatus(isSignedIn) {
    var authorizeButton = document.getElementById('authorize-button');
    var signoutButton = document.getElementById('signout-button');
    if (isSignedIn) {
        authorizeButton.style.display = 'none';
        signoutButton.style.display = 'block';
        if(onConnected != undefined) {
            console.info('onConnected');
            onConnected();
        }
    } else {
        authorizeButton.style.display = 'block';
        signoutButton.style.display = 'none';
        if(onNotConnected != undefined) {
            console.info('onConnected');
            onNotConnected();
        }
    }
}

function isSignedInGoogle() {
    return gapi.auth2.getAuthInstance().isSignedIn.get();
}

/**
 *  Sign in the user upon button click.
 */
function handleAuthClick(event) {
    gapi.auth2.getAuthInstance().signIn();
}

/**
 *  Sign out the user upon button click.
 */
function handleSignoutClick(event) {
    gapi.auth2.getAuthInstance().signOut();
}