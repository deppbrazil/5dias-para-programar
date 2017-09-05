<?php
	$pdo = new PDO("mysql:dbname=instagram;host=localhost", "root", "");

	//envia foto
	if (isset($_FILES['foto'])) {
		if (!empty($_FILES['foto']['tmp_name'])) {
			$novonome = "foto".rand(0, 1000).time().".jpg";
			move_uploaded_file($_FILES['foto']['tmp_name'], "assets/".$novonome);

			//redimensiona foto
			list($width_origin, $height_origin) = getimagesize("assets/".$novonome);
			$radio = $width_origin / $height_origin;

				if ($radio < 1) {
					$width = 500;
					$height = $width / $radio;
				}
				else { 

					$height = 500;
					$width = $height * $radio;
				}

				$x = (500 - $width) / 2;
				$y = (500 - $height) / 2;

				$novaimg = imagecreatetruecolor(500, 500);
				$img = imagecreatefromjpeg("assets/".$novonome);

				imagecopyresampled($novaimg, $img, $x, $y, 0, 0, $width, $height, $width_origin, $height_origin);

				imagejpeg($novaimg, "assets/".$novonome, 80);
			//redimensiona foto

				$sql = $pdo->prepare("INSERT INTO fotos (url, autor) VALUES (?, ?)");
				$sql->execute(array($novonome, "mir"));

		}
	}
	//envia foto
?>


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

		<div class="formulario">
			<form method="POST" enctype="multipart/form-data">
			<input type="file" name="foto" />
			<input type="submit" value="Enviar foto" />
				
			</form>
		</div>

	<?php
		
		$sql = $pdo->query("SELECT * FROM fotos ORDER by id DESC");

			if($sql->rowCount() > 0) {

				foreach ($sql->fetchAll() as $item) {
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

	<!-- fecha lightbox-->
	<div id="lightbox-fundo" onclick="fechaLightbox()"></div>
	<div id="lightbox-foto" onclick="fechaLightbox()"></div>
	<!-- fecha lightbox-->

	<!-- abre lightbox-->
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
	<!-- abre lightbox-->

</body>
</html>