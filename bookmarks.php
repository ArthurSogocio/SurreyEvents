<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//If no one is logged in, redirect to login page. Kills page in case redirect fails.
if (!isset($_SESSION['valid_user'])) {
	$_SESSION['callback_url'] = $_SERVER['REQUEST_URI'];
	header('Location: login.php');
	die("There is an issue with the database. Please try again later.");
}

//Prepared statement to get first and last name of the user logged in.
// $namequery = "SELECT name FROM members WHERE id = ?";
// $stmt = $db->prepare($namequery);
// $stmt->bind_param('i', $_SESSION['valid_user']);
// $stmt->execute();
// $stmt->bind_result($name);
// $stmt->fetch();

$this_user = $_SESSION['valid_username'];
if (isset($_GET["user"])) {
	$this_user = $_GET["user"];
}

?>
<html>
    <head>
        <title>Surrey Events</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <script src="js/jquery-3.3.1.js"></script>
    </head>
    <body>
        <?php
        //Adds the header.
        require('includes/header.php');
        ?>
        <h1>
			Bookmarks for <?php
				//Sets the page's heading with the name of user if exists.
				echo $this_user;
			?>
		</h1>

		<?php
		//Query to get all bookmark items associated with user's id and every product attached to the bookmark item.
		

		$query = "SELECT bookmarks.event_id, events.event_title, DATEDIFF(events.start_date, CURDATE()) AS days_left, members.username FROM bookmarks JOIN events ON bookmarks.event_id = events.event_id JOIN members ON bookmarks.user_id = members.user_id WHERE members.username = ?";

		$db = create_db(); //TEMP

		//Sets up the prepared statement again to run for product information, including the product code (for linking to modeldetails.php) and product name (for the list items).
		$stmt = $db->prepare($query);
		$stmt->bind_param('s', $this_user);
		$stmt->execute();
		$stmt->bind_result($event_id, $event_title, $days_left, $username);

		//Displays relevant message when opening bookmark from redirect by addtobookmarks.php (which provides the "event_added" item).
		if (isset($_SESSION['event_added'])) {
			while ($stmt->fetch()) { //Looks for the product added, most likely at the bottom of the results if a brand new entry.
				//Message to indicate user already has the product on their bookmarks, indicated by having a "dataExists" string concantenated at the end of the product's code.
				if ($_SESSION['event_added'] == $event_id . "dataExists") echo '<span style="color: #eb9437;">' . $event_title . ' is already in your bookmarks.</span><br>';

				//Confirmatory message for adding a bookmark item.
				else if ($_SESSION['event_added'] == $event_id) echo '<span style="color: #479b61;">' . $event_title . ' has been successfully added to your bookmarks.</span><br>';
				
			}
			//Removes the event_added item so the message does not show again until another redirect by addtobookmarks.php.
			unset($_SESSION['event_added']);
		}

		//Brings cursor back to the top of the results.
		$stmt->execute();

		if ($this_user == $_SESSION['valid_username']) {
			echo '<button type="button" id="edit">Edit</button>';
			echo '<button type="button" id="done">Done</button>';
			echo '<button type="button" id="delete" formaction="deletebookmarks.php">Delete</button>';
		}

		echo "<ul>";
		//Make new list item with link for every bookmark item.
		while ($stmt->fetch()) {
            $daysleftdisplay = '<br><span class="countdown">Starts ';

            if ($days_left == 1) {
                $daysleftdisplay .= '<span class="today">tomorrow</span>!';
            } else if ($days_left > 0) {
                $daysleftdisplay .= 'in <span class="days">' . $days_left . "</span> days";
            } else if ($days_left == 0) {
           		$daysleftdisplay .= '<span class="today">today</span>!';
            } else {
                $daysleftdisplay = '<br><span>&nbsp;';
            }

			echo '<li id="'.$event_id.'"><input type="checkbox" class="bmCheck"><a href=eventdetails.php?event_id="'.$event_id.'">'.$event_title.'</a> ' . $daysleftdisplay . '</span></li>';

		}
		//Frees results and closes the connection to the database.
		$stmt->close();
		$db->close();

		echo "</ul>";

		
		?>

		<?php
        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
    <script type="text/javascript">
    	
    	$("#edit").click(function(event) {
			event.preventDefault();
			$(this).hide();
			$(".bmCheck").show();
			$("#delete").show();
			$("#done").show();
		});
		$("#done").click(function(event) {
			event.preventDefault();
			$(this).hide();
			$(".bmCheck").hide();
			$("#delete").hide();
			$("#edit").show();
		});
		$(".bmCheck").hide();
    	$("#delete").hide();
    	$("#done").hide();
    	
    	$("#delete").click(function(event) {
			event.preventDefault();

			var myUrl = $(event.target).attr("formaction");
			var boxes = $(".bmCheck");
			var selected = [];
			for (var i = 0; i < boxes.length; i++) {
				if(boxes[i].checked) selected.push(boxes[i].parentElement.attributes["id"].value);
			}
			if (selected.length > 0) {
				if (confirm("Delete the selected bookmark(s)?")) {
					$.ajax({
						type: "GET",
						url: myUrl,
						data: {event_id: selected},
						success: function(data) {
							for (var i = 0; i < selected.length; i++) {
			    				$("#"+selected[i]).fadeOut(1000, function() {
			    					$(this).html("");
			    				});
			    			}
						}
					});
				}
			}
		});
    </script>
</html>
