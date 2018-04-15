<?php
//Initializing connection to MySQL database. Includes credentials and creates database connection in db_connection.php, all outside of root document. Also contains the session_start().
require_once("includes/db_connection.php");

//Gets a username from the URL. If none exists, get from the session array (logged-in user).
if (isset($_GET["user"])) {
	$this_user = $_GET["user"];
} else { //If no username is provided in URL, user is opening their own bookmarks.
	//If no one is logged in, redirect to login page. Kills page in case redirect fails.
	if (!isset($_SESSION['valid_user'])) {
		$_SESSION['callback_url'] = $_SERVER['REQUEST_URI'];
		header('Location: login.php');
		die("There is an issue with the database. Please try again later.");
	} else {
		$this_user = $_SESSION['valid_username'];
	}	
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
        <!-- Sets the page's heading with the name of user. -->
        <h1>Bookmarks for <?php echo $this_user; ?></h1>

		<?php
		//Query to get all bookmark items associated with user's id and every event attached to the bookmark item.
		$query = "SELECT bookmarks.event_id, events.event_title, DATEDIFF(events.start_date, CURDATE()) AS days_left, members.username FROM bookmarks JOIN events ON bookmarks.event_id = events.event_id JOIN members ON bookmarks.user_id = members.user_id WHERE members.username = ?";

		//Sets up the prepared statement again to run for event information, including the event id (for linking to eventdetails.php) and event name (for the list items).
		$db = create_db();
		$stmt = $db->prepare($query);
		$stmt->bind_param('s', $this_user);
		$stmt->execute();
		$stmt->bind_result($event_id, $event_title, $days_left, $username);

		//Displays relevant message when opening bookmark from redirect by addtobookmarks.php (which provides the "event_added" item).
		if (isset($_SESSION['event_added'])) {
			while ($stmt->fetch()) { //Looks for the event added, most likely at the bottom of the results if a brand new entry.
				//Message to indicate user already has the event on their bookmarks, indicated by having a "dataExists" string concantenated at the end of the event's code.
				if ($_SESSION['event_added'] == $event_id . "dataExists") echo '<span style="color: #eb9437;">' . $event_title . ' is already in your bookmarks.</span><br>';

				//Confirmatory message for adding a bookmark item.
				else if ($_SESSION['event_added'] == $event_id) echo '<span style="color: #479b61;">' . $event_title . ' has been successfully added to your bookmarks.</span><br>';
				
			}
			//Removes the event_added item so the message does not show again until another redirect by addtobookmarks.php.
			unset($_SESSION['event_added']);
		}

		//Brings cursor back to the top of the results.
		$stmt->execute();
		$stmt->store_result();
		if ($stmt->num_rows == 0) {
			echo "No bookmarks yet.";
		} else {
			//Editing buttons are for when user is logged in and viewing their own page.
			if (isset($_SESSION['valid_username'])) {
				if ($this_user == $_SESSION['valid_username']) {
					echo '<button type="button" id="edit">Edit</button>';
					echo '<button type="button" id="done">Done</button>';
					echo '<button type="button" id="delete" formaction="deletebookmarks.php">Delete</button>';
				}
			}

			//Query to get the sharing setting from this bookmark list's owner.
			$sharingquery = 'SELECT sharing FROM members WHERE username = "' . $this_user . '"';
			$sres = db_select($sharingquery);
			$srow = mysqli_fetch_assoc($sres);
			$sharing = $srow["sharing"];

			//Show the bookmarks if sharing is set to true.
			if ($sharing == 1) {
				echo "<ul>";
				//Make new list item with link for every bookmark item.
				while ($stmt->fetch()) {
					//Creates countdown timer for each event on list.
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
					echo '<li id="'.$event_id.'"><input type="checkbox" class="bmCheck"><a href=eventdetails.php?event_id='.$event_id.'>'.$event_title.'</a> ' . $daysleftdisplay . '</span></li>';
				}
				echo "</ul>";
			} else { //If the bookmarks are being kept private...
				if (isset($_SESSION['valid_username'])) { //User is logged in.
					if ($this_user == $_SESSION['valid_username']) { //If the user is just accessing their own bookmarks...
						echo "<ul>";
						//Make new list item with link for every bookmark item.
						while ($stmt->fetch()) {
							//Creates countdown timer for each event on list.
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
							echo '<li id="'.$event_id.'"><input type="checkbox" class="bmCheck"><a href=eventdetails.php?event_id='.$event_id.'>'.$event_title.'</a> ' . $daysleftdisplay . '</span></li>';
						}
						echo "</ul>";
					} else { //If this is not the user's own bookmarks...
						echo "Access to this list is private to the user.";
					}
				} else { //User isn't logged in.
					echo "Access to this list is private to the user.";
				}
			}
		}

		//Frees results and closes the connection to the database.
		$stmt->close();
		$db->close();
		
        //Adds the footer.
        require('includes/footer.php');
        ?>
    </body>
    <script type="text/javascript">
    	//Toggles visibility of edit buttons.
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
    	
    	//Runs AJAX to delete the selected bookmarks from the database.
    	$("#delete").click(function(event) {
			event.preventDefault();
			var myUrl = $(event.target).attr("formaction");
			var boxes = $(".bmCheck");
			var selected = [];
			for (var i = 0; i < boxes.length; i++) {
				if(boxes[i].checked) selected.push(boxes[i].parentElement.attributes["id"].value);
			}

			//If user had selected at least one bookmark, ask for confirmation before executing the AJAX call.
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