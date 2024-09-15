
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Login | CBT Online</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500&display=swap');

      body{
          font-family: 'Poppins', sans-serif;
          background: #ececec;
      }

      /*------------ Login container ------------*/

      .box-area{
          width: 930px;
      }

      /*------------ Right box ------------*/

      .right-box{
          padding: 40px 30px 40px 40px;
      }

      /*------------ Custom Placeholder ------------*/

      ::placeholder{
          font-size: 16px;
      }

      .rounded-4{
          border-radius: 20px;
      }
      .rounded-5{
          border-radius: 30px;
      }


      /*------------ For small screens------------*/

      @media only screen and (max-width: 768px){

          .box-area{
              margin: 0 10px;

          }
          .left-box{
              height: 100px;
              overflow: hidden;
          }
          .right-box{
              padding: 20px;
          }

      }
    </style>
</head>
<body>

    <!----------------------- Main Container -------------------------->

     <div class="container d-flex justify-content-center align-items-center min-vh-100">

    <!----------------------- Login Container -------------------------->

       <div class="row border rounded-5 p-3 bg-white shadow box-area">

    <!--------------------------- Left Box ----------------------------->

       <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #3662e3;">
           <div class="featured-image mb-3">
            <div id="animationContainer" class="img-fluid" style="width: 250px;"></div>
           </div>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 700;">CBT Online</p>
           <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 800;">SMK NEGERI PONCOL</p>
       </div>

    <!-------------------- ------ Right Box ---------------------------->

       <div class="col-md-6 right-box">
          <div class="row align-items-center">

                &nbsp;<br>

                <div class="header-text mb-4">
                     <h2>Login</h2>
                </div>

                <form method="POST" action="{{ route('login') }}">
                  @csrf

                <div class="input-group mb-3">
                    <input required type="text" name="username" class="form-control form-control-lg bg-light fs-6" placeholder="Username">
                </div>
                @error('username')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror

                <div class="input-group mb-1">
                    <input required type="password" name="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password">
                </div>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <br>

                <div class="input-group mb-3">
                    <button class="btn btn-lg btn-primary w-100 fs-6" type="submit">Login</button>
                </div>
                </form>

                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>
                &nbsp;<br>

          </div>
       </div>

      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.9/lottie.min.js"></script>
    <script>
        const animationPath = "{{url('login_animation.json')}}"; // Replace with the path to your Lottie JSON file
        const container = document.getElementById("animationContainer");
        const animation = bodymovin.loadAnimation({
            container: container,
            renderer: "svg",
            loop: true,
            autoplay: true,
            path: animationPath
        });

        animation.setSpeed(0.8);
    </script>
</body>
</html>
