<!-----------HEADER------------->
<header>
	<nav class="navbar navbar-inverse mb-5">
		<div class="container-fluid">
			<div class="navbar-header"> 
				<a class="navbar-brand" href="<?php echo base_url(); ?>">Game Shop</a> 
			</div>
			<ul class="nav">
				<li class="active">
					<div class="btn btn-light mx-2">Shop</div>
				</li>
				<li>
					<div class="btn btn-light mx-2">About Us</div>
				</li>
				<li>
					<div class="btn btn-light mx-2">Contact Us</div>
				</li>
			</ul>
			<ul class="nav navbar-right">
				<li>
					<a href="#" class="px-2"><span class="icon"></span>Sign Up</a>
				</li>
				<li>
					<a href="#" class="px-2"><span class="icon"></span>Login</a>
				</li>
			</ul>
		</div>
	</nav>
</header>

<!-----------PC PLAYSTATION OR X-BOX------------->
<div class="container">
	<div class="row">
		<div class="col platform-container text-center <?php echo ($selected_platform_id === NULL)? 'active' : ''; ?>">
			<a href="<?php echo base_url() ?>">
				<h1>
					Any
				</h1>
			</a>
		</div>
		<?php foreach($platforms as $platform) : ?>
		<?php $active = $platform['id'] === $selected_platform_id ?>
			<div class="col platform-container text-center <?php echo ($active)? 'active' : ''; ?>">
				<a href="<?php echo base_url() . 'index.php/filter/' . $platform['id']?>">
					<h1>
						<?php echo strtoupper($platform['name']) ?>
					</h1>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
</div>



<!-----------SUB MENU FOR GAME GENRE------------->
<div class="container">
	<div class="row">
		<div class="col-md-2 genre-container p-0" data-aos="fade-left" data-aos-duration="2600" data-aos-once="true">
			<table class="table table-condensed">
				<tbody>
					<tr class="genre text-center">
						<td>
							<a href="<?php echo base_url() . 'index.php/filter/' . $selected_platform_id ?>">
								All
							</a>
						</td>
					</tr>
					<?php foreach($genres as $genre) :?>
					<tr class="genre text-center p-0">
						<td>
							<a href="<?php echo base_url() . 'index.php/filter/' . (($selected_platform_id)? $selected_platform_id : 'any') . '/' . $genre['id'] ?>">
								<?php echo $genre['name'] ?>
							</a>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<div class="col-md-10 rightContainer p-lg-5">
			<div class="row">
				<?php if(!empty($games)): ?>
				<?php foreach($games as $game) : ?>
				<div class="col-3">
					<div class="game text-center">
						<img class="fix-image" src="<?php echo $products[$game['product-id']]['image'] ?>"/>
						<h5>
							<?php echo $products[$game['product-id']]['name'] ?>
						</h5>
						<small>
							<?php foreach($game['genres'] as $genre) : ?>
								<span class="game-genre"><?php echo $genre ?></span>
							<?php endforeach; ?>
						</small>
						<br>
						<small>
							£<?php echo $products[$game['product-id']]['price'] ?>
						</small>
					</div>
				</div>
				<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>