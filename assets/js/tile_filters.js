$( document ).ready(function() {
	// store filter per group
	var filters = {};

	// init Isotope
	var $container = $('.product-grid').isotope({
		itemSelector: '.product-item',
	});

	// filter with selects and checkboxes
	var $checkboxes = $('.filter-checkboxes');

	$checkboxes.on('change', function(event) {

		var checkbox = event.target;
  		var $checkbox = $( checkbox );
		var group = $checkbox.parents('.checkboxes').attr('data-group');

		// create array for filter group, if not there yet
		var filterGroup = filters[group];
		if (!filterGroup) {
			filterGroup = filters[group] = [];
		}
		// add/remove filter
		if (checkbox.checked) {
			// add filter
			filterGroup.push('.' + checkbox.value);
		} else {
			// remove filter
			var index = filterGroup.indexOf('.' + checkbox.value);
			filterGroup.splice(index, 1);
		}
		
		var comboFilter = getComboFilter(filters);
		$container.isotope({ filter: comboFilter });
	});

});

function getComboFilter(filters) {
  	var combo = [];
  	for(var prop in filters) {
    	var group = filters[prop];
    	if (!group.length) {
      	// no filters in group, carry on
      	continue;
   		}
    	// add first group
    	if(!combo.length) {
      		combo = group.slice(0);
      		continue;
    	}
		// add additional groups
		var nextCombo = [];
		// split group into combo: [ A, B ] & [ 1, 2 ] => [ A1, A2, B1, B2 ]
		for(var i=0; i < combo.length; i++) {
			for (var j=0; j < group.length; j++) {
				var item = combo[i] + group[j];
				nextCombo.push(item);
			}
		}
		combo = nextCombo;
  }
  var comboFilter = combo.join(', ');
  return comboFilter;
}