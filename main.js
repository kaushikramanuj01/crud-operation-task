
function ajaxrequest(method, url, headerdata, paramsdata, successCallback, errorCallback) {
    currentXhr = $.ajax({
        type: method,
        url: url + '.php',
        headers: headerdata,
        data: paramsdata,
        dataType: "json", // Ensure JSON response is expected
        error: errorCallback,
        success: successCallback,
    });
}

function showPopupMessage(message, status) {
    // Check if outerDiv already exists
    var outerDiv = document.getElementById('outerDiv');

    if (!outerDiv) {
        // If outerDiv does not exist, create it
        outerDiv = document.createElement('div');
        outerDiv.id = 'outerDiv'; // Set ID for the outer div
        // Insert outerDiv as the first child of the body
        var firstChild = document.body.firstChild;
        document.body.insertBefore(outerDiv, firstChild);
    }

    // Create a div element for the message popup
    var messagePopupDiv = document.createElement('div');
    messagePopupDiv.className = 'message-popup';
    // Set your HTML content (replace this with your actual HTML content)
    messagePopupDiv.innerHTML = '<p>' + message + '</p>';

    // Append the messagePopupDiv to the outerDiv
    outerDiv.appendChild(messagePopupDiv);

    // Get the first child of outerDiv, which will be the oldest messagePopupDiv
    // var firstChild = outerDiv.firstChild;

    outerDiv.insertBefore(messagePopupDiv, outerDiv.firstChild);

    // Set the appropriate class based on status
    var className = (status === 1) ? 'success' : 'danger';

    // Set the message and class
    messagePopupDiv.innerHTML = message;
    messagePopupDiv.className = 'message-popup ' + className;

    // Create a cancel button
    var cancelButton = document.createElement('button');
    // cancelButton.innerText = 'Cancel';
    cancelButton.innerHTML = '&times;'; // Add close sign "&times;"
    cancelButton.className = 'cancel-button';
    // Add click event listener to the cancel button
    cancelButton.addEventListener('click', function() {
        // Remove the messagePopupDiv when the cancel button is clicked
        outerDiv.removeChild(messagePopupDiv);
    });
    // Append the cancel button to the messagePopupDiv
    messagePopupDiv.appendChild(cancelButton);

    // Show the popup with animation
    outerDiv.style.display = 'block';
    messagePopupDiv.style.opacity = '1';

    // Hide the popup after 5 seconds (5000 milliseconds)
    setTimeout(function () {
        // Remove the messagePopupDiv after hiding
        messagePopupDiv.style.opacity = '0';
        setTimeout(function () {
            messagePopupDiv.remove();
        }, 1000); // Wait 1 second for the fade out animation to complete before removing
    }, 4000); // 5 seconds
}
function closePopup() {
    $('#view-box').css('display', 'none');
}

//! data validationi code 
function checkname(text) {
    if (text.length < 1) {
        var status = 0;
        var msg = "Please enter your Name.";
        // $("#name-error").text();
    } else {
        var status = 1;
        //    $("#name-error").text(""); // Clear any previous length error message
    }
    return status;
}

function isValidEmail(email) {
    console.log("here22");
    // Regular expression pattern to match a valid email address
    var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailPattern.test(email);
}
function isValidNumber(value) {
    // Check if value is a valid number and is finite
    return !isNaN(value) && isFinite(value) && !isNaN(parseFloat(value));
}