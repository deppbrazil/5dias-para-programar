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
						<img onclick="abreLightbox(this)" src="assets/<?php echo $item['url']?>" style="width:100%"/>
					</div>
				<?php
			}
		}
	?>

	</div>
	<!-- post -->

	<div id="lightbox-fundo" onclick="fechaLightbox()"></div>
	<div id="lightbox-foto" onclick="fechaLightbox()"></div>

	<script type="text/javascript">
		
		function abreLightbox(obj) {
			//alert("Ok!");
			document.body.scrollTop = 0;
			document.getElementById("lightbox-fundo").style.display = "block";
			document.getElementById("lightbox-foto").style.display = "block";

			var img = obj.getAttribute("src");
			document.getElementById("lightbox-foto").innerHTML = "<img src='"+img+"' width='100%' />";
		}

		function fechaLightbox() {
			document.getElementById("lightbox-fundo").style.display = "none";
			document.getElementById("lightbox-foto").style.display = "none";			
		}

	</script>

</body>
</html>