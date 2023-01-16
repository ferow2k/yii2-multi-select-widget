<?php
declare(strict_types = 1);

namespace cusodede\multiselect;

use yii\web\AssetBundle;

/**
 * Class MultiSelectListBoxAsset
 */
class MultiSelectListBoxFilterAsset extends AssetBundle {
	public $sourcePath = __DIR__.'/assets';

	public $js = [
		'js/filter.js'
	];

	public $css = [
		'css/filter.css'
	];

	public $depends = [
		MultiSelectListBox::class,
	];
}
