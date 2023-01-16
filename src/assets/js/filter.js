function afterInit(that) {
	var $selectableSearch = that.$selectableUl.prev(),
		$selectionSearch = that.$selectionUl.prev(),
		selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
		selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

	that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
		.on('keydown', function(e) {
			if (e.which === 40) {
				that.$selectableUl.focus();
				return false;
			}
		});

	that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
		.on('keydown', function(e) {
			if (e.which == 40) {
				that.$selectionUl.focus();
				return false;
			}
		});
};

function quickSearchCache(that) {
	that.qs1.cache();
	that.qs2.cache();
};
