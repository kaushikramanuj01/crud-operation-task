<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD operation</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="main.js"></script>
    <link rel="stylesheet" href="css/nav.css">
    <link rel="stylesheet" href="css/table.css">
    <style>
    * {
        box-sizing: border-box;
    }

    html,
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        max-width: 100%;
    }

    .addcon-container {
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        width: 40%;
        text-align: center;
        height: max-content;
        background-image: linear-gradient(360deg, rgb(16 42 99) 2.65%, rgb(13 20 36) 53%, #010c22);
        margin: 0px;
        float: left;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        padding-bottom: 45px;
    }

    .addcon-header {
        color: #fff;
        padding: 20px 0px 15px 0px;
    }

    .addcon-header h2 {
        margin: 0px;
    }

    .addcon-form {
        width: 80%;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-size: 14px;
        display: block;
        margin-bottom: 8px;
        text-align: left;
        color: white;
    }

    .form-group input {
        color: white;
        width: 100%;
        padding: 6px;
        border: none;
        border-radius: 4px;
        font-size: 14px;
        display: block;
        margin-bottom: 10px;
        box-sizing: border-box;
        background-color: #333 !important;
    }

    .form-group input:focus {
        outline: none;
        border-color: #007bff;
    }

    .validation-indicator {
        font-size: 12px;
        color: #dc3545;
        text-align: left;
    }

    .add-button {
        color: #fff;
        padding: 7px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 16px;
        width: 100%;
        background: linear-gradient(to right, #31514a, #484747);
        margin-top: 30px;
    }

    .add-button:hover {
        background-color: #0056b3;
    }

    .addcon_main {
        display: flex;
        justify-content: center;
        margin-top: 3vh;
        margin-bottom: 4vh;
    }

    .view_main {
        display: flex;
        justify-content: center;
        margin-top: 3vh;
        margin-bottom: 4vh;
        align-items: flex-start;
    }

    .view_main span {
        font-size: 45px;
        display: flex;
    }

    #addForm {
        display: none;
    }

    .byk {
        width: 78%;
        border-bottom-left-radius: 8px;
        display: flex;
        justify-content: center;
    }

    @media (max-width: 1000px) {
        .byk {
            width: 90%;
        }
        .addcon-container {
            width: 45%;
        }
    }

    @media (max-width: 480px) {
        .addcon-container {
            width: 100% !important;
        }

        .form-group label {
            font-size: 15px;
            font-weight: 600;
        }

        .add-button {
            font-weight: 700;
        }
    }

    @media (max-width: 390px) {
        .addcon_main {
            margin-top: 5vh;
        }
    }

    @media (max-width: 950px) {
        .addcon_main {
            margin-top: 5vh;
        }
    }

    .loader {
        border: 4px solid #937575;
        border-top: 4px solid #4d6c8100;
        border-radius: 50%;
        width: 15px;
        height: 15px;
        animation: spin 1s linear infinite;
        display: none;
        position: relative;
        left: 50%;
        transform: translate(-50%, -50%);
        margin-top: 45px;
        margin-bottom: 15px;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loader_div {
        margin-top: 20px;
        margin-bottom: 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .message-popup-container {
        position: relative;
    }

    .message-popup {
        width: max-content;
        animation: slideIn 0.5s ease-in-out forwards;
        padding: 6px;
        font-size: 18px;
        font-family: sans-serif;
        border-radius: 5px;
        margin-bottom: 4px;
        display: flex;
        justify-content: center;
        align-items: center;
        padding-right: 0px;
        justify-content: space-between;
    }

    .cancel-button {
        font-size: 16px;
        font-weight: bold;
        background-color: transparent;
        border: none;
        color: #383838;
    }

    .success {
        background-color: #28a745;
    }

    .danger {
        background-color: #dc3545;
    }

    #outerDiv {
        position: fixed;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        padding: 15px;
        border-radius: 5px;
        color: #fff;
        font-size: 16px;
        display: none;
        z-index: 9988899;
        transition: height 0.3s ease;
    }

    //! form css
    /* Style for the Add button */
    .open-button {
        background-color: #3498db;
        color: white;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        border-radius: 5px;
        font-size: 16px;
    }

    /* The Pop-up form - hidden by default */
    .form-popup {
        position: absolute;
        top: 10%;
        z-index: 9;
        width: 100%;
    }

    .view-box {
        position: fixed;
        top: 10%;
        display: none;
        z-index: 9;
        width: 100%;
    }

    /* Add some hover effects to buttons */
    .f_btn {
        background-color: #4CAF50;
        color: white;
        padding: 10px;
        margin: 10px 0;
        border: none;
        cursor: pointer;
        width: 100%;
        border-radius: 5px;
        font-size: 16px;
    }

    .f_btn:hover {
        opacity: 0.8;
    }

    /* Cancel button */
    .cancel {
        background-color: red;
    }

    /* Close button styling */
    .cancel:hover {
        background-color: darkred;
    }

    #table_section {
        display: none;
        justify-content: center;

    }

    @media (max-width: 550px) {

        .myTable tr,
        .myTable td {
            display: flex;
            flex-direction: column;
        }

        .action_sec {
            display: flex !important;
            flex-direction: row !important;
        }

        #profile_view {
            width: 55% !important;
        }

        .addcon-container {
            width: 65%;
        }

        .message-popup {
            font-size: 14px;
        }
    }

    #profile_view {
        width: 35%;
    }

    .form_image_show {
        display: flex;
        column-gap: 6px;
        align-items: center;
    }

    #profile_picture {
        height: fit-content;
        margin: 0px;
    }

    #existing_image {
        width: 40px;
        height: 40px;
        border-radius: 50px;
        display: none;
    }

    #existing_image img {
        width: -webkit-fill-available;
        height: -webkit-fill-available;
        border-radius: 50px;
    }

    /* !search bar */
    .search-form {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 83%;
    }

    .search-input {
        flex: 1;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ccc;
        border-radius: 4px;
        margin-right: 10px;
    }

    .search-button {
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        background-color: #007BFF;
        color: white;
        border-radius: 4px;
        cursor: pointer;
    }

    .search-button:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .search-form {
            flex-direction: column;
        }

        .search-input {
            width: 100%;
            margin: 5px 0;
        }
        .search-button {
            width: 100%;
            margin: 5px 0;
        }
    }

    .search_bar {
        width: 100%;
        display: flex;
        justify-content: center;
        margin: 10px 0px;
    }

    /* !search bar */
    .pagination {
        display: flex;
        flex-wrap: wrap;
        width: 82%;
    }

    .pagination a {
        margin: 0px 5px;
    }

    .pagination_sec {
        display: flex;
        width: 100%;
        justify-content: center;
    }

    .no_data {
        display: none;
        text-align: center;
    }
    </style>
</head>
<body>
    <?php require "component/navbar.html"; ?>

    <div id="view-box" class="view-box">
        <div class="view_main">
            <img src="uploads/d25afcdccScreenshot 2021-07-22 041845.png" id="profile_view" alt="" srcset="">
            <span><button onclick="closePopup()">×</button></span>
        </div>
    </div>

    <div id="content">
        <input type="hidden" name="pageno" value="1" id="pageno">
        <input type="hidden" name="perpage" value="10" id="perpage">
        <input type="hidden" name="loadmore" value="1" id="loadmore">
        <input type="hidden" name="currentpage" value="" id="currentpage">

        <div class="search_bar">
            <form action="" method="post" id="search-form" class="search-form">
                <input type="text" name="query" id="query" placeholder="Search by name, number, or email..."
                    class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>
        </div>

        <div id="table_section" class="table-responsive">
            <table class="styled-table myTable" id="record_table">
                <thead>
                    <tr class="table_title">
                        <th>ID</th>
                        <th>Name</th>
                        <th>Mobile Number</th>
                        <th>Email ID</th>
                        <th>Designation</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="table_body">

                </tbody>
            </table>

        </div>
        <div class="no_data">
            <h3>NO Data Found...!</h3>
        </div>

        <div class="loader" id="loader_input"></div>

        <div class="pagination_sec">
            <div class="pagination" id="paginationControls"></div>
        </div>
    </div>

    <div id="addForm" class="form-popup">
        <div class="addcon_main">
            <div class="byk">
                <div class="addcon-container">
                    <div class="addcon-header">
                        <h2 id="form-title">Add Data</h2>
                    </div>

                    <div class="addcon-form">
                        <form id="addconForm" action="" method="post">
                            <input type="hidden" id="recordId" name="id">
                            <div class="form-group">
                                <label for="profile_picture">Profile Picture:</label>

                                <span class="form_image_show">
                                    <input type="file" name="profile_picture" id="profile_picture" accept="image/*"
                                        required>
                                    <!-- Display the existing image -->
                                    <span id="existing_image">
                                        <img id="existing_img" src="" alt="Existing Profile Picture">
                                    </span>
                                </span>
                            </div>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" required>
                                <div class="validation-indicator" id="nameValidation"></div>
                            </div>

                            <div class="form-group">
                                <label for="contact">Mobile Number</label>
                                <input type="text" id="contact" name="contact" required>
                                <div class="validation-indicator" id="contactValidation"></div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email ID</label>
                                <input type="text" id="email" name="email" required>
                                <div class="validation-indicator" id="emailValidation"></div>
                            </div>

                            <div class="form-group">
                                <label for="designation">Designation</label>
                                <input type="text" id="designation" name="designation" required>
                                <div class="validation-indicator" id="designationValidation"></div>
                            </div>

                            <button type="submit" class="add-button f_btn" id="add-button">Submit</button>

                            <button type="button" class="f_btn cancel" id="closeFormBtn">Close</button>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#content').css('display', 'block');
        var currentpage = document.getElementById('currentpage');
        currentpage.value = "view";
        $("#loader_input").show();
        fillrecord();

        function fillrecord() {
            var perpage = document.getElementById('perpage').value;
            var pageno = document.getElementById('pageno').value;
            var query = document.getElementById('query').value;

            const url = "api/data";
            const method = "POST";
            const headerdata = {
                "Content-Type": "application/json"
            };

            var action = "viewrecord";
            if (query.length > 0) {
                var action = "searchData";
            }

            const paramsdata = JSON.stringify({
                action: action,
                pageno: pageno,
                perpage: perpage,
                query: query
            });

            ajaxrequest(method, url, headerdata, paramsdata, successCallback, errorCallback)

            function errorCallback(error) {
                console.error('Error:', error);
                $(".generation_msg_box").hide();
                showPopupMessage("Server Error", 0);
                isLoading = false; // Reset the data loading flag
                $("#loader_input").hide();
            }

            function successCallback(data) {
                var pageno = document.getElementById('pageno').value;
                var table_body = document.querySelector("#table_body");

                var table_section = document.getElementById("table_section");
                table_section.style.display = "flex"; // Show the form

                // if(pageno == "1"){
                table_body.innerHTML = data.data;
                // }else{
                //     table_body.innerHTML += data.data;
                // }
                $('.no_data').css('display', 'none');
                $('#table_section').css('display', 'flex');

                if (data.dataload == 0) {
                    $('.no_data').css('display', 'block');
                    $('#table_section').css('display', 'none');
                }

                setupPagination(pageno, data.total_pages);

                var pageno = document.getElementById('pageno');
                pageno.value = data.nextpage;
                var loadmore = document.getElementById('loadmore');
                loadmore.value = data.loadmore;
               
                isLoading = false; // Reset the data loading flag
                $("#loader_input").hide();
            }
        }

        function setupPagination(currentPage, totalPages) {
            let paginationContent = '';
            currentPage = Number(currentPage);
            totalPages = Number(totalPages);

            if (currentPage > 1) {
                paginationContent +=
                    `<a href="javascript:void(0)" data-page="1" class="pagination_btn">&laquo; First</a>`;
                paginationContent +=
                    `<a href="javascript:void(0)" data-page="${currentPage - 1}" class="pagination_btn">&lsaquo; Prev</a>`;
            }

            for (let i = 1; i <= totalPages; i++) {
                paginationContent +=
                    `<a href="javascript:void(0)" data-page="${i}" class="pagination_btn ${i === currentPage ? ' active' : ''}">${i}</a>`;
            }

            if (currentPage < totalPages) {
                paginationContent +=
                    `<a href="javascript:void(0)" data-page="${currentPage + 1}" class="pagination_btn">Next &rsaquo;</a>`;
                paginationContent +=
                    `<a href="javascript:void(0)" data-page="${totalPages}" class="pagination_btn">Last &raquo;</a>`;
            }

            $('#paginationControls').html(paginationContent);

            $('#paginationControls a').click(function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                var pageno = document.getElementById('pageno');
                pageno.value = page;
                fillrecord();

            });
        }

        function setupPagination_backup(currentPage, totalPages) {
            let paginationContent = '';
            if (currentPage > 1) {
                paginationContent += `<a href="#" data-page="1">&laquo; First</a>`;
                paginationContent += `<a href="#" data-page="${currentPage - 1}">&lsaquo; Prev</a>`;
            }

            const maxPagesToShow = 5; // Maximum number of page links to show at once
            const halfMaxPagesToShow = Math.floor(maxPagesToShow / 2);

            let startPage = Math.max(currentPage - halfMaxPagesToShow, 1);
            let endPage = Math.min(currentPage + halfMaxPagesToShow, totalPages);

            // Adjust if we're at the beginning or end of the page range
            if (startPage <= 1) {
                startPage = 1;
                endPage = Math.min(maxPagesToShow, totalPages);
            }
            if (endPage >= totalPages) {
                startPage = Math.max(totalPages - maxPagesToShow + 1, 1);
                endPage = totalPages;
            }

            // Show ellipsis if not all pages are displayed
            if (startPage > 1) {
                paginationContent += `<a href="#" data-page="1">1</a>`;
                if (startPage > 2) {
                    paginationContent += `<span>...</span>`;
                }
            }

            // Show the current page range
            for (let i = startPage; i <= endPage; i++) {
                paginationContent +=
                    `<a href="#" data-page="${i}" class="${i === currentPage ? 'active' : ''}">${i}</a>`;
            }

            // Show ellipsis if there are pages after the current range
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    paginationContent += `<span>...</span>`;
                }
                paginationContent += `<a href="#" data-page="${totalPages}">${totalPages}</a>`;
            }

            if (currentPage < totalPages) {
                paginationContent += `<a href="#" data-page="${currentPage + 1}">Next &rsaquo;</a>`;
                paginationContent += `<a href="#" data-page="${totalPages}">Last &raquo;</a>`;
            }

            $('#paginationControls').html(paginationContent);

            // Bind click events for pagination links
            $('#paginationControls a').click(function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                var pageno = document.getElementById('pageno');
                pageno.value = page;
                fillrecord();
            });
        }

        // Close the form when the "Close" button is clicked
        $('#closeFormBtn').click(function() {
            $('#addForm').css('display', 'none');
            $('#content').css('display', 'block');
            $('#addconForm')[0].reset(); // Clear the form
            $('#existing_img').attr('src', "");
            $('#existing_image').hide();
            var form_title = document.querySelector("#form-title");
            form_title.innerHTML = "Add Data";
            var currentpage = document.getElementById('currentpage');
            currentpage.value = "view";
        });

        $('.button-nav').on('click', function() {
            const section = $(this).data('section');

            if (section == "add") {
                $('#addconForm')[0].reset(); // Clear the form
                $('#existing_img').attr('src', "");
                $('#existing_image').hide();

                closePopup();
                var currentpage = document.getElementById('currentpage');
                currentpage.value = "add";
                $('#content').css('display', 'none');
                var form_title = document.querySelector("#form-title");
                form_title.innerHTML = "Add Data";
                $('#addForm').css('display', 'block');
            }

            if (section == "view") {
                var currentpage = document.getElementById('currentpage');
                currentpage.value = "view";
                $('#content').css('display', 'block');
                $("#loader_input").show();
                $('#addForm').css('display', 'none');

                var form_title = document.querySelector("#form-title");
                form_title.innerHTML = "Add Data";

                var pageno = document.getElementById('pageno');
                pageno.value = '1';
                $('#search-form')[0].reset(); // Clear the form

                fillrecord();
                $('#addconForm')[0].reset(); // Clear the form
                $('#existing_img').attr('src', "");
                $('#existing_image').hide();
            }
        });

        $('#addconForm').submit(function(event) {
            event.preventDefault(); // Prevent the form submitting

            var name = document.getElementById("name").value;
            var contact = document.getElementById("contact").value;
            var email = document.getElementById("email").value;
            var designation = document.getElementById("designation").value;

            // ! data validation start
                if (isValidEmail(email)) {
                    $("#emailValidation").text("");
                } else {
                    $("#emailValidation").text("Plese enter valid Email.");
                    var error = 1;
                }

                // Check if the contact is a valid number
                if (!isValidNumber(contact)) {
                    $("#contactValidation").text("Please enter a valid number.");
                    var error = 1;
                } else {
                    $("#contactValidation").text("");
                }

                var checknameresult = checkname(name);
                if (checknameresult == 0) {
                    var msg = "Please enter your Name.";
                    $("#nameValidation").text(msg);
                    var error = 1;
                } else {
                    $("#nameValidation").text("");
                }

                var checkmsgresult = checkname(designation);
                if (checkmsgresult == 0) {
                    var msg = "Please enter your Designation.";
                    $("#designationValidation").text(msg);
                    var error = 1;
                } else {
                    $("#designationValidation").text("");
                }

                if (error == 1) {
                    return;
                }

            // ! data validation end

            var pageno = document.getElementById('pageno');
            pageno.value = '1';

            var currentpage = document.getElementById('currentpage').value;
            var recordId = document.getElementById('recordId').value;
            if (currentpage == "update") {
                var action = "updateRecord";
            } else {
                var action = "insertRecord";
            }

            // Create a FormData object and append form data
            var formData = new FormData(this);
            formData.append('action', action);
            formData.append('recordId', recordId);

            $.ajax({
                url: 'api/add.php',
                type: 'POST',
                data: formData,
                contentType: false, // Important: Do not set content type
                processData: false, // Important: Do not process the data as a query string
                success: function(data) {
                    var jsonString = JSON.stringify(data);
                    var jsondata = JSON.parse(jsonString);
                    showPopupMessage(jsondata.message, jsondata.status);

                    $('#addForm').css('display', 'none');
                    $('#content').css('display', 'block');
                    var currentpage = document.getElementById('currentpage');
                    currentpage.value = "view";
                    $('#addconForm')[0].reset(); // Clear the form
                    $('#existing_img').attr('src', "");
                    $('#existing_image').hide();

                    fillrecord();
                },
                error: function(error) {
                    console.error('Error:', error);
                    showPopupMessage("Server Error", 0);
                    isLoading = false; // Reset the data loading flag
                    $("#loader_input").hide();
                }
            });

        });

        $('#search-form').submit(function(event) {
            event.preventDefault();
            var pageno = document.getElementById('pageno');
            pageno.value = '1';

            fillrecord();
        });

        // ! Event handler for Delete button
        $('#record_table').on('click', '.delete-btn', function() {
            var recordId = $(this).data('id');
            if (confirm('Are you sure you want to delete this record?')) {

                const url = "api/data";
                const method = "POST";
                const headerdata = {
                    "Content-Type": "application/json"
                };
                const paramsdata = JSON.stringify({
                    action: "deleteRecord",
                    recordId: recordId,
                });
                ajaxrequest(method, url, headerdata, paramsdata, successCallback, errorCallback)

                function errorCallback(error) {
                    showPopupMessage("Server Error", 0);
                }

                function successCallback(data) {
                    if (data.status == 1) {
                        var pageno = document.getElementById('pageno');
                        pageno.value = '1';

                        var jsonString = JSON.stringify(data);
                        var jsondata = JSON.parse(jsonString);
                        showPopupMessage(jsondata.message, jsondata.status);
                        fillrecord();
                    } else {
                        console.log(data.message);
                    }
                }
            }
        });

        // ! Event handler for Update button
        $('#record_table').on('click', '.update-btn', function() {
            var recordId = $(this).data('id');

            const url = "api/data";
            const method = "POST";
            const headerdata = {
                "Content-Type": "application/json"
            };
            const paramsdata = JSON.stringify({
                action: "fetchData",
                recordId: recordId,
            });
            ajaxrequest(method, url, headerdata, paramsdata, successCallback, errorCallback)

            function errorCallback(error) {
                showPopupMessage("Server Error", 0);
            }

            function successCallback(data) {
                if (data.status == 1) {
                    console.log(data);

                    // change page as update page
                    var currentpage = document.getElementById('currentpage');
                    currentpage.value = "update";

                    // change page title
                    var form_title = document.querySelector("#form-title");
                    form_title.innerHTML = "Update Data";

                    // load all data on form 
                    $('#content').css('display', 'none');
                    $('#addForm').css('display', 'block');

                    let records = data.data[0];
                    // Populate the form fields with the record details
                    $('#recordId').val(records._id);
                    $('#name').val(records.name);
                    $('#contact').val(records.mobile);
                    $('#email').val(records.email);
                    $('#designation').val(records.designation);

                    if (records.profilePicture) {
                        $('#existing_img').attr('src', records.profilePicture);
                        $('#existing_image').show();
                    }
                    // when click on submit do process as update record
                } else {
                    console.log(data.message);
                }
            }
        });

        // ! Event handler for Image view button
        $('#record_table').on('click', '.view-btn', function() {
            var url = $(this).data('url');
            // change url of view box
            // show the view box
            $('#profile_view').attr('src', url);
            $('.view-box').css('display', 'block');

        });


        // ! LAZY loading code start (not using)
            // Flag to indicate whether data is currently being loaded
            var isLoading = false;
            // Function to check if the user has scrolled to the bottom of the page
            function isScrolledToBottom() {
                // return window.innerHeight + window.scrollY >= document.body.offsetHeight;
                return window.innerHeight + window.scrollY >= document.body.offsetHeight - 500;
            }
            // Function to load more data
            function loadMoreData() {
                if (isLoading) {
                    return; // If data is already being loaded, do nothing
                }
                // console.log("Loading more data...");
                isLoading = true; // Set the loading flag to true
                // $("#loader_input").show();
                // fillrecord(); // load more data
                // After data loading is complete, set the loading flag back to false
                // This ensures that the function can be called again when the user scrolls to the bottom next time
                // isLoading = false;
            }
            // Event listener for the scroll event
            window.onscroll = function() {
                // Check if the user has scrolled to the bottom of the page
                var currentpage = document.getElementById('currentpage').value;
                if (isScrolledToBottom() && currentpage == "view") {
                    var loadmoreele = document.getElementById('loadmore');
                    var loadmore = loadmoreele.value;
                    // console.log(loadmore);
                    // console.log("isLoading" + isLoading);
                    if (loadmore == "1") {
                        // Load more data when the user reaches the bottom
                        loadMoreData();
                    }
                }
            };
        // ! LAZY loading code end

    });

    </script>

</body>

</html>