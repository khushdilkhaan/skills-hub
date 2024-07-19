 <?php include "header.php"; ?>
  <!-- Start slider -->
  <section id="slider">
    <div class="main-slider">
      <div class="single-slide">
        <img src="assets/images/slider-1.jpg" alt="img">
        <div class="slide-content">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="slide-article">
                  <h1 class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">Creative Design & Best Feature</h1>
                  <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.75s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since</p>
                  <a class="read-more-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" href="#">Read More</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="slider-img wow fadeInUp">
                  <img src="assets/images/person1.png" alt="business man">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="single-slide">
        <img src="assets/images/slider-3.jpg" alt="img">
        <div class="slide-content">
          <div class="container">
            <div class="row">
              <div class="col-md-6 col-sm-6">
                <div class="slide-article">
                  <h1 class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">We are Best Team & Support you always</h1>
                  <p class="wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.75s">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since</p>
                  <a class="read-more-btn wow fadeInUp" data-wow-duration="1s" data-wow-delay="1s" href="#">Read More</a>
                </div>
              </div>
              <div class="col-md-6 col-sm-6">
                <div class="slider-img wow fadeInUp">
                  <img src="assets/images/person2.png" alt="business man">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>          
    </div>
  </section>
  <!-- End slider -->


  <!-- Start counter -->
  <section id="counter">
    <div class="counter-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="counter-area">
              <div class="row">
                <!-- Start single counter -->
                <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-suitcase"></i>
                    </div>
                    <div class="counter-no counter">
                      1275
                    </div>
                    <div class="counter-label">
                      Projects
                    </div>
                  </div>
                </div>
                <!-- End single counter -->
                <!-- Start single counter -->
                <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <div class="counter-no counter">
                      5275
                    </div>
                    <div class="counter-label">
                      Hours Work
                    </div>
                  </div>
                </div>
                <!-- End single counter -->
                <!-- Start single counter -->
                <div class="col-md-3 col-sm-6">
                 <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-trophy"></i>
                    </div>
                    <div class="counter-no counter">
                      350
                    </div>
                    <div class="counter-label">
                      Awards
                    </div>
                  </div>
                </div>
                <!-- End single counter -->
                <!-- Start single counter -->
                <div class="col-md-3 col-sm-6">
                  <div class="single-counter">
                    <div class="counter-icon">
                      <i class="fa fa-users"></i>
                    </div>
                    <div class="counter-no counter">
                      875
                    </div>
                    <div class="counter-label">
                      Clients
                    </div>
                  </div>
                </div>
                <!-- End single counter -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End counter -->
  

<!-- Start Our Team section -->
<section id="our-team">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-area">
                    <h2 class="title">Our Team</h2>
                    <span class="line"></span>
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
                </div>
            </div>
            <div class="col-md-12">
                <div class="our-team-content">
                    <div class="row">
                        <?php
                        // Assuming you have a connection to the database named $link

                        // Fetch data from the "skilled workers" table along with their average ratings
                        $query = "SELECT skilledworkers.*, AVG(review.rating) AS avg_rating FROM skilledworkers LEFT JOIN review ON skilledworkers.worker_id = review.worker_id GROUP BY skilledworkers.worker_id";
                        $result = mysqli_query($link, $query);

                        // Loop through the fetched data
                        while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                            <!-- Start single team member -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="single-team-member">
                                    <div class="team-member-img">
                                        <!-- Assuming you have a field named 'profile_image' in the table -->
                                        <img src="workers_profile/<?php echo $row['pro_image']; ?>" alt="team member img">

                                    </div>
                                    <div class="team-member-name">
                                        <p><?php echo $row['username']; ?></p>
                                        <span><?php echo $row['skills']; ?></span>
                                    </div>
                                    <p><?php echo $row['work_history']; ?></p>
                                    <!-- Display average rating -->
                                    <div class="team-member-rating">
                                        <span>Average Rating: <?php echo round($row['avg_rating'], 1); ?></span>
                                    </div>
                                    <div class="team-member-link">
                                        <!-- You can add social media links here -->
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                            <!-- End single team member -->
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Our Team section -->


  
  <!-- Start Testimonial section -->
  <section id="testimonial">
    <div class="container">
      <div class="row">
        <div class="col-md-6">
          <div class="row">
            <div class="col-md-12">
              <div class="title-area">
                <h2 class="title">Whats Client Say</h2>
                <span class="line"></span>           
              </div>
            </div>
            <div class="col-md-12">
              <!-- Start testimonial slider -->
              <div class="testimonial-slider">
                <!-- Start single slider -->
                <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="assets/images/testi1.jpg" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                    <h6>Bernice Neumann, <span>Designer</span></h6>
                  </div>
                </div>
                <!-- Start single slider -->
                <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="assets/images/testi3.jpg" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                    <h6>John Dow, <span>CEO</span></h6>
                  </div>
                </div>
                <!-- Start single slider -->
                <div class="single-slider">
                  <div class="testimonial-img">
                    <img src="assets/images/testi2.jpg" alt="testimonial image">
                  </div>
                  <div class="testimonial-content">
                    <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable.</p>
                    <h6>Michel, <span>Developer</span></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6"></div>        
      </div>
    </div>
  </section>
  <!-- End Testimonial section -->

  <!-- Start latest news -->
  <section id="latest-news">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="title-area">
            <h2 class="title">Latest News</h2>
            <span class="line"></span>
            <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</p>
          </div>
        </div>
        <div class="col-md-12">
          <div class="latest-news-content">
            <div class="row">
              <!-- start single latest news -->
              <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="assets/images/blog-img-1.jpg" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">All about writing story</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div>
              <!-- start single latest news -->
              <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="assets/images/blog-img-2.jpg" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">Best Mobile Device</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div>
              <!-- start single latest news -->
              <div class="col-md-4">
                <article class="blog-news-single">
                  <div class="blog-news-img">
                    <a href="blog-single-with-right-sidebar.html"><img src="assets/images/blog-img-3.jpg" alt="image"></a>
                  </div>
                  <div class="blog-news-title">
                    <h2><a href="blog-single-with-right-sidebar.html">Personal Note Details</a></h2>
                    <p>By <a class="blog-author" href="#">John Powell</a> <span class="blog-date">|18 October 2015</span></p>
                  </div>
                  <div class="blog-news-details">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the</p>
                    <a class="blog-more-btn" href="blog-single-with-right-sidebar.html">Read More <i class="fa fa-long-arrow-right"></i></a>
                  </div>
                </article>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End latest news -->

  <!-- Start subscribe us -->
  <section id="subscribe">
    <div class="subscribe-overlay">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="subscribe-area">
              <h2 class="wow fadeInUp">Subscribe Newsletter</h2>
              <form action="" class="subscrib-form wow fadeInUp" data-wow-duration="0.5s" data-wow-delay="0.5s">
                <input type="text" placeholder="Enter Your E-mail..">
                <button class="subscribe-btn" type="submit">Submit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- End subscribe us -->
<?php include "footer.php"; ?>