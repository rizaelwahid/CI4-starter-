jQuery(function($) {
	if(!ace.vars['touch']) {
		$('.chosen-select').chosen({allow_single_deselect:true}); 
		//resize the chosen on window resize

		$(window)
		.off('resize.chosen')
		.on('resize.chosen', function() {
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			})
		}).trigger('resize.chosen');
		//resize chosen on sidebar collapse/expand
		$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
			if(event_name != 'sidebar_collapsed') return;
			$('.chosen-select').each(function() {
				 var $this = $(this);
				 $this.next().css({'width': $this.parent().width()});
			})
		});


		$('#chosen-multiple-style .btn').on('click', function(e){
			var target = $(this).find('input[type=radio]');
			var which = parseInt(target.val());
			if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
			 else $('#form-field-select-4').removeClass('tag-input-style');
		});
	}
	
<!--FOR SIDEBAR 2-->
   $('#sidebar2').insertBefore('.page-content');
   $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');
   $(document).on('settings.ace.two_menu', function(e, event_name, event_val) {
	 if(event_name == 'sidebar_fixed') {
		 if( $('#sidebar').hasClass('sidebar-fixed') ) {
			$('#sidebar2').addClass('sidebar-fixed');
			$('#navbar').addClass('h-navbar');
		 }
		 else {
			$('#sidebar2').removeClass('sidebar-fixed')
			$('#navbar').removeClass('h-navbar');
		 }
	 }
   }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed' ,$('#sidebar').hasClass('sidebar-fixed')]);
});