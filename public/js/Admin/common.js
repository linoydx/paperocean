/**
 *
 * 
 */
eletoggle = function (element1,element2) {
		element1.on('click', function() {
		element2.toggle();
	});
};
$(function() {
	/*
	 * sidebar
	 */
	menutoggle = $('.side-item-main').each( function() {
			$(this).click( function() {
				$(this).next('div').toggle();
			});
		});
	
	persontoggle = eletoggle($('.person-main-photo'),$('.person-main-list'));
});