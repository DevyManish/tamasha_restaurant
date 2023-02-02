<?php include('partials-front/menu.php') ?>

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Book A Table
        </h2>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="form_container">
            <form action="">
              <div>
                <input type="text" class="form-control" placeholder="Your Name" id="name"/>
              </div>
              <div>
                <input type="text" class="form-control" placeholder="Phone Number" id="phone" />
              </div>
              <div>
                <input type="email" class="form-control" placeholder="Your Email" id="email" />
              </div>
              <div>
                <select class="form-control nice-select wide" id="select">
                  <option value="" disabled selected>
                    How many persons?
                  </option>
                  <option value="">
                    2
                  </option>
                  <option value="">
                    3
                  </option>
                  <option value="">
                    4
                  </option>
                  <option value="">
                    5
                  </option>
                </select>
              </div>
              <div>
                <input type="date" class="form-control">
              </div>
              <div class="btn_box">
                <button>
                  Book Now
                </button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-6">
          <div class="map_container ">
            <div id="googleMap"></div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- end book section -->

  <!-- virtual assistant -->
  <div class="floating-parent">
    <button onmousedown="sound.play()" class="talk"><i class="fas fa-microphone-alt"></i></button>
    <h1 class="content"> Click here to speak</h1>
  </div>

  <!-- voice typing script -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/annyang/2.6.0/annyang.min.js"></script>
<script>
if (annyang) {
  // Let's define our first command. First the text we expect, and then the function it should call
  var commands = {
    'name *tag': function(variable){
      let name=document.getElementById("name");
      name.value=variable;
    },

    'phone *tag': function(variable){
      let phone=document.getElementById("phone");
      phone.value=variable;
    },

    'email *tag': function(variable){
      let email=document.getElementById("email");
      email.value=variable.split(" ").join("");
    },

  };

  // Add our commands to annyang
  annyang.addCommands(commands);

  // Start listening. You can call this here, or attach this call to an event, button, etc.
  annyang.start();
}
</script>


  <?php include('partials-front/footer.php') ?>
