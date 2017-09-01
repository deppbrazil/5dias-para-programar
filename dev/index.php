<!DOCTYPE html>
<html>
<head>
	<title>Instagram</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>

	<!-- cabeçalho -->
	<div id="primeira">
		<div id="topo">
			<img id="logo" src="assets/instagram_logo.png"/>
		</div>
	</div>
	<!-- cabeçalho -->	

	<!-- post -->
	<div class="area">

	<?php
		$pdo = new PDO("mysql:dbname=instagram;host=localhost", "root", "");

		$sql = $pdo->query("SELECT * FROM fotos");

			if($sql->rowCount() > 0) {

				foreach($sql->fetchAll() as $item) {
				?>
					<div class="post"> 
						<img src="assets/<?php echo $item['url']?>" style="width:100%"/>
					</div>
				<?php
			}
		}
	?>

	</div>
	<!-- post -->



</body>
</html>