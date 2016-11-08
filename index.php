<?php 
include("include/db_connect.php");
include("functions/functions.php");
session_start();
$sorting = isset($_GET['sort']) ? $_GET['sort'] : '';
$sort_name;
switch ($sorting)
{
	case 'price-asc': {

		$sorting = 'price ASC';
		$sort_name = 'От дешевых к дорогим';
		break;	
	}

	case 'price-desc': {
		$sorting = 'price DESC';
		$sort_name = 'От дорогих к дешевым';
		break;
	}

	case 'popular':{
		$sorting = 'count DESC';
		$sort_name = 'Популярное';
		break;
	}

	case 'news':{
		$sorting = 'datetime DESC';
		$sort_name = 'Новинки';
		break;
	}

	case 'brand':{
		$sorting = 'brand';
		$sort_name = 'Новинки';
		break;
	}

	default: {
		$sorting = 'products_id DESC';
		$sort_name = 'Нет сортировки';
		break;   
	}

} 
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/reset.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Интернет-магазин</title>
</head>
<body>
	<div id="block-body">
		<?php 
		include("include/block-header.php");
		?>
		<div id="block-right">
			<?php 
			include("include/block-category.php");
			?>
		</div>
		<div id="block-content">
			<div id="block-sorting">
				<p id="nav-breadcrumbs"><a href="index.php">Главная страница</a> \ <span>Все товары</span></p>
				<ul id="options-list">
					<li>Вид:</li>
					<li><img id="style-grid" src="images/icon-grid.png"></li>
					<li><img id="style-list" src="images/icon-list.png"></li>
					<li>Сортировать:</li>
					<li><a id="select-sort"><?php echo $sort_name;?></a>
						<ul id="sorting-list">
							<li><a href="index.php?sort=price-asc">От дешёвых к дорогим</a></li>
							<li><a href="index.php?sort=price-desc">От дорогих к дешёвым</a></li>
							<li><a href="index.php?sort=popular">Популярное</a></li>
							<li><a href="index.php?sort=news">Новинки</a></li>
							<li><a href="index.php?sort=brand">от А до Я</a></li>
						</ul>
					</li>
				</ul>
			</div>
			<ul id="block-tovar-grid">
				<?php 
				$result = mysqli_query($link, "SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting");
				if (mysqli_num_rows($result) > 0)
				{
					$row = mysqli_fetch_array($result);
					do {

						if  ($row["image"] != "" && file_exists("uploads_images/".$row["image"]))
						{
							$img_path = 'uploads_images/'.$row["image"];
							$max_width = 200; 
							$max_height = 200; 
							list($width, $height) = getimagesize($img_path); 
							$ratioh = $max_height/$height; 
							$ratiow = $max_width/$width; 
							$ratio = min($ratioh, $ratiow); 
							$width = intval($ratio*$width); 
							$height = intval($ratio*$height);    
						}else
						{
							$img_path = "images/no-image.png";
							$width = 110;
							$height = 200;
						} 
						echo '
						<li><div class="block-images-grid">
							<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
						</div>
						<p class="style-title-grid"><a href="#">'.$row["title"].'</a></p>
						<a class="add-cart-style-grid"></a>
						<p class="style-price-grid"><strong>'.$row["price"].'</strong> руб.</p>
						<div class="mini-features">'.$row["mini_features"].'</div>
					</li>';
				} while ($row = mysqli_fetch_array($result));
			}
			?>
		</ul>

		<ul id="block-tovar-list">
			<?php 
			$result = mysqli_query($link, "SELECT * FROM table_products WHERE visible='1' ORDER BY $sorting");
			if (mysqli_num_rows($result) > 0)
			{
				$row = mysqli_fetch_array($result);
				do {

					if  ($row["image"] != "" && file_exists("uploads_images/".$row["image"]))
					{
						$img_path = 'uploads_images/'.$row["image"];
						$max_width = 150; 
						$max_height = 150; 
						list($width, $height) = getimagesize($img_path); 
						$ratioh = $max_height/$height; 
						$ratiow = $max_width/$width; 
						$ratio = min($ratioh, $ratiow); 
						$width = intval($ratio*$width); 
						$height = intval($ratio*$height);    
					}else
					{
						$img_path = "images/noimages80x70.png";
						$width = 80;
						$height = 70;
					} 
					echo '
					<li><div class="block-images-list">
						<img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
					</div>
					<p class="style-title-list"><a href="#">'.$row["title"].'</a></p>
					<a class="add-cart-style-list"></a>
					<p class="style-price-list"><strong>'.$row["price"].'</strong> руб.</p>
					<div class="style-text-list">'.$row["mini_description"].'</div>
				</li>';
			} while ($row = mysqli_fetch_array($result));
		}
		?>
	</ul>
</div>
<?php 
include("include/block-footer.php");
?>
</div>
	<script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>
	<script type="text/javascript" src="js/jquery.cookie.min.js"></script>
	<script type="text/javascript" src="js/shop-script.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<script type="text/javascript" src="js/jquery.validate.js"></script>
</body>
</html>