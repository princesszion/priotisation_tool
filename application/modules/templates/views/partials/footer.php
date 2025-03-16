<!-- ============================ Footer Start ================================== -->
<footer class="light-footer skin-light-footer style-2">


	<div class="footer-bottom br-top">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-12 col-md-12 text-center">
					<p class="mb-0">© <?php echo date('Y') ?> Africa CDC.</p>
				</div>
			</div>
		</div>
	</div>
</footer>
<!-- ============================ Footer End ================================== -->

<!-- Log In Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="loginmodal" aria-hidden="true">
	<div class="modal-dialog modal-xl login-pop-form" role="document">
		<div class="modal-content" id="loginmodal">
			<div class="modal-headers">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span class="ti-close"></span>
				</button>
			</div>

			<div class="modal-body p-5">
				<div class="text-center mb-4">
					<h2 class="m-0 ft-regular">Login</h2>
				</div>

				<?php echo form_open(base_url('auth/login')); ?>

				<input type="hidden" name="route" value="front" />
				<div class="form-group">
					<label>User Name</label>
					<input type="text" name="username" class="form-control" placeholder="Username*">
				</div>

				<div class="form-group">
					<label>Password</label>
					<input type="password" name="password" class="form-control" placeholder="Password*">
				</div>

				<div class="form-group">
					<div class="d-flex align-items-center justify-content-between">
						<div class="flex-1">
							<input id="dd" class="checkbox-custom" name="dd" type="checkbox">
							<label for="dd" class="checkbox-custom-label">Remember Me</label>
						</div>
						<div class="eltio_k2">
							<a href="#" class="theme-cl">Lost Your Password?</a>
						</div>
					</div>
				</div>

				<div class="form-group">
					<button type="submit"
						class="btn btn-md full-width theme-bg text-light fs-md ft-medium">Login</button>
				</div>

				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>
<!-- End Modal -->

<a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


</div>
<!-- ============================================================== -->
<!-- End Wrapper -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->

<script src="<?php echo base_url(); ?>resources/js/jquery.min.js"></script>


<div id="google_translate_element" style="display:none;"></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.2/js/bootstrap-select.min.js"
	type="text/javascript"></script>
<script>
	//mobile change select
    function handleLanguageChange(selectElement) {
        var selectedLanguage = selectElement.value;
        doGTranslate(selectedLanguage);
    }
</script>
<script type="text/javascript">
	function googleTranslateElementInit() {
		new google.translate.TranslateElement({
			pageLanguage: 'en',
			autoDisplay: false,
			disableAutoHover: true,
			showBanner: false
		},
			'google_translate_element');

	}
</script>



<script type="text/javascript">
	//use if u need to set a langauge from the database
	//  $(document).ready(function () {
	//     doGTranslate('en'); // Translate the page in the user langauge
	//   });
	function GTranslateGetCurrentLang() { var keyValue = document['cookie'].match('(^|;) ?googtrans=([^;]*)(;|$)'); return keyValue ? keyValue[2].split('/')[2] : null; }
	function GTranslateFireEvent(element, event) { try { if (document.createEventObject) { var evt = document.createEventObject(); element.fireEvent('on' + event, evt) } else { var evt = document.createEvent('HTMLEvents'); evt.initEvent(event, true, true); element.dispatchEvent(evt) } } catch (e) { } }

	function doGTranslate(lang_code) {


		var lang = lang_code || 'en'; // transalte to provided langauge
		var teCombo = document.querySelector('select.goog-te-combo:not(.menu-language-menu-container select)');

		if (!teCombo || !teCombo.innerHTML) {
			setTimeout(function () { doGTranslate(lang_code) }, 500);
			return;
		}

		var langIndex = Array.from(teCombo.options).findIndex(option => option.value === lang);

		if (langIndex !== -1) {
			teCombo.selectedIndex = langIndex;
			GTranslateFireEvent(teCombo, 'change');
			GTranslateFireEvent(teCombo, 'change');
		}
	}


</script>
<script>
	$(function () {
		$('.selectpicker').selectpicker();
	});




</script>
<script type="text/javascript"
	src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<script src="<?php echo base_url(); ?>resources/js/popper.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/slick.js"></script>
<script src="<?php echo base_url(); ?>resources/js/slider-bg.js"></script>
<script src="<?php echo base_url(); ?>resources/js/smoothproducts.js"></script>
<script src="<?php echo base_url(); ?>resources/js/snackbar.min.js"></script>
<script src="<?php echo base_url(); ?>resources/js/jQuery.style.switcher.js"></script>
<script src="<?php echo base_url(); ?>resources/js/custom.js"></script>


<!-- ============================================================== -->
<!-- This page plugins -->
<!-- ============================================================== -->

<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script>
	$(document).ready(function () {
		$('#search-button').on('click', function () {
			performSearch();
		});

		$('#search-input').on('keypress', function (e) {
			if (e.which === 13) {
				performSearch();
			}
		});

		function performSearch() {
			var searchTerm = $('#search-input').val();
			$.ajax({
				url: '<?= site_url('records/search') ?>',
				method: 'GET',
				data: { term: searchTerm },
				success: function (response) {
					$('#outbreak-events').html(response);
				},
				error: function () {
					alert('An error occurred while searching. Please try again.');
				}
			});
		}
	});
</script>

<script>
	setTimeout(function () {
		var alert = document.getElementById('autoHideAlert');
		if (alert) {
			alert.style.transition = 'opacity 0.5s';
			alert.style.opacity = '0';
			setTimeout(function () {
				alert.style.display = 'none';
			}, 500);
		}
	}, 3000);
</script>
<script type="text/javascript">
	$('.autocomplete').autocomplete({
		source: "<?php echo base_url(); ?>records/autocomplete",
		minLength: 3,
		select: function (event, ui) {
			console.log(ui.item);
			$('.term').val(ui.item.label);
			$('.search-form').submit();
		}
	});

	$(document).ready(function () {
		$('#summernote').summernote({
			placeholder: 'Discussion body here',
			tabsize: 2,
			height: 200
		});
	});

	//Quizz
</script>




</body>

</html>