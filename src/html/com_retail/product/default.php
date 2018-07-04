<?php defined("JPATH_PLATFORM") or die;
/**
 *	Макет страницы вывода подробных сведений о курсе
 *
 *   поля объекта $this->item (формат обращения к полям $this->item->имя_поля, например $this->item->discount)
 *
  public 'id' => 		(код товара)
  public 'title' =>  	(наименование товара)
  public 'alias' =>  	(псевдоним)
  public 'intro' =>  	(краткое описание/вступление)
  public 'description' =>  	(полное описание)
  public 'catid' => 	(код категории)
  public 'asset_id' => 	(не используется)
  public 'price' => 	(цена полная)
  public 'demoprice' => (цена демо)
  public 'discount' => 	(скидка на полную цену)
  public 'demodiscount' => (скидка на демо цену)
  public 'images' => (изображения. Пример обращения: <?php echo JUri::base().$this->item->images->intro->image; ?>)
    object(stdClass)
      public 'intro' => (малое изображение)
        object(stdClass)
          public 'image' => (путь к файлу, относительно корневой директории joomla.)
          public 'float' => (выравнивание, варианты: "","left","right","none")
          public 'alt' => 	(атрибут alt)
          public 'caption' => (текст для caption)
          public 'title' => (атрибут title)
      public 'medium' =>
        object(stdClass)[393]
          public 'image' => (путь к файлу, относительно корневой директории joomla.)
          public 'float' => (выравнивание, варианты: "","left","right","none")
          public 'alt' => 	(атрибут alt)
          public 'caption' => (текст для caption)
          public 'title' => (атрибут title)
      public 'fulltext' =>
        object(stdClass)[394]
          public 'image' => (путь к файлу, относительно корневой директории joomla.)
          public 'float' => (выравнивание, варианты: "","left","right","none")
          public 'alt' => 	(атрибут alt)
          public 'caption' => (текст для caption)
          public 'title' => (атрибут title)
          				формат полей даты/времени стандартный: string "Y-m-d H:i:s" ('0000-00-00 00:00:00')
  public 'publish_up' => (время начала курса)
  public 'publish_down' => (время окончания курса)
  public 'expiration' => (время окончания записи)
  public 'published' =>  ("1" - опубликовано, "0" - нет)
  public 'checked_out' => 		(блокировка)
  public 'checked_out_time' => 	(время блокировки)
  public 'ordering' => (порядковый номер в списке)
  public 'created_by' => (создатель)
  public 'created' => (время создания)
  public 'metakey' => (соответствующие мета-данные)
  public 'metadesc' => (соответствующие мета-данные)
  public 'metadata' => (соответствующие мета-данные)
  public 'pagetitle' => (заголовок окна/вкладки браузера)
  public 'language' => (тег языка, не используется)
  public 'hits' => (счётчик просмотров, не используется)
  public 'featured' => ("1" - в "избранных", 0 - "нет")
  ------------------------------------------------------------------
  макросы типа JHtml::_("retail...") находятся в файле components\com_retail\helpers\html\retail.php
  
 */
?>
<?php
$doc = JFactory::getDocument();
$baseuri=JUri::base();
JHtml::_("jquery.framework");
JHtml::_("bootstrap.framework");
$doc->addStyleSheet("{$baseuri}media/com_retail/colorbox/colorbox.css");
$doc->addScript("{$baseuri}media/com_retail/colorbox/jquery.colorbox-min.js");
JHtml::script("com_retail/default.js",false,true);
$images=$this->item->images;
$image_alt=empty($images->medium->alt)?$this->item->title:$images->medium->alt;
$image_title=empty($images->medium->title)?$this->item->title:$images->medium->title;
$img=JHtml::image($images->medium->image, $image_alt, array("title"=>$image_title));
if(!empty($images->fulltext->image))
	$img=JHtml::link($images->fulltext->image, $img, array("class"=>"modal"));?>
<div class="gapp retail wrapper">
	<div class="product">
		<form action="<?php echo JRoute::_("index.php"); ?>" name="jform" id="jform" method="post">
			<h1><?php echo $this->item->title; ?></h1>
			<div class="card">
			<?php if($images->medium->image):?>
			<?php $class=empty($images->medium->float)?"":" {$images->medium->float}";
    			  $class.=empty($images->medium->class)?"":" {$images->medium->class}";?>
			
				<figure class="image<?php echo $class;?>">
					<?php echo $img;?>
					<figcaption><?php echo $images->medium->caption;?></figcaption>
				</figure>
			<?php endif;?>
				<div class="features">
					<ul>
						<li>
							<strong><?php echo JText::_("COM_RETAIL_ITEM_FEATURE_DATE_START");?>:</strong>
							<time datetime="<?php echo JHtml::date($this->item->publish_up, "Y-m-d");?>">
								<?php echo JHtml::date($this->item->publish_up, "d.m.Y H:i");?>
							</time>
						</li>
						<li>
							<strong><?php echo JText::_("COM_RETAIL_ITEM_FEATURE_DATE_END");?>:</strong>
							<time datetime="<?php echo JHtml::date($this->item->publish_down, "Y-m-d");?>">
								<?php echo JHtml::date($this->item->publish_down, "d.m.Y H:i");?>
							</time>
						</li>
						<li><strong><?php echo JText::_("COM_RETAIL_ITEM_FEATURE_PRICE");?>:</strong>
						<?php if($this->item->discount>0):?>
							<span class="oldprice"><?php echo JHtml::_("retail.pformat",$this->item->price);?></span>
							<?php echo JHtml::_("retail.pformat", $this->item->price-$this->item->discount,1);?>
						<?php else:?>
							<?php echo JHtml::_("retail.pformat", $this->item->price,1);?>
						<?php endif;?>
						</li>
						<?php if((int)$this->item->demoprice>0):?>
							<li><strong><?php echo JText::_("COM_RETAIL_ITEM_FEATURE_DEMOPRICE");?>:</strong>
							<?php if((int)$this->item->demodiscount>0):?>
								<span class="oldprice"><?php echo JHtml::_("retail.pformat", $this->item->demoprice);?></span>
								<?php echo JHtml::_("retail.pformat", $this->item->demoprice-$this->item->demodiscount,1);?>
							<?php else:?>
								<?php echo JHtml::_("retail.pformat", $this->item->demoprice,1);?>
							<?php endif;?>
						<?php endif;?>
					</ul>
				</div>
				<?php if(JDate::getInstance($this->item->expiration)>=JDate::getInstance()):?>
					<button class="oto" data-href="<?php echo $this->otolink;?>" data-id="<?php echo $this->item->id;?>">
						<?php echo JText::_("COM_RETAIL_SIGN_IN_BUTTON_CAPTION");?>
					</button>
					<p> </p>
				<?php endif;?>
				<div class="description">
					<?php echo JHtml::_("content.prepare",$this->item->description); ?>
				</div>
			</div>
			<div class="bottom">
			</div>
			
			<input type="hidden" name="option" value="com_retail" />
			<input type="hidden" name="view" value="product" />
			<input type="hidden" name="task" value="" />
			<input type="hidden" name="product_id" value="<?php echo $this->item->id; ?>" />
		</form>
		<div>
  			<?php echo JHtml::_("retail.commentform", $this->item->id, $this->item->title); ?>
		</div>
		</div>
</div>
