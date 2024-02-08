<?php
session_start();
// Connect to database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query the database to get course information
// Check if search term is set
// Get the search query from the form
if (isset($_GET['q'])) {
    // Sanitize the search query
    $q = mysqli_real_escape_string($conn, $_GET['q']);
 
    // Build the SQL query with a WHERE clause that matches the search query
    $sql = "SELECT * FROM formations WHERE nom LIKE '%$q%'  OR domain LIKE '%$q%'  ";
  // Execute the query
    $result = mysqli_query($conn, $sql);
 } else {
    // Build the SQL query without a WHERE clause to fetch all the results
    $sql = "SELECT * FROM formations ";
 
    // Execute the query
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
     die(mysqli_error($conn)); // print the error message
 }
 $num_rows = mysqli_num_rows($result);
 }


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>courses</title>
	<meta charset="UTF-8">
	<meta name="description" content="WebUni Education Template">
	<meta name="keywords" content="webuni, education, creative, html">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Favicon -->   
	<link href="img/logo.jpeg" rel="shortcut icon"/>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,500,500i,600,600i,700,700i,800,800i" rel="stylesheet">

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<link rel="stylesheet" href="css/font-awesome.min.css"/>
	<link rel="stylesheet" href="css/owl.carousel.css"/>
	<link rel="stylesheet" href="css/style.css"/>


	<!--[if lt IE 9]>
	  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body>
<?php include_once('include/header.php');?>
	<!-- search section end -->


	<!-- course section -->
	<section class="course-section spad pb-0">
		<div class="course-warp">
			<ul class="course-filter controls">
				<li class="control active" data-filter="all">All</li>
				<li class="control" data-filter=".finance">Finance</li>
				<li class="control" data-filter=".design">Design</li>
				<li class="control" data-filter=".web">Web Development</li>
				<li class="control" data-filter=".photo">Photography</li>
			</ul>                                       
			<div class="row course-items-area">
				<!-- course -->
				<?php 
    // Display courses retrieved from the database
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          
           
            
?>
            <div class="mix col-lg-3 col-md-4 col-sm-6 <?php echo $row['duree']; ?>">
                <div class="course-item">
                    <div class="course-thumb set-bg" data-setbg="image/<?php  echo $row['nom'];?>.png" >
                    <a class="text-decoration-none link-dark stretched-link" href="detail.php?tid=<?php echo $row['id'] ;?>">
                        <div class="price">Price: $<?php echo $row['prix']; ?></div>
                    </div>
                    <div class="course-info">
                        <div class="course-text">
                            <h5><?php echo $row['nom']; ?></h5>
                            <p><?php echo $row['description']; ?></p>
                            <div class="students">120 Students</div>
                        </div>
                        <div class="course-author">
                            <div class="ca-pic set-bg" data-setbg="img/authors/logo1.jpeg"></div>
                            <p><?php echo $row['nom']; ?>, <span><?php echo $row['date_f']; ?></span></p>
                        </div>
                    </div>
					</a>
                </div>
            </div>
<?php 
        }
    } else {
        echo "No courses found.";
    }
?>

			
					
	</section>
	<!-- course section end -->


	<!-- banner section -->
	<section class="banner-section spad">
		<div class="container">
			<div class="section-title mb-0 pb-2">
				<h2>Rejoignez notre communauté maintenant!</h2>
				<p>Rejoignez notre centre de formation pour améliorer vos compétences dans plusieurs domaines. Grâce à nos programmes de formation de qualité, vous aurez l'opportunité d'acquérir de nouvelles connaissances et compétences essentielles pour votre développement professionnel</p>
			</div>
			<div class="text-center pt-5">
				<a href="#" class="site-btn">S'inscrire maintenant</a>
			</div>
		</div>
	</section>
	<!-- banner section end -->


	<!-- footer section -->
	<?php include_once('include/fouter.php');?>
	<!-- footer section end -->


	<!--====== Javascripts & Jquery ======-->
	<script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
