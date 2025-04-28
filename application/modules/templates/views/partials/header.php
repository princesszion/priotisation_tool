<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->
<!-- Start Navigation -->
<div id="langauge-container" style="margin-bottom:-4px">
	<div class="p-3 bg-light">
		<div class="container" style="min-width: 90%;">
			<div class="row align-items-center">
				<div class="col-lg-3 col-md-3 d-none d-md-block">
					<div><a class="nav-brand" href="<?php echo base_url() ?>">
							<a class="nav-brand" href="<?php echo base_url() ?>">
								<img src="<?php echo base_url() ?>assets/images/logo.png" class="logo" alt=""
									style="height:85px;" />
							</a>
						</a>
					</div>
					<div class="mt-1 text-secondary">
						<!-- slogan -->
					</div>
				</div>
				<div class="col-lg-5 col-md-5 text-center ">
					<a href="<?php echo base_url() ?>">
						<h3 style="color:black !important; font-weight:bold; margin-bottom: 7px;" class="notranslate">
							Africa CDC Research Priotisation Tool
							<h3 class="slogan fw-bold" style="font-size: 14px; margin-bottom: 7px; margin-left: 20px;">
								<?= @$memberstate ?>
							</h3>
					</a>

				</div>
				<div class="col-lg-4 col-md-4 text-end d-none d-md-block justify-content-end">
					<div id="google_translate_element" style="display: none;"></div>

					<div class="menu-language-menu-container">

						<ul id="menu-language-menu" class="language-menu">
							<b>Languages:</b>
							<li class="menu-item menu-item-gtranslate">
								<a href="#" onclick="doGTranslate('en'); return false;" title="English"
									class="link notranslate">English</a>
							</li>
							|
							<li class="menu-item menu-item-gtranslate">
								<a href="#" onclick="doGTranslate('fr'); return false;" title="French"
									class="link notranslate">French</a>
							</li>|
							<li class="menu-item menu-item-gtranslate">
								<a href="#" onclick="doGTranslate('ar'); return false;" title="Arabic"
									class="link notranslate">Arabic</a>
							</li>
							|
							<li class="menu-item menu-item-gtranslate">
								<a href="#" onclick="doGTranslate('es'); return false;" title="Spanish"
									class="link notranslate">Español</a>
							</li>
							|
							<li class="menu-item menu-item-gtranslate">
								<a href="#" onclick="doGTranslate('pt'); return false;" title="Portuguese"
									class="link nturl notranslate">Portuguese</a>
							</li>
							|
							<li class="menu-item menu-item-gtranslate">
								<a href="#" onclick="doGTranslate('sw'); return false;" title="Kiswahili"
									class="link nturl notranslate">Swahili</a>
							</li>
						</ul>
					</div>


				</div>
			</div>
		</div>
	</div>
</div>
</div>
<div class="header">
	<div class="container">
		<nav id="navigation" class="navigation navigation-landscape">
			<div class="nav-header">

				<div class="nav-toggle col-md-4"></div>

				<div class="mobile_nav col-md-4" style="float:right; margin-top:6px; margin-left:350px !important;">
					<ul>
						<li>
							<a href="#" data-toggle="modal" data-target="#login" class="theme-cl fs-lg">
								<i class="lni lni-user"></i>
							</a>
						</li>

					</ul>


				</div>
			</div>
			<div class="nav-menus-wrapper" style="transition-property: none;">

				<!-- Use CSS to replace link text with flag icons -->


				<ul class="nav-menu mt-1">



					<li class="nav-item" role="presentation">
						<a class="nav-link" id="" href="<?= base_url() ?>records" ><i
								class="fa fa-tachometer"></i>Dashboard
						</a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" id="" href="<?= base_url() ?>records/profile" ><i
								class="fa fa-virus"></i>Disease - Condition Country Profile
						</a>
					</li>

					<li class="mobile-language-menu-container" style="margin:3px; display:none ;">
						<select id="mobile-language-menu-container" class="form-control mobile-language-menu-container"
							onchange="handleLanguageChange(this)" style="border-radius:4px; display:none ;">
							<option value="" disabled selected>Select Language</option>
							<option value="en">English</option>
							<option value="fr">French</option>
							<option value="ar">Arabic</option>
							<option value="es">Spanish</option>
							<option value="pt">Portuguese</option>
							<option value="sw">Swahili</option>
						</select>
					</li>

					<?php if (!empty($this->session->userdata('id'))): ?>

						<li class="nav-item dropdown"
							style="float:right; margin-right:2px; border: 1px #f5f2f242 solid !important;">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
								data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								<i class="fa fa-user"></i> <?php echo $this->session->userdata('name'); ?>
							</a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="<?php echo base_url('auth/profile'); ?>">
									<i class="fa fa-user-circle"></i> Profile
								</a>
								<div class="dropdown-divider"></div>
								
							<?php 	if($this->session->userdata('role')=="10") {?>
								<a class="dropdown-item" href="<?php echo base_url('dashboard/home'); ?>">
									<i class="fa fa-th"></i> Manage Data
								</a>
							<?php } ?>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="<?php echo base_url('auth/logout'); ?>">
									<i class="fa fa-sign-out-alt"></i> Logout
								</a>
							</div>
						</li>

					<?php endif; ?>








				</ul>
			</div>
	</div>
	</nav>
</div>
</div>
<!-- End Navigation -->
<div class="clearfix"></div>
<!-- ============================================================== -->
<!-- Top header  -->
<!-- ============================================================== -->