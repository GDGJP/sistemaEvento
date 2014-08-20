<style>
    .brand1 img { max-width:150px; margin: -10px 0 0 -90px; }
</style>
<div class="navbar navbar-inverse navbar-fixed-top">

	<div class="navbar-inner">

		<div class="container">

			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<i class="icon-cog"></i>
			</a>

			<a class="brand1" href="./index.html">
				<img src="<?php echo Configuracao::$baseUrl; ?>images/logo-anid.png" alt="logo-anid" style=""/>
			</a>
			<a class="brand" href="<?php echo Configuracao::$baseUrl.'index'.Configuracao::$extensaoPadrao; ?>">
				ANID :: Sistema <sup>0.1</sup>
			</a>

			<div class="nav-collapse" style="display: none;"  >
				<ul class="nav pull-right">
					<li class="dropdown">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-cog"></i>
							Settings
							<b class="caret"></b>
						</a>

						<ul class="dropdown-menu">
							<li><a href="javascript:;">Account Settings</a></li>
							<li><a href="javascript:;">Privacy Settings</a></li>
							<li class="divider"></li>
							<li><a href="javascript:;">Help</a></li>
						</ul>

					</li>

					<li class="dropdown">

						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<i class="icon-user"></i>
							Rod Howard
							<b class="caret"></b>
						</a>

						<ul class="dropdown-menu">
							<li><a href="javascript:;">My Profile</a></li>
							<li><a href="javascript:;">My Groups</a></li>
							<li class="divider"></li>
							<li><a href="javascript:;">Logout</a></li>
						</ul>

					</li>
				</ul>

				<form class="navbar-search pull-right">
					<input type="text" class="search-query" placeholder="Search">
				</form>

			</div><!--/.nav-collapse -->

		</div> <!-- /container -->

	</div> <!-- /navbar-inner -->

</div> <!-- /navbar -->
