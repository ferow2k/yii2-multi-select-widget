<?php
declare(strict_types = 1);

/*
 * This file is part of the 2amigos/yii2-multiselect-widget project.
 * (c) 2amigOS! <http://2amigos.us/>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace cusodede\multiselect;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Class MultiSelectListBoxAsset
 */
class MultiSelectListBoxAsset extends AssetBundle {
	public $sourcePath = '@npm/multiselect';

	public $js = [
		'js/jquery.multi-select.js'
	];

	public $css = [
		'css/multi-select.css'
	];

	public $depends = [
		JqueryAsset::class,
	];
}
