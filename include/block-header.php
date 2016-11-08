<div id="block-header">
	<div id="header-top-block">
		<ul id="header-top-menu">
			<a href="o-nas.php"><li>О нас</li></a>
			<a href="magaziny.php"><li>Магазины</li></a>
			<a href="contacts.php"><li>Контакты</li></a>
		</ul>

		<?php

if ($_SESSION['auth'] == 'yes_auth')
{
 
 echo '<p id="auth-user-info" align="right"><img src="images/user.png">Здравствуйте, '.$_SESSION['auth_name'].'!</p>';   
    
}else{
 
  echo '<p id="reg-auth-title" align="right"><a class="top-auth">Вход</a><a href="registration.php">Регистрация</a></p>';   
    
}
	
?>
		<div id="block-top-auth">
			<dir class="corner"></dir>
			<form method="POST">
				<ul id="input-email-pass">
					<h3>Вход</h3>
					<p id="message-auth">Неверный логин и(или) пароль</p>
				<li><center><input type="text" id="auth_login" placeholder="Логин или E-mail"></center></li>
				<li><center><input type="password" id="auth_pass" placeholder="Пароль"><span id="button-pass-show-hide" class="pass-show"></span></center></li>

			<ul id="list-auth"></ul>
			<li><input type="checkbox" name="rememberme" id="rememberme"><label for="rememberme">Запомнить меня</label></li>
			<li><a id="remindpass" href="#">Забыли пароль?</a></li>
				</ul>

			<p align="right" id="button-auth"><a>Вход</a></p>

			<p align="right" class="auth-loading"><img src="images/loading.gif" /></p>

			</form>

		</div>
	</div>
	<div id="top-line"></div>
	<img id="img-logo" src="images/logo.png">
	<div id="repsonal-info">
		<p align="right">Звонок беплатный</p>
		<h3 align="right">8 (800) 555-35-35</h3>
		<div id="phones-icon"><img class="phone-icon" src="images/phone-icon.png"></div>
		<p align="right">Режим работы</p>
		<p align="right">Будни дни: с 9:00 до 18:00</p>
		<p align="right">Суббота, Воскресенье - выходные</p>
		<div id="times-icon"><img class="time-icon" src="images/time-icon.png"></div>
	</div>
	<div id="block-search">
		<form method="GET" action="search.php?q=">
		<span></span>
			<input type="text" id="input-search" name="q" placeholder="Поиск товаров"></input>
			<input type="submit" id="button-search" value="Поиск"></input>
		</form>
	</div>
</div>
<div id="top-menu">
	<ul>
		<li><a href="index.php"><img src="./images/shop.png"> Главная</a></li>
		<li><a href="index.php"><img src="./images/new.png"> Новинки</a></li>
		<li><a href="index.php"><img src="./images/bestprice.png"> Лидеры продаж</a></li>
		<li><a href="index.php"><img src="./images/sale.png"> Распродажа</a></li>
	</ul>
	<p align="right" id="block-basket"><a href="">Корзина пуста<img class="cart-icon" src="./images/cart-icon1.png"></a></p>
	<div id="nav-line"></div>

</div>
