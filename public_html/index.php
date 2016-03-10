<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;

/*set page title here*/
$PAGE_TITLE = "Welcome to Time Crunch";

/*load head-utils.php - edit path as needed*/
require_once("php/templates/head-utils.php");
?>

<body class="mainView" ng-controller="mainController">
		<div class="mainViewContent">

			<!--header & nav -->
			<?php require_once("php/templates/header.php");?>

			<main class="p-y-4">
				<div class="container">
					<!-- Main content and injected views -->

					<div ng-view></div>

					<!-- /main content -->
				</div>
			</main>
		</div>  <!-- /mainView -->

	<!-- footer -->
	<?php require_once("php/templates/footer.php");?>

</body>
</html>
