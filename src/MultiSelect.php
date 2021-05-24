<?php
declare(strict_types = 1);

/*
 * This file is part of the 2amigos/yii2-multiselect-widget project.
 * (c) 2amigOS! <http://2amigos.us/>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace dosamigos\multiselect;

use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\InputWidget;

/**
 * MultiSelect renders a [David Stutz Multiselect widget](http://davidstutz.github.io/bootstrap-multiselect/)
 *
 * @see http://davidstutz.github.io/bootstrap-multiselect/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\widgets
 *
 * @property array $data data for generating the list options (value=>display)
 * @property array $clientOptions the options for the Bootstrap Multiselect JS plugin
 */
class MultiSelect extends InputWidget {
	/**
	 * @var array data for generating the list options (value=>display)
	 */
	public array $data = [];
	/**
	 * @var array the options for the Bootstrap Multiselect JS plugin.
	 *            Please refer to the Bootstrap Multiselect plugin Web page for possible options.
	 * @see http://davidstutz.github.io/bootstrap-multiselect/#options
	 */
	public array $clientOptions = [];

	/**
	 * Initializes the widget.
	 * @throws InvalidConfigException
	 */
	public function init():void {
		if ([] === $this->data) {
			throw new InvalidConfigException('"Multiselect::$data" attribute cannot be blank or an empty array.');
		}
		parent::init();
	}

	/**
	 * @inheritdoc
	 */
	public function run() {
		if ($this->hasModel()) {
			echo Html::activeDropDownList($this->model, $this->attribute, $this->data, $this->options);
		} else {
			echo Html::dropDownList($this->name, $this->value, $this->data, $this->options);
		}
		$this->registerPlugin();
	}

	/**
	 * Registers MultiSelect Bootstrap plugin and the related events
	 */
	protected function registerPlugin():void {
		$view = $this->getView();

		MultiSelectAsset::register($view);

		$id = $this->options['id'];

		$options = [] !== $this->clientOptions
			?Json::encode($this->clientOptions)
			:'';

		$js = "jQuery('#$id').multiselect($options);";
		$view->registerJs($js);
	}
}
