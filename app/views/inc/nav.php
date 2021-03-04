<?php
$categoriesHelpers = new NavHelper();
$categories = $categoriesHelpers->helperFindAllCategories();
$authors = $categoriesHelpers->helperFindUsersByRole("author");
?>
<header>
	<div class="container">
		<div class="row">
			
			<div class="col-xs-12 col-md-4">
				<div class="date-container">
					<div>
						<h6>SUNDAY . 09 AUGUST . 2022</h6>
					</div>
					<div class="bordure"></div>
					<div class="social-media">
						<ul>
							<li><i class="fab fa-facebook-f"></i></li>
							<li><i class="fab fa-twitter"></i></li>
							<li><i class="fab fa-instagram"></i></li>
							<li><i class="fab fa-tumblr"></i></li>
							<li><i class="fas fa-rss"></i></li>
						</ul>
					</div>
				</div>
				<!-- /.date-container -->
			</div>
			<!-- block de gauche -->
	
			
			<div class="col-xs-12 col-md-4 nav-image-center">
				<a href="<?= URL_ROOT ?>"><img src="<?= URL_ROOT ?>/public/img/img_site/logo-omega_200x200.png" alt="Tech NewsLogo" class="img-fluid"></aha>
			</div>
			<!-- Block du millieu -->
	
			
			<div class="col-xs-12 col-md-4 ">
				<div class="login-container pull-right">
	
					<div class="login flex flex-right flex-wrap">
						<?php if(isset($_SESSION['user_id']) || isset($_SESSION['firstname'])) : ?>
							<a href="<?php echo URL_ROOT; ?>/users/profile"><?= ucfirst($_SESSION['firstname']) ?></a>
							<a href="<?php echo URL_ROOT; ?>/users/logout">Log out</a>
						<?php else : ?>
							<a href="<?php echo URL_ROOT; ?>/users/login">
								<b>LOGIN &ThickSpace; / &ThickSpace; REGISTER</b>
							</a>
						<?php endif; ?>
	
							<!-- Language select -->
							<select>
								<option value="EN">EN</option>
								<option value="FR">FR</option>
							</select>
					</div>
					
					<div class="bordure bordure-droite"></div>
					
	
					<div class="search flex flex-right">
						<input type="search" name="search" id="search" class="">
						<label for="search"><i class="fas fa-search fa-lg"></i></label>
					</div>

					<!-- SI JE SUIS UN AUTHHOR OU UN ADMIN -->
					<!-- JE PEUX CREER UN ARTICLE -->
					<?php if(isAuthor() || isAdmin()): ?>

					<div class="flex flex-right">
						<a href="<?= URL_ROOT ?>/articles/create">Créer Article</a>
					</div>

					<?php endif; ?>
	
				</div>
			</div>
			<!-- Block de droite -->


		</div>

		<div class="row">
			<div class="col-xs-12 col-md-12">
				<nav class="top-nav">
					<ul class="flex flex-wrap flex-center">

						<li class="">
							<a href="<?= URL_ROOT; ?>" gray="true">NEWS</a>
						</li>

						<li class="more">
							<a>CATÉGORIES&ThickSpace;<i class="fas fa-chevron-down"></i></a>
						</li>

						<li class="more">
							<a>AUTHEURS&ThickSpace;<i class="fas fa-chevron-down"></i></a>
						</li>

						<li class="">
							<a href="<?= URL_ROOT; ?>/articles/gallery">GALERIE</a>
						</li>

						<li class="">
							<a href="<?= URL_ROOT; ?>/pages/contact">CONTACT</a>
						</li>

	
						<div class="more-link hide">
							<!-- <div class="container"> -->
								<div class="row">
									<?php foreach ($categories as $category): ?>
									<div class="col-xs-12 col-sm-6 col-md-3">

									<!-- <li class="nav-links-cat">
										
									</li> -->
										<ul>
											<li> 
												<h5>
												<a href="<?= URL_ROOT; ?>/articles/category/<?= $category->cat_id ?>"><?= strtoupper($category->cat_name) ?></a>
												</h5> 
											</li>
											<li> <h6><a href="<?= URL_ROOT; ?>/articles/categories">Clean Interface</a></h6> </li>
											<li> <h6><a href="<?= URL_ROOT; ?>/articles/categories">Available Possiblities</a></h6> </li>
											<li> <h6><a href="<?= URL_ROOT; ?>/articles/categories">Responsive Design</a></h6> </li>
											<li> <h6><a href="<?= URL_ROOT; ?>/articles/categories">Pixel Perfect Graphics</a></h6> </li>
											
										</ul>

									</div>
									<?php endforeach; ?>
									
								</div>
							<!-- </div> -->
						</div>

					<!-- /.more-link -->
						<div class="more-link hide">
							<!-- <div class="container"> -->
							<div class="row">
								<?php foreach ($authors as $author): ?>
								
								<h5>
									<a href="<?= URL_ROOT; ?>/articles/users/profile/<?= $author->user_id ?>"><?= strtoupper($author->firstname) ?></a>
								</h5> 

								<?php endforeach; ?>
									
									
							</div>
						</div>
					<!-- /.more-link -->
	
					</ul>
				</nav>
			</div>
		</div>
	</div>
</header>