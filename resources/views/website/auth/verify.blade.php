<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Beep To Pay</title>

        <link rel="stylesheet" href="style.css" />
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" />

        <!-- jQuery library -->
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>

        <!-- Popper JS -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

        <!-- Latest compiled JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="bg-grey-made">
        <nav class="navbar navbar-expand-lg navbar-light nav-bg px-3 py-3">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="{{asset('website/images/beeptopay-logo.png')}}" class="img-fluid" alt="" />
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarScroll">
                    <div class="mx-auto order-0">
                        <a href="#" class="font_14 font-weight-bold text-a-black mr-5">HOW TO USE</a>
                        <a href="#" class="font_14 font-weight-bold text-a-black">WHERE TO USE</a>
                    </div>
                    <div class="d-flex">
                        <a href="#" class="login-btn mr-3">LOG IN</a>
                        <a href="#" class="btn-signup">SIGN UP</a>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row">
                <div class="col-12 p-0">
                   <div class="container form-container h_100">
                    <img src="{{asset('website/images/company-logo.png')}}" class="img-fluid" alt="BeepToPay">
                    <h3 class="font_18 font-weight-bold mt-4">Verify your phone number</h3>
                    <p class="font_15">We sent you an OTP to your phone number. Enter the code below to continue.</p>
                    <form action="#" class="mt-4 w-60 p-4">



                        <div class="d-flex bd-highlight">
                            <div class="p-2 flex-fill bd-highlight"><input type="text" class="form-control input-field text-center" placeholder="0" /></div>
                            <div class="p-2 flex-fill bd-highlight"><input type="text" class="form-control input-field text-center" placeholder="0" /></div>
                            <div class="p-2 flex-fill bd-highlight"><input type="text" class="form-control input-field text-center" placeholder="0" /></div>
                            <div class="p-2 flex-fill bd-highlight"><input type="text" class="form-control input-field text-center" placeholder="0" /></div>
                          </div>
                        <div class="form-group text-center mt-4">

                            <a href="{{ route('website.success') }}" class="royal-blue font_16">Resend OTP</a>
                        </div>

                    </form>
                   </div>
                </div>
            </div>
        </div>
        <footer class="footer-bg p-3 footer-fixed">
            <div class="container">
              <div class="d-flex bd-highlight">
                <div class="flex-fill bd-highlight text-center">
                  <a href="#" class="font_14 col-grey mr-5">Terms and Conditions</a>
                  <a href="#" class="font_14 col-grey">Privacy Policy</a>
                </div>

              </div>
            </div>
          </footer>
    </body>
</html>
