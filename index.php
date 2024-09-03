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
    <link rel="stylesheet" href="css/index_css.css">

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