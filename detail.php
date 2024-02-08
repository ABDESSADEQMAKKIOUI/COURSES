<?php include_once('include/dbconnection.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>detail</title>
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
            <!-- Page Content-->

<?php
$tid=intval($_GET['tid']);
$sql="SELECT * from formations where  id='$tid'";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $row)
{             
	$tid=intval($_GET['tid']);
$sq="SELECT formateur_id as idf from formation_formateur where  formation_id='$tid'";  
$query = $dbh -> prepare($sq);
$query->execute();
$result=$query->fetchAll(PDO::FETCH_OBJ);
foreach($result as $ro){
    $idf =  $ro->idf;
}
$s="SELECT * from formateur where  id='$idf'";
$quer = $dbh -> prepare($s);
$quer->execute();
$result=$quer->fetchAll(PDO::FETCH_OBJ);
if($quer->rowCount() > 0)
{
foreach($result as $ro)
{              ?> 
	<!-- single course section -->
	<section class="single-course spad pb-0">
		<div class="container">
			<div class="course-meta-area">
				<div class="row">
					<div class="col-lg-10 offset-lg-1">
						<div class="course-note">Cours vedette</div>
						<h3><?php  echo htmlentities($row->nom);?></h3>
						<div class="course-metas">
							<div class="course-meta">
								<div class="course-author">
									<div class="ca-pic set-bg" data-setbg="img/authors/profile.jpg"></div>
									<h6>Teacher</h6>
									<p><?php  echo htmlentities($ro->nom);?> <?php  echo htmlentities($ro->prenom);?>, <span>Developer</span></p>
								</div>
							</div>
							<div class="course-meta">
								<div class="cm-info">
									<h6>Category</h6>
									<p><?php  echo htmlentities($row->domain);?></p>
								</div>
							</div>
							<div class="course-meta">
								<div class="cm-info">
									<h6>Etudiants</h6>
									<p>50 Etudiant</p>
								</div>
							</div>
							<div class="course-meta">
								<div class="cm-info">
									<h6>Date</h6>
									<p><?php  echo htmlentities($row->date_f);?>
									</span></p>
								</div>
							</div>
						</div>
						<a href="#" class="site-btn price-btn">Prix:><?php  echo htmlentities($row->prix);?>DHs</a>
						<a href="inscritf.php" class="site-btn buy-btn">Rejoignez la formation</a>
					</div>
				</div>
			</div>
			<img src="img/courses/single.jpg" alt="" class="course-preview">
			<div class="row">
				<div class="col-lg-10 offset-lg-1 course-list">
					<div class="cl-item">
						<h4>Course Description</h4>
						<p><?php  echo htmlentities($row->description);?></p>
					</div>
					<div class="cl-item">
						<h4>Certification</h4>
						<p><?php  echo htmlentities($row->description);?></p>
					</div>
					<div class="cl-item">
						<h4>Formateur</h4>
						<p><?php  echo htmlentities($ro->nom);?> <?php  echo htmlentities($ro->prenom);?></p>
						<p> <?php  echo htmlentities($ro->email);?></p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
                                         } }
										} }
  ?>
	<!-- single course section end -->

	<?php
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
	<!-- Page -->
	<section class="realated-courses spad">
		<div class="course-warp">
			<h2 class="rc-title">Cours connexes</h2>
			<div class="rc-slider owl-carousel">
				<!-- course -->
				<?php 
    // Display courses retrieved from the database
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          
           
            
?>
				<div class="course-item">
				<div class="course-thumb set-bg" data-setbg="image/<?php  echo $row['nom'];?>.png" >
						<div class="price">Prix: <?php echo $row['prix']; ?> DHs</div>
					</div>
					<div class="course-info">
						<div class="course-text">
							<h5><?php echo $row['nom']; ?></h5>
							<p><?php echo $row['description']; ?></p>
							<div class="students">120 Students</div>
						</div>
						<div class="course-author">
							<div class="ca-pic set-bg" data-setbg="image/<?php  echo $row['nom'];?>.png"></div>
							<p><?php echo $row['nom']; ?> <span><?php echo $row['date_f']; ?></span></p>
						</div>
					</div>
				</div>
				<?php 
        }
    } else {
        echo "No courses found.";
    }
?>
				<!-- course -->
			</div>
		</div>
	</section>
	<!-- Page end -->


	<!-- banner section -->
	<section class="banner-section spad">
		<div class="container">
			<div class="section-title mb-0 pb-2">
				<h2>Join Our Community Now!</h2>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
			</div>
			<div class="text-center pt-5">
				<a href="#" class="site-btn">Register Now</a>
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