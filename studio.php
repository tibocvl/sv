
<!-- $title Studio -->

<!-- @include _header -->

<div class="container container--studio">

<section class="intro_section intro_section--2" style="background:url('assets/img/studio/office_3.jpg') center;background-size: cover;">
	
	<div class="intro_section--title"->
		<h1 class="title_size1">We are what we do</h1>
	</div>

	<ul class="intro_section--social">
		
		<li>
			<a href="">
				Instagram
			</a>
		</li>
		<li>
			<a href="">
				Twitter
			</a>
		</li>
		<li>
			<a href="">
				Facebook
			</a>
		</li>
			
	</ul>

</section>
 
<section class="about_studio grid">
	

	<article class="about_studio--article col-1-2-pad">
		
		<div class="imgslide imgslide--1">
			<img class="imgslide--img current_img" src="assets/img/studio/office_1.jpg" alt="six vallées agence communication bureau">
			<img class="imgslide--img" src="assets/img/studio/office_2.jpg" alt="six vallées agence communication bureau">
		</div>

		<span></span>
		<div class="content--list col-3-4 grid--center">
		<div class="list--1">
		<h2 class="title_size3 left font_dark sans_serif uppercase">Our services</h2>

			<ul>
				<li><h3 class="uppercase title_size4 sans_serif font_dark">consultancy</h3></li>
				<li>
					
					<ul class="font_mdark">
						<li>Concept</li>
						<li>Strategy</li>
						<li>Copyrighting</li>
						<li>Photography</li>
						<li>Video production</li>
					</ul>

				</li>
			</ul>
			<ul>
				<li><h3 class="uppercase title_size4 sans_serif font_dark">design</h3></li>
				<li>
					
					<ul class="font_mdark">
						<li>Concept</li>
						<li>Strategy</li>
						<li>Copyrighting</li>
						<li>Photography</li>
						<li>Video production</li>
					</ul>

				</li>
			</ul>
			<ul>
				<li><h3 class="uppercase title_size4 sans_serif font_dark">development</h3></li>
				<li>
					
					<ul class="font_mdark">
						<li>Concept</li>
						<li>Strategy</li>
						<li>Copyrighting</li>
						<li>Photography</li>
						<li>Video production</li>
					</ul>

				</li>
			</ul>
		</div>

		</div>

	</article>


	<article class="about_studio--article col-1-2-pad">

		<div class="content--1 col-3-4 grid--center">
			<h2 class="title_size3 right font_dark sans_serif">US & OUR VISION</h2>
			<p class="right font_mdark">Heydays is a Norwegian design agency based in Oslo. The focus of our work is developing visual identities, digital solutions and other associated material for small and big clients. Together with our clients we identify and clarify core values to make relevant and tailored solutions.</p>
		</div>
		
		<div class="imgslide imgslide--2">
			<img class="imgslide--img current_img" src="assets/img/studio/office_3.jpg" alt="six vallées agence communication bureau">
			<img class="imgslide--img" src="assets/img/studio/office_4.jpg" alt="six vallées agence communication bureau">
		</div>
		<div class="content--1 col-3-4 grid--center">
			<span class="separator"></span>
			<h2 class="title_size3 right font_dark sans_serif clearfix">US & OUR VISION</h2>
			<p class="right font_mdark">We use insight, instinct and commitment in our design work and dare to challenge the established truth. Our conviction is that the most precise solutions are found together with our clients and we embrace an open and passionate dialogue. Each of our designers work directly with their respective client contacts for easy and tight communication throughout the project.</p>
		</div>

	</article>

	<article class="business center font_light">
		
		<h2 class="title_size2">Want to work with us?</h2>
		<a class="font_light" href="#">+32 (0)471 65 82 54<br></a>	
		<a class="font_light" href="#">thibaud[at]sixvallees.com</a>	

	</article>

	<article class="instagram">
		
            	
                <?php
                //The demonstration starts here

                //1 - Settings (please update to math your own)
                $username='tibocvl'; //Provide your instagram username
                $access_token='184138065.3b747df.db04f1e03b0d47d68ecdaaa855ef78f7'; //Provide your instagram access token
                $count='8'; //How many shots do you want?

                //2 - Include the php class
                include('includes/instagram.php');
                //3 - Instanciate
                if(!empty($username) && $username!='username' && !empty($access_token) && $access_token!='access_token'){
                $isg = new instagramPhp($username,$access_token); //instanciates the class with the parameters
                $shots = $isg->getUserMedia(array('count'=>$count)); //Get the shots from instagram
                } else {
                echo'Please update your settings to provide a valid username and access token';
                }
                //4 - Display
                if(!empty($shots)){ echo $isg->simpleDisplay($shots); }

                ?>



    </article>


</section>




  
<!-- @include _footer -->