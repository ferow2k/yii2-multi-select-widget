<?php
declare(strict_types = 1);

/*
 * This file is part of the 2amigos/yii2-multiselect-widget project.
 * (c) 2amigOS! <http://2amigos.us/>
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 */

namespace cusodede\multiselect;

use yii\helpers\Json;
use yii\web\JsExpression;

/**
 * MultiSelectListBox renders a [Louis Cuny Multiselect listbox widget](http://loudev.com/)
 *
 * @see http://loudev.com/
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\multiselect
 */
class MultiSelectListBox extends MultiSelect {
	/**
	 * Registers MultiSelect JQuery plugin and the related events
	 */
	public $options = ['multiple' => 'multiple'];

	public bool $enableFilter = true;
	public string $selectableFilter = "<input type='text' class='selectable-filter-input' autocomplete='off'>";
	public string $selectionFilter = "<input type='text' class='selection-filter-input' autocomplete='off'>";

	protected function registerPlugin():void {
		$view = $this->getView();

		MultiSelectListBoxAsset::register($view);

		$id = $this->options['id'];

		if ($this->enableFilter) {
			MultiSelectListBoxFilterAsset::register($view);
			$filterParams = [
				"selectableHeader" => $this->selectableFilter,
				"selectionHeader" => $this->selectionFilter,
				"afterInit" => new JsExpression('function(ms) {
					var that = this,
						$selectableSearch = that.$selectableUl.prev(),
						$selectionSearch = that.$selectionUl.prev(),
						selectableSearchString = "#" + that.$container.attr("id") + " .ms-elem-selectable:not(.ms-selected)",
						selectionSearchString = "#" + that.$container.attr("id") + " .ms-elem-selection.ms-selected";
				
					that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
						.on("keydown", function(e) {
							if (e.which === 40) {
								that.$selectableUl.focus();
								return false;
							}
						});
				
					that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
						.on("keydown", function(e) {
							if (e.which == 40) {
								that.$selectionUl.focus();
								return false;
							}
						});
				}'),
				"afterSelect" => new JsExpression("function () {
					this.qs1.cache();
					this.qs2.cache();
				}"),
				"afterDeselect" => new JsExpression("function () {
					this.qs1.cache();
					this.qs2.cache();
				}"),
			];
			$this->clientOptions = array_merge($this->clientOptions, $filterParams);
		}

		$options = [] === $this->clientOptions
			?''
			:Json::encode($this->clientOptions);

		$js = "jQuery('#$id').multiSelect($options);";
		$view->registerJs($js);
	}
}
