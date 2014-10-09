<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<h2>Error <?php echo $code; ?></h2>

<div class="error">
	<?php
		echo CHtml::encode($message);
		if (YII_DEBUG) {
			echo
				'<p>At ' . $file . ': ' . $line . '</p>' .
				'<pre>' . $trace . '</pre>';
		}
	?>
</div>
