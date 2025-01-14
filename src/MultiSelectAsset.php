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

/**
 * Class MultiSelectAsset
 */
class MultiSelectAsset extends AssetBundle {
	use BootstrapTrait;

	public $sourcePath = '@npm/bootstrap-multiselect/dist';

	public $js = [
		'js/bootstrap-multiselect.js'
	];

	public $css = [
		'css/bootstrap-multiselect.css'
	];

	public function init():void {
		$this->depends = $this->isBs4()
			?['yii\bootstrap4\BootstrapPluginAsset']
			:['yii\bootstrap\BootstrapPluginAsset'];
		parent::init();
	}
}
