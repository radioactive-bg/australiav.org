    <script src="<?php echo get_template_directory_uri();?>/template-parts/product-catalog/assets/js/filtable.min.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/template-parts/product-catalog/assets/js/validation.js"></script>
    <script>
  jQuery(document).ready(function () {
    "use strict";

    // Initialize filtable plugin
    jQuery("#data").filtable({ controlPanel: jQuery(".table-filters") });

    // Reset filter functionality
    jQuery("#FilterReset").click(function () {
      var currencyOptionFirst = jQuery('#filter-payment option:first');
      var levelOptionFirst = jQuery('#filter-level option:first');
      currencyOptionFirst.prop('selected', true).trigger('change');
      levelOptionFirst.prop('selected', true).trigger('change');
      jQuery('#filter-name').val('').focus();

      setTimeout(function () {
        jQuery('#data tbody tr').removeClass('hidden');
        jQuery('#data tbody tr:nth-of-type(odd)').addClass('odd');
        jQuery('#data tbody tr:nth-of-type(even)').addClass('even');
      }, 10);
    });

    // Handle button click inside #data
    jQuery(document).on('click', '#data button', function () {
      var $this = jQuery(this);
      var element = $this.closest('tr').find('td:nth-of-type(2)').html();
      var inputElement = jQuery('input[name="SingleLine3"]');
      inputElement.val(element);
    });

    // Handle button click inside .card-header
    jQuery(document).on('click', '.card-header button', function () {
      var inputElement = jQuery('input[name="SingleLine3"]');
      inputElement.val('');
    });

    // Detect changes in select or input fields
    jQuery('select, input').on('change keydown keyup', function () {
      setTimeout(function () {
        var className = "hidden";
        var $elements = jQuery('#data tbody').find("tr").toArray();

        var allHaveSameClass = $elements.every(function (element) {
          return jQuery(element).hasClass(className);
        });

        if (allHaveSameClass) {
          jQuery('tfoot').find('td').removeClass('d-none').addClass('d-block');
        } else {
          jQuery('tfoot').find('td').removeClass('d-block').addClass('d-none');
        }
      }, 50);
    });

    // Populate select with repeating values
    var values = [];
    var table = jQuery("#data");

    table.find("tbody tr").each(function () {
      values.push(jQuery(this).find("td:nth-of-type(3)").html());
    });

    var valueCounts = {};
    values.forEach(function (value) {
      if (valueCounts[value]) {
        valueCounts[value]++;
      } else {
        valueCounts[value] = 1;
      }
    });

    var repeatingValues = Object.keys(valueCounts).filter(function (value) {
      return valueCounts[value] > 1;
    });

    var $select = jQuery("#filter-payment");
    $select.empty();
    $select.append('<option value="">- All -</option>');
    repeatingValues.forEach(function (value) {
      $select.append('<option value="' + value + '">' + value + '</option>');
    });

    // Initialize LazyLoad
    // var lazyLoadInstance = new LazyLoad({
    //   container: document.querySelector("#data"),
    // });
    // lazyLoadInstance.update();
  });
</script>


	<script>
	   // Function to set a cookie
	   function setCookie(name, value, days) {
		var expires = "";
		if (days) {
			var date = new Date();
			date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
			expires = "; expires=" + date.toUTCString();
		}
		document.cookie = name + "=" + (value || "") + expires + "; path=/";
	   }

	   // Function to get a cookie
	   function getCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for (var i = 0; i < ca.length; i++) {
			var c = ca[i];
			while (c.charAt(0) == ' ') c = c.substring(1, c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
		}
		return null;
	   }

	   // Function to populate form fields from cookies
		function populateForm() {
			document.getElementsByName('SingleLine')[0].value = getCookie('name') || '';
			document.getElementsByName('PhoneNumber_countrycode')[0].value = getCookie('phone') || '';
			document.getElementsByName('Email')[0].value = getCookie('email') || '';
			document.getElementsByName('SingleLine2')[0].value = getCookie('company') || '';
		}
		
		// Function save form data to cookies when close the modal or submit form
		function saveForm() {
			var name = document.getElementsByName('SingleLine')[0].value;
			var phone = document.getElementsByName('PhoneNumber_countrycode')[0].value;
			var email = document.getElementsByName('Email')[0].value;
			var company = document.getElementsByName('SingleLine2')[0].value;
			setCookie('name', name, 7); // Expires in 7 days
			setCookie('phone', phone, 7); // Expires in 7 days
			setCookie('email', email, 7); // Expires in 7 days
			setCookie('company', company, 7); // Expires in 7 days
		}
		
		// Event listener to close the modal and save form data to cookies
		var myModal = document.getElementById('Modal');
		myModal.addEventListener('show.bs.modal', function () {
		  populateForm();
		})
		myModal.addEventListener('hide.bs.modal', function () {
		  saveForm();
		})

		// Get all elements with the class name 'zf-submitColor'
		var buttons = document.getElementsByClassName('zf-submitColor');
		// Attach click event listener to each button
		for (var i = 0; i < buttons.length; i++) {
			buttons[i].addEventListener('click', function() {
				saveForm();
			});
		}

	   // Populate form on initial load
	   document.addEventListener('DOMContentLoaded', populateForm);
	</script>