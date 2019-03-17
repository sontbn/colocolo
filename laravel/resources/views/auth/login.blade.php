<!DOCTYPE html>
<!--
* CoreUI - Free Bootstrap Admin Template
* @version v2.1.10
* @link https://coreui.io
* Copyright (c) 2018 creativeLabs Łukasz Holeczek
* Licensed under MIT (https://coreui.io/license)
-->

<html lang="en">
  <head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>{{ $app_nama }} - Sign In</title>

    <!-- Icons-->
    <link href="{{ asset('template/coreui/vendors/@coreui/icons/css/coreui-icons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/coreui/vendors/flag-icon-css/css/flag-icon.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/coreui/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('template/coreui/vendors/simple-line-icons/css/simple-line-icons.css') }}" rel="stylesheet">

    <!-- Main styles for this application-->
    <link href="{{ asset('template/coreui/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('template/coreui/vendors/pace-progress/css/pace.min.css') }}" rel="stylesheet">

    <link href="{{ asset('plugins/alertify/themes/alertify.core.css') }}" rel="stylesheet">
    <link href="{{ asset('plugins/alertify/themes/alertify.default.css') }}" rel="stylesheet" >

    <!-- Global site tag (gtag.js) - Google Analytics-->
    <script async="" src="https://www.googletagmanager.com/gtag/js?id=UA-118965717-3"></script>
    <script>
      window.dataLayer = window.dataLayer || [];

      function gtag() {
        dataLayer.push(arguments);
      }
      gtag('js', new Date());
      // Shared ID
      gtag('config', 'UA-118965717-3');
      // Bootstrap ID
      gtag('config', 'UA-118965717-5');
    </script>
  </head>
  <body class="app flex-row align-items-center">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card-group">
            <div class="card p-4">
              
              <div class="card-body">
                <h1 style="text-align:center;">{{ $app_nama }}</h1>
                <p class="text-muted" style="text-align:center;">Sign In ke akun Anda</p>

                <form id="form-login" name="form-login" onsubmit="return false">
                  @csrf
                  
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input id="username" name="username" class="form-control" type="text" placeholder="Username">
                  </div>

                  <div class="input-group mb-4">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input id="password" name="password" class="form-control" type="password" placeholder="Password">
                  </div>

                  <div class="row">
                    <div class="col-6">
                      <!-- <button id="submit-login" class="btn btn-primary px-4" type="submit">Login</button> -->
                    </div>
                    <div class="col-6 text-right">
                      <!-- <button class="btn btn-link px-0" type="button">Forgot password?</button> -->
                      <button id="submit-login" class="btn btn-primary px-4" type="submit">Login</button>
                    </div>
                  </div>

                </form>
              </div>
            </div>

            <!-- <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%">
              <div class="card-body text-center">
                <div>
                  <h2>Sign up</h2>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                  <button class="btn btn-primary active mt-3" type="button">Register Now!</button>
                </div>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-- CoreUI and necessary plugins-->
    <script src="{{ asset('template/coreui/vendors/jquery/js/jquery.min.js') }}"></script>
    <script src="{{ asset('template/coreui/vendors/popper.js/js/popper.min.js') }}"></script>
    <script src="{{ asset('template/coreui/vendors/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('template/coreui/vendors/pace-progress/js/pace.min.js') }}"></script>
    <script src="{{ asset('template/coreui/vendors/perfect-scrollbar/js/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('template/coreui/vendors/@coreui/coreui/js/coreui.min.js') }}"></script>

    <script src="{{ asset('plugins/alertify/lib/alertify.min.js') }}"></script>

    <script>
            
      jQuery(document).ready(function(){
      
        function doBounce(element, times, distance, speed) {
          for(i = 0; i < times; i++) {
            element.animate({marginTop: '-='+distance},speed)
                   .animate({marginTop: '+='+distance},speed);
          }
        }
          
        setTimeout(function(){
            jQuery("#username").focus();
        },1000);
          
        //login         
        jQuery('#submit-login').click(function(){
        
          jQuery(this).prop('disabled',true);
          jQuery(this).html('Loading...');
          
          var lanjut=true;
          if(jQuery('#username').val()=='' || jQuery('#password').val()==''){
            lanjut=false;
          }

          if(lanjut==true){
            var data=jQuery('#form-login').serialize();
            jQuery.ajax({
              url:'login',
              data:data,
              method:'POST',
              success:function(result){
                if(result.error==false){
                  alertify.log('Login berhasil!');
                  jQuery('#submit-login').html('Login');
                  jQuery('#submit-login').prop('disabled', false);
                  window.location.href='./';
                }
                else{
                  alertify.log(result.message);
                  jQuery('#submit-login').html('Login');
                  jQuery('#submit-login').prop('disabled', false);
                }
              },
              error:function(result){
                alertify.log('Sesi telah habis / Koneksi terputus. Silahkan refresh browser Anda!');
                jQuery('#submit-login').html('Login');
                jQuery('#submit-login').prop('disabled', false);
              }
            });
          }
          else{
            alertify.log('Kolom tidak dapat dikosongkan!');
            jQuery('#submit-login').html('Login');
            jQuery('#submit-login').prop('disabled', false);
          }
        });
      });

    </script>
  </body>
</html>
