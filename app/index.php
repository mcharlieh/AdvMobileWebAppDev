<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>jQuery Mobile Web App</title>
<meta name="viewport" content="width=device-width,initial-scale=1" />
<link href="https://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.css" rel="stylesheet" type="text/css"/>
<link href="styles/custom.css" rel="stylesheet" type="text/css">
<script src="https://code.jquery.com/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="https://code.jquery.com/mobile/1.3.0/jquery.mobile-1.3.0.min.js" type="text/javascript"></script>
<script>
	var Notification = window.Notification || window.mozNotification || window.webkitNotification;

	Notification.requestPermission(function (permission) {
		// console.log(permission);
	});

	function show() {
		window.setTimeout(function () {
			var instance = new Notification(
				"You've got tasks due!", {
					body: "Take a look at your task list to see what assignments are due today."
				}
			);

			instance.onclick = function () {
				// Something to do
			};
			instance.onerror = function () {
				// Something to do
			};
			instance.onshow = function () {
				// Something to do
			};
			instance.onclose = function () {
				// Something to do
			};
		}, 3000);

		return false;
	}
</script>
</head>
<body>
<div id="login" data-role="page" data-theme="b">
  <div data-role="header" data-theme="b">
    <div class="logo"><img src="images/rasmussen_logo.png" width="218" height="45" alt=""/></div>
  </div>
  <div data-role="content"> 
    <!--<form action="/action_page.php">-->
    <div class="container">
      <label><b>Username</b></label>
      <input type="text" placeholder="Enter Username" name="uname" required>
      <label><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" required>
      <!--<button type="submit">Login</button>--> 
      <a href="#task" data-role="button">Login</a>
      <input type="checkbox" checked="checked">
      Remember me </div>
    <div class="container" style="background-color:#f1f1f1">
      <button type="button" class="cancelbtn">Cancel</button>
      <span class="psw">Forgot <a href="#">password?</a></span> </div>
    <!--</form>-->
    <a href="#" onclick="return show()">Notify me!</a>
  </div>
  <div data-role="footer" data-theme="b">
    <h4>MHaley &copy; 2017</h4>
  </div>
</div>
<div id="task" data-role="page" data-theme="b">
  <div data-role="header" data-theme="b">
    <div class="logo"><img src="images/rasmussen_logo.png" width="218" height="45" alt=""/></div>
	<div class="dropdown">
		<button onClick="myFunction()" class="dropbtn">Menu</button>
		<div id="myDropdown" class="dropdown-content">
			<a href="#profile">MyDegree</a>
    		<a href="#calender">Calender</a>
    		<a href="#login">Logout</a>
		</div>
	</div>
  </div>
  <div class="content">
    <h2>My To Do List</h2>
    <span onclick="newElement()" class="addBtn">Add</span>
    <?php
  		include 'config.php';
  		include 'opendb.php';
  		
  		$sql="SELECT task_name, task_desc, due_date FROM task_list WHERE show_flg='1'";
  		$result = mysqli_query($conn, $sql);
  		
  		if (mysqli_num_rows($result) > 0) {
  			//output data of each row
  			while ($row = mysqli_fetch_assoc($result)) {
  				echo $row["task_name"]. "  ";
  				echo $row["due_date"]. "<br>";
  				echo "     " . $row[task_desc]. "<br><br>";
  			}
  		} else {
  			echo "No tasks this week!";
  		}
  		
  		mysqli_close($conn);
  		
  		?>
	</div>
  <div data-role="footer" data-theme="b">
    <h4>MHaley &copy; 2017</h4>
  </div>
</div>
<div id="profile" data-role="page" data-theme="b">
  <div data-role="header" data-theme="b">
    <div class="logo"><img src="images/rasmussen_logo.png" width="218" height="45" alt=""/></div>
	<div class="dropdown">
		<button onClick="myFunction()" class="dropbtn">Menu</button>
		<div id="myDropdown" class="dropdown-content">
			<a href="#profile">MyDegree</a>
    		<a href="#calender">Calender</a>
    		<a href="#login">Logout</a>
		</div>
	</div>
  </div>
  </div>
  <div data-role="content">
    <?php
	  include 'config.php';
	  include 'opendb.php';
	  
	  $sql_degree = "SELECT degree.dgre_name, degree.dgre_school, degree.dgre_type, degree.dgre_credits_total, user_table.credits_completed, user_table.gpa
	  	FROM degree JOIN user_table ON degree.dgre_id = user_table.degree_id
		WHERE user_table.user_id='1'";
	  $sql_courses = "SELECT course.course_name, course.course_credits, student_courses.grade
	  	FROM course JOIN student_courses ON course.course_id = student_courses.course_id
		WHERE student_courses.user_id='1'";
	  
	  $result_degree = mysqli_query($conn, $sql_degree);
	  $result_courses = mysqli_query($conn, $sql_courses);
	  
	  $rowd = mysqli_fetch_assoc($result_degree);
	  $rowc = mysqli_fetch_assoc($result_courses);
	  
	  echo "MY DEGREE <br>";
	  echo $rowd["degree.dgre_type"]. "of";
	  echo $rowd["degree.dgre_name"]. "<br>";
	  echo "School of " . $rowd["degree.dgre_school"]. "<br><br>";
	  echo "Credit Completion: " . $rowd["user_table.credits_completed"];
	  echo " of " . $rowd["degree.dgre_credits_total"]. "<br>";
	  echo "Cumulative GPA: " . $rowd["user_table.gpa"]. "<br><br>";
	  echo "Current Courses <br>";
	  echo $rowc["course.course_name"];
	  echo " - " . $rowc["course.course_credits"]. "credits <br>";
	  echo "Current Grade: " . $rowc["student_courses.grade"];
	  
	  mysqli_close($conn);
	 ?>
  </div>
  <div data-role="footer" data-theme="b">
    <h4>MHaley &copy; 2017</h4>
  </div>
</div>
<div id="calender" data-role="page" data-theme="b">
  <div data-role="header" data-theme="b">
    <div class="logo"><img src="images/rasmussen_logo.png" width="218" height="45" alt=""/></div>
	<div class="dropdown">
		<button onClick="myFunction()" class="dropbtn">Menu</button>
		<div id="myDropdown" class="dropdown-content">
			<a href="#profile">MyDegree</a>
    		<a href="#calender">Calender</a>
    		<a href="#login">Logout</a>
		</div>
	</div>
  </div>
  </div>
  <div data-role="content">
  </div>
  <div data-role="footer" data-theme="b">
    <h4>MHaley &copy; 2017</h4>
  </div>
</div>
<div data-role="page" id="add" data-theme="b">
  <div data-role="header" data-theme="b">
    <div class="logo"><img src="images/rasmussen_logo.png" width="218" height="45" alt=""/></div>
  </div>
  <div data-role="content">
  <div data-role="footer" data-theme="b">
    <h4>MHaley &copy; 2017</h4>
  </div>
</div>
	</div>
  <!-- <script>
// Create a "close" button and append it to each list item
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

// Create a new list item when clicking on the "Add" button
function newElement() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("myInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}
</script> -->
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown menu if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
	</script>
</body>
</html>
