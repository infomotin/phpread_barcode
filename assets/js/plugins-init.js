function initFormPlugins(){
	$(".ion-range").ionRangeSlider({input_values_separator:'-'});
}
function loadPageData(ajaxPage, url){
	let pageType = ajaxPage.data('page-type');
	if(pageType == "list"){
		ajaxPage.find(".ajax-page-load-indicator").first().show();
		ajaxPage.find("table,.page-content").first().addClass("loading");
		ajaxPage.find("table tbody .page-data,.page-content .page-data").first().load(url, function(){
			ajaxPage.find("table,.page-content").first().removeClass("loading");
			ajaxPage.find(".ajax-page-load-indicator").first().hide();
		});
	}
	else{
		ajaxPage.find(".ajax-page-load-indicator").first().show();
		ajaxPage.find("table,.page-content").first().addClass("loading");
		ajaxPage.load(url);
	}
}
$(function() {
	initFormPlugins()
	$('.ajax-pagination').each(function(){
		var pager = $(this);
		var totalPage = parseInt(pager.data("total-page")) || 1;
		var range = parseInt(pager.data("range")) || 5;
		var page = pager.closest(".ajax-page");
		pager.twbsPagination({
			paginationClass: 'pagination pagination-sm',
			totalPages: totalPage,
			visiblePages: range,
			initiateStartPageClick: false,
			first: '<i class="fa fa-angle-double-left"></i>',
			prev: '<i class="fa fa-angle-left"></i>',
			next: '<i class="fa fa-angle-right"></i>',
			last: '<i class="fa fa-angle-double-right"></i>',
			onPageClick: function (event, pageNum) {
				var pageUrl = page.data("page-url");
				var url = new Url(pageUrl);
				url.query.limit_start = pageNum; // adds or replaces the param
				var path = url.toString();
				loadPageData(page, path);
				page.data("page-url", path); //update page link
				pager.closest("form").find(".page-num").val(pageNum);
				var totalRecords = parseInt(pager.data("total-records"));
				var limitCount = parseInt(pager.data("limit-count"));
				var recordPosition = Math.min((pageNum * limitCount), totalRecords);
				pager.closest("form").find(".record-position").html(recordPosition);
			}
		}).on('page', function (event, pageNum) {
		});;
	});
	$('.has-tooltip').tooltip();
	$('[data-toggle="tooltip"]').tooltip({trigger: 'manual'}).tooltip('show');
	$(".switch-checkbox").bootstrapSwitch();
	$('input.password-strength').passwordStrength();
	/**
	 * Ajax load popover content
	 */
	$('.open-page-popover').popover({
		title : '<div class="clearfix"><a class="close" data-dismiss="alert">&times;</a></div>',
		template: '<div class="popover inline-page" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
		html: true,
		container: 'body',
		content: function(){
			var divID =  "tmp-id-" + $.now();
			var link = $(this).attr('href')
			$.ajax({
				url: link,
				success: function(response){
					$('#' + divID).html(response);
				}
			});
			return '<div class="reset-grids" id="'+ divID +'">' + pageLoadingIndicator + '</div>';// + footer;
		}
	});
	$.fn.editableform.buttons = '<button type="submit" class="btn btn-sm btn-primary editable-submit">&check;</button><button type="button" class="btn btn-sm btn-secondary editable-cancel">&times;</button>';
	$.fn.editable.defaults.ajaxOptions = {type: "post"};
	$.fn.editable.defaults.params = {csrf_token : csrfToken};
	$.fn.editable.defaults.emptytext = '...';
	$.fn.editable.defaults.textFieldName = 'label';
	$('.is-editable').editable();
	$(document).on('click', '.inline-edit-btn', function(e){
		e.stopPropagation();
		$(this).closest('td').find('.make-editable').editable('toggle');
	});
	$('.smartwizard').each(function(){
		var theme = $(this).data('theme') || "dots";
		$(this).smartWizard({
			selected: 0,  // Initial selected step, 0 = first step 
			keyNavigation:true, // Enable/Disable keyboard navigation(left and right keys are used if enabled)
			autoAdjustHeight:false, // Automatically adjust content height
			cycleSteps: false, // Allows to cycle the navigation of steps
			backButtonSupport: true, // Enable the back button support
			useURLhash: true, // Enable selection of the step based on url hash
			toolbarSettings: {
				toolbarPosition: 'bottom', // none, top, bottom, both
				toolbarButtonPosition: 'left', // left, right
				showNextButton: false, // show/hide a Next button
				showPreviousButton: false, // show/hide a Previous button
			}, 
			anchorSettings: {
				anchorClickable: true, // Enable/Disable anchor navigation
				enableAllAnchors: false, // Activates all anchors clickable all times
				markDoneStep: true, // add done css
				enableAnchorOnDoneStep: true // Enable/Disable the done steps navigation
			},            
			theme: theme, // dots,circles,arrows
			transitionEffect: 'fade', // Effect on navigation, none/slide/fade
			transitionSpeed: '400'
		});
	});
	$('.smartwizard form').submit(function(e){
		var currentForm = $(this)[0];
		if(currentForm.checkValidity()){
			e.preventDefault();
			var nextPage = $(this).closest('.formtab').data('next-page');
			var submitAction = $(this).closest('.formtab').data('submit-action');
			var method = $(this).attr('method');
			var url = $(this).attr('action');
			var formData = '';
			if(submitAction == 'SUBMIT-STEP-FORM'){
				formData = $(currentForm).serialize();
			}
			else if(submitAction == 'SUBMIT-ALL-FORMS'){
				$('.smartwizard form').each(function(e){
					formData = formData + '&' + $(this).serialize();
				});
				var allFormUrl = $(this).closest('.formtab').data('form-action');
				if(allFormUrl){
					url = allFormUrl
				}
			}
			if(formData){
				$.ajax({
					type: method,
					url: url,
					data: formData,
					success: function (data) {
						console.log('Submission was successful.');
						window.location.href = '#' + nextPage;
					},
					error: function (data) {
						console.log('An error occurred subiting the form');
					},
				});
			}
			else{
				window.location.href = '#' + nextPage;
			}
		}
	})
});
