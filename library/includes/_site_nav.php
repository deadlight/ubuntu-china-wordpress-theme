<nav role="navigation" class="nav-primary" >
	<div id="main-navigation" class="main-navigation">
		<div class="nav-content">
			<div id="main-nav">
				<ul class="main-nav no-bullets">
					<li><h2>By topic</h2>
						<ul class="no-bullets">
						<?php wp_nav_menu( array( 
							'theme_location' => 'primary-products', 
							'container' => '' ) ); ?>
						</ul>
					</li>
				</ul>
				<ul class="main-nav no-bullets">
					<li><h2>By content type</h2>
						<ul class="no-bullets">
							<?php wp_nav_menu( array( 
								'theme_location' => 'primary-categories', 
								'container' => '' ) ); ?>
						</ul>
					</li>
				</ul>
			</div><!-- /#main-nav -->
		</div><!-- /.nav-content -->
		<div class="nav-content">
			<div id="nav-global-wrapper" class="nav-global-wrapper">
				<h2>Ubuntu websites</h2>
				<ul class="clearfix no-bullets">
					<li class="block-click">
						<a href="http://www.ubuntu.com">
							Ubuntu 
						</a>
					</li>
					<li class="block-click">
						<a href="http://community.ubuntu.com/">
							Community 
						</a>
					</li>
					<li class="block-click">
						<a href="http://askubuntu.com">
							Ask! 
						</a>
					</li>
					<li class="block-click">
						<a href="http://developer.ubuntu.com">
							Developer 
						</a>
					</li>
					<li class="block-click">
					<a href="http://design.ubuntu.com">
						Design 
					</a>
					</li>
					<li class="block-click">
						<a href="http://www.ubuntu.com/certification">
							Hardware 
					</a>
					</li>
					<li class="block-click">
						<a href="http://shop.ubuntu.com">
							Shop 
						</a>
					</li>
					<li class="block-click">
						<a href="http://apps.ubuntu.com">
							Apps 
						</a>
					</li>
					<li class="block-click">
						<a href="https://help.ubuntu.com">
							Help 
						</a>
					</li>
					<li class="block-click">
						<a href="http://ubuntuforums.org">
							Forum 
						</a>
					</li>
					<li class="block-click">
						<a href="http://one.ubuntu.com">
							Ubuntu One 
						</a>
					</li>
					<li>
						<a href="http://www.launchpad.net">
							Launchpad 
						</a>
					</li>
					<li class="block-click">
						<a href="http://juju.ubuntu.com">
							Juju 
						</a>
					</li>
					<li class="block-click">
						<a href="http://maas.ubuntu.com">
							MAAS 
						</a>
					</li>
					<li class="block-click">
						<a href="http://blog.canonical.com">
							Canonical blog 
						</a>
					</li>
					<li class="block-click">
						<a href="http://www.canonical.com">
							Canonical 
						</a>
					</li>
				</ul>
			</div><!-- /.nav-global-wrapper -->
	</div>
	</div><!-- /#main-navigation -->
	
	<div class="nav-content">
		<div id="box-search">
			<div>
				<?php include (TEMPLATEPATH . '/searchform.php'); ?>	
			</div>
		</div><!-- /#search-box -->
	</div>
	
	<p class="top-link"><a href="#resources.ubuntu.com">Back to the top</a></p>
	
</nav>