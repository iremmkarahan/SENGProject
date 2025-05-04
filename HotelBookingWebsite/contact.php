<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Voyago-CONTACT</title>
  <?php require('inc/links.php') ?>
  <style>
    .pop:hover{
        border-top-color: var(--teal) !important;
        transform:scale(1.03);
        transition: all 0.3s;
    }
  </style>
</head>

<body class="bg-light">
    <?php require('inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center">Contact Us</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.
            <br> Nihil maxime laborum dicta voluptatum harum nemo vero corporis dolore saepe ex, ipsam placeat perferendis aperiam, expedita non animi id, repudiandae sapiente?</p>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded shadow p-4 ">
                <h5>Call us</h5>
          <a href="tel:+1234567890" class="d-inline-block mb-2 text-decoration-none text-dark">
            <i class="bi bi-telephone-inbound-fill"></i> +1234567890
          </a><br>
          <a href="tel:+1234567891" class="d-inline-block text-decoration-none text-dark">
            <i class="bi bi-telephone-inbound-fill"></i> +1234567891
          </a>
          <h5 class="mt-4">Email </h5>
          <a href = "mailto:ask.voyago@gmail.com" class="d-inline-block text-decoration-none text-dark"><i class="bi bi-mailbox-flag"></i>ask.voyago@gmail.com
        </a>
        <h5 class = "mt-4">Follow us</h5>
          <a href="#" class="d-inline-block text-dark fs-5 me-2">
              <i class="bi bi-twitter me-1"></i> Twitter
          </a>
          <a href="#" class="d-inline-block text-dark fs-5 me-2">
              <i class="bi bi-facebook me-1"></i> Facebook
          </a>
          <a href="#" class="d-inline-block text-dark fs-5 ">
              <i class="bi bi-instagram me-1"></i> Instagram
          
          </a>
          </div>
            </div>
            <div class="col-lg-6 col-md-6  px-4">
                <div class="bg-white rounded shadow p-4">
                    <form>
                        <h5>
                            Send us a message
                        </h5>
                        <div class="mt-3">
              <label class="form-label" style ="font-weight:500px">Name</label>
              <input type="text" class="form-control shadow-none">

            </div>
            <div class="mt-3">
              <label class="form-label" style ="font-weight:500px">Email</label>
              <input type="email" class="form-control shadow-none">

            </div>
            <div class="mt-3">
              <label class="form-label" style ="font-weight:500px">Subject</label>
              <input type="email" class="form-control shadow-none">

            </div>
            <div class="mt-3">
              <label class="form-label" style ="font-weight:500px">Message</label>
              <textarea class="form-control shadow-none" rows="5" style="resize:none;"></textarea>

            </div>
            <button type=" submit" class="btn text-white custom-bg mt-3">SEND</button>
        </form>

                </div>
            </div>
 
        </div>
    </div>

  

 

    <?php require('inc/footer.php') ?>
  
</body>

</html>