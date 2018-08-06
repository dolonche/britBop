<?php defined('_JEXEC') or die; ?>
<!DOCTYPE html>
<?php
$app  = JFactory::getApplication();
$doc  = JFactory::getDocument();
$user = JFactory::getUser();
$templateparams = $app->getTemplate(true)->params;
$this->language = $doc->language;
$this->direction = $doc->direction;
$baseuri=JUri::base();
$cssVersion="1.59";
$home =(JURI::getInstance()->toString()==JURI::base());
//JHtml::script($this->baseurl.'templates/'.$this->template.'/js/main.js');
?>
<html lang="<?php echo $this->language ?>">
	<head>
		<?php
			// Удалить генератор
			$app = JFactory::getApplication();
			JFactory::getDocument()->setGenerator('');
		?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/favicons/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/favicons/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/favicons/favicon-16x16.png">
		<link rel="manifest" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/favicons/site.webmanifest">
		<link rel="mask-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/favicons/safari-pinned-tab.svg" color="#5bbad5">
		<link rel="shortcut icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/favicons/favicon.ico">
		<meta name="msapplication-TileColor" content="#2d89ef">
		<meta name="msapplication-config" content="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/img/favicons/browserconfig.xml">
		<meta name="theme-color" content="#ffffff">
		<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/css/styles.min.css?v=<?php echo $cssVersion; ?>" />
		<jdoc:include type="head" />
		<jdoc:include type="modules" name="script-top" style="none" />
	</head>
	<body>
		<div class="container">
			<header class="page-header">
				<div class="page-header__cap">
					<a class="page-header__cap-logo" href="/"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/svg/logo-britbob.svg" alt="Britbob logo"></a>
					<div class="page-header__cap-info">
						<a href="tel:<?php echo $this->params->get('telauto'); ?>"><?php echo $this->params->get('tel'); ?></a>
						<p><?php echo $this->params->get('gorod'); ?>, <?php echo $this->params->get('streetadress'); ?></p>
					</div>
				</div>
				<div class="page-header__bar">
					<nav class="mnav mnav--closed mnav--no-js">
						<button class="mnav__toggle mnav__toggle--closed" type="button">Открыть меню</button>
						<jdoc:include type="modules" name="mnav" style="none" />
					</nav>
					<nav class="hnav">
						<jdoc:include type="modules" name="hnav" style="none" />
					</nav>
					<jdoc:include type="modules" name="social-icons-header" style="none" />
					<jdoc:include type="modules" name="search" style="none" />
				</div>
			</header>
			<jdoc:include type="modules" name="top" style="none" />
			<div class="major <?php if ($home):?>major--index<?php endif; ?> <?php if($this->countModules("sidebar-left") || $this->countModules("sidebar-right")):?>major--mid<?php endif;?>">
				<div class="major__center">
					<jdoc:include type="modules" name="content-top" style="none" />
					<jdoc:include type="component" />
					<jdoc:include type="modules" name="content-bottom" style="none" />
					<jdoc:include type="message" />
				</div>
				<?php if($this->countModules("sidebar-left")):?>
				<div class="sidebar-left">
					<jdoc:include type="modules" name="sidebar-left" style="none" />
				</div>
				<?php endif;?>
				<?php if($this->countModules("sidebar-right")):?>
				<div class="sidebar-right">
					<jdoc:include type="modules" name="sidebar-right" style="none" />
				</div>
				<?php endif;?>
			</div>
			<jdoc:include type="modules" name="bottom" style="none" />
			<footer class="page-footer">
				<div class="page-footer__line">
					<div class="page-footer__wrapper">
						<div class="page-footer__title">Контакты</div>
						<div class="page-footer__contacts" itemscope itemtype="https://schema.org/Organization">
							<meta itemprop="name" content="Britbob Школа парикмахеров">
							<div class="page-footer__contacts-bunch" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
								<div class="page-footer__contacts-bunch-left">Адрес:</div>
								<div class="page-footer__contacts-bunch-right">
									<span itemprop="addressLocality"><?php echo $this->params->get('gorod'); ?></span>, <span itemprop="streetAddress"><?php echo $this->params->get('streetadress'); ?></span>
								</div>
								<meta itemprop="postalCode" content="<?php echo $this->params->get('postalcode'); ?>">
							</div>
							<div class="page-footer__contacts-bunch">
								<div class="page-footer__contacts-bunch-left">E-mail:</div>
								<div class="page-footer__contacts-bunch-right">
									<a itemprop="email" href="mailto:info@britbob.ru"><?php echo $this->params->get('email'); ?></a>
								</div>
							</div>
							<div class="page-footer__contacts-bunch">
								<div class="page-footer__contacts-bunch-left">Тел.:</div>
								<div class="page-footer__contacts-bunch-right">
									<a itemprop="telephone" href="tel:<?php echo $this->params->get('telauto'); ?>"><?php echo $this->params->get('tel'); ?></a>
								</div>
							</div>
							<div itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">
								<img itemprop="url image" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/svg/logo-britbob.svg" alt="britbob logo" style="display:none;"/>
							</div>
						</div>
					</div>
					<div class="page-footer__line2">
						<div class="page-footer__wrapper page-footer__wrapper--social">
							<div class="page-footer__title">Социальные сети</div>
							<jdoc:include type="modules" name="social-icons-footer" style="none" />
						</div>
						<div class="page-footer__wrapper">
							<div class="page-footer__title">Принимаем к оплате</div>
							<div class="page-footer__payment">
								<jdoc:include type="modules" name="payment" style="none" />
							</div>
						</div>
					</div>
				</div>
				<div class="page-footer__line">
					<div class="page-footer__wrapper">
						<nav class="footernav">
							<jdoc:include type="modules" name="footer-nav" style="none" />
						</nav>
					</div>
					<div class="page-footer__wrapper page-footer__wrapper--copyright">
						<div class="page-footer__copyright">&copy; <?php echo $this->params->get('copyright'); ?> <?php echo $this->params->get('god_os');?> - <?php echo date("Y");?></div>
					</div>
				</div>
			</footer>
		</div>
		<script src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template; ?>/js/main.js?v=<?php echo $cssVersion; ?>"></script>
		<jdoc:include type="modules" name="script-bottom" style="none" />
	</body>
</html>