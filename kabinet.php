<?php
session_start();
require_once 'session.class.php';

	if ( !(Session::has('name')) ) { ?>
		<script type="text/javascript">location="http://local/index.php"; </script>
	<?php }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Саноторная школа-интернат №32</title>
        <meta name="keywords" content="школа, интернат, саноторная, бюджетное,учреждение,государственное">
        <meta name="description" content="Здесь вы узнаете все о саноторной школе-интернат №32">
        <link rel="stylesheet" href="css/style.css">
    </head>
    <body>
		<div class="heder">
			<div  class="zagolov">
				<h1><span>Государственно бюджетное образовательное учреждение</span>
					<span>Саноторная школа-интернат №32</span>
				</h1>
			</div> 	
		</div> 
		<div class=menu>
			<ul>
				<li><a href="#"></a></li>
				<li><a class="activ" href="/">Об организации</a></li>
				<li><a href="#">Социальные услуги</a></li>
				<li><a href="#">Документы</a></li>
				<li><a href="#">Получатели социальных услуг</a></li>
				<? if (Session::has('name')) { ?>
				<li><a href="kabinet.php">Кабинет</a></li>
				<li><a href="logout.php">Выход(<?=Session::get('name'); ?>)</a></li>
				<? } else { ?>
				<li><a href="autorization.php">Авторизация</a></li>
				<li><a href="register.php">Регестрация</a></li>
				 <? } ?>
			</ul>
		</div>
		<div class="centr clearfix">
			<div class="said">
				<ul>
					<li><p><a href="">> <span>Общая информация</span></a></p></li>
					<li><p><a href="#">> <span>Структура и органы управления</span></a></p></li>
					<li><p><a href="#">> <span>Коллектив</span></a></p></li>
					<li><p><a href="#">> <span>Материально-техническое обеспечение предоставления социальных услуг</span></a></li>
					<li><p><a href="#">> <span>Фининсово-хозяйственная деятельность</span></a></p></li>
					<li><p><a href="#">> <span>Предписания и отчеты об их исполнении</span></a></p></li>
					<li><p><a href="#">> <span>Независимая оценка качества оказания услуг</span></a></p></li>
				</ul>
			</div>
			<div class="content">	
				<div class="cont-niz">
					<p>
						<p class="zag"><b>Личный кабинет преподавателя:(<?=Session::get('name'); ?>)</b></p>
						<ul>
							<li>Хорошо ладит с детьми</li>
							<li>Закончил аспирантуру</li>
							<li>Работает бесплатно</li>
							<li>Не женат</li>
						</ul>
					</p>
				</div>	
			</div>
		</div>
		<div class="futer_center">
			<div class="futer">
				<span>2006-2012 ГБОУ Санаторная школа-интернат №32</span>
			</div>
		</div>		
	</body>
</html>