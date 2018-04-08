<?php
//If the page is still secure from login or register pages, switch back to normal http.
if (isset($_SERVER["HTTPS"])) {
    if ($_SERVER["HTTPS"] == "on")
        header('Location: http://localhost' . $_SERVER["REQUEST_URI"]);
}

//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//query to select categories from dropdown
$catquery = "SELECT id, name FROM categories";
$catresult = db_select($catquery);

//query to select towns from dropdown
$townquery = "SELECT id, name FROM towns";
$townresult = db_select($townquery);

//If no one is logged in, clear the callback URL.
//This is because if they open showevents.php after getting a callback URL from trying to access their watchlist, they are not concerned with getting immediately redirected to the watchlist if they choose to log in normally after.
if (!isset($_SESSION['valid_user'])) {
    unset($_SESSION['callback_url']);
}
?>
<html>
    <head>
        <title>Surrey Events</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-3.3.1.js"></script>
        <script>
            //initialize category; start at 0 or "" means select all
            name = "";
            category = 0;
            town = "";
            recency = 0;
            $(function () {
                //Ajax File to apply user filters to the table query - change applied to query; 
                function updateTable() {
                    $.post("includes/filterresults.php", {name: name, category: category, town: town, recency: recency}, function (result) {
                        $("#filterresults").html(result);
                        $("#pagination-nav").empty();

                        pages = $("#lastrow").attr("data-index");
                        console.log(pages);
                        for (var i = 0; i < pages; i++) {
                            $("#pagination-nav").append("<li><a href='#' data-index='"+(i+1)+"' class='link'>["+(i+1)+"]</a></li>");
                            // classLink = ".link" + (i+1);
                            // console.log(classLink); 
                        }
                        $(".link").click(function () {
                            $(".page").hide();
                            var pageLink = ".page" + $(this).data('index');
                            $(pageLink).show();
                            console.log(pageLink);
                        });
                        $(".page").hide();
                        $(".page1").show();
                    });
                }

                //filter based on which filter was changed
                $("#name").on('change', function () {
                    name = this.value;
                    //console.log(name);
                    updateTable();
                });
                $("#category").on('change', function () {
                    category = this.value;
                    //console.log(category);
                    updateTable();
                });
                $("#town").on('change', function () {
                    town = this.value;
                    //console.log(town);
                    updateTable();
                });
                $("#recency").on('change', function () {
                    recency = this.value;
                    //console.log(recency);
                    updateTable();
                });

                

                //run function on page load to show unfiltered results
                updateTable();
            });
        </script>
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>
        <h1>Search Events</h1>
        <form>
            <table>
                <tr>
                    <th>Event Name</th>
                    <th>Category</th>
                    <th>Township</th>
                    <th>Upcoming/Past Event</th>
                </tr>
                <tr>
                    <td>
                        <input id="name">
                    </td>
                    <td>
                        <select id="category">
                            <option value="">Select a Category</option>
                            <?php
                            while ($catrow = mysqli_fetch_assoc($catresult)) {
                                $catid = $catrow['id'];
                                $catname = $catrow['name'];
                                ?>
                                <option value="<?= $catid ?>"><?= $catname ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select id="town">
                            <option value="">Select a Town</option>
                            <option value="0">N/A</option>
                            <?php
                            while ($townrow = mysqli_fetch_assoc($townresult)) {
                                $townid = $townrow['id'];
                                $townname = $townrow['name'];
                                ?>
                                <option value="<?= $townid ?>"><?= $townname ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </td>
                    <td>
                        <select id="recency">
                            <option value="0">Upcoming Events</option>
                            <option value="1">Past Events</option>
                        </select>
                    </td>
                </tr>
            </table>
        </form>
        <ul id="pagination-nav">
            <!-- Nav buttons added after AJAX result. -->
        </ul>
        <div id="filterresults">
            <!-- display filtered results from ajax -->
        </div>
        <?php
        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
</html>