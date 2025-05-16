<?php
    include_once("conn_db.php");

    $id = mysqli_real_escape_string($conn, $_GET['id']);
    if(isset($id))
    {
            $profile_img="";
            $username="";
            $email="";

            $sql = "SELECT id, username, email, profile_img FROM users WHERE id='$id'";
            $result = mysqli_query($conn, $sql);

            if(mysqli_num_rows($result) > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $profile_img=$row['profile_img'];
                    $username=$row['username'];
                    $email=$row['email'];
                }
            }
    }
    
    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['exit-welcome']))
    {
        $conn->close();
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FlutterTask - Register</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <style>
        @media (min-width: 100px){ .BACKGROUND{display: none;} }
        @media (min-width: 300px){ .BACKGROUND{display: none;} }
        @media (min-width: 750px){ .BACKGROUND{display: none;} }
        @media (min-width: 900px){ .BACKGROUND{display: flex; width: 30rem; } }

        .Logo-txt {
            font-size: 2rem; 
            font-weight: bold;
            background: linear-gradient(to right, #3DE5B1, #42B1F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; 
            background-clip: text;
            text-fill-color: transparent;
        }

        input{
            height: 2rem;
            border-style: none;
            outline-style: none;
        }

        .INPUT{
            border-bottom: 1px solid #202020;
        }
        .INPUT:focus-within {
            transition: 0.3s ease-in-out;
            border-bottom: 1px solid #42B1F6;
        }

        a{
            text-decoration: none;
        }


        .Welcome-form{
            animation: float 1s ease-in-out;
        }

        @keyframes float {
            0% {
                transform: translateY(0);
                opacity: 0;
            }
            100% {
                transform: translateY(-20px); /* Moves it up by 20px */
                opacity: 1;
            }
        }


    </style>

</head>
<body>

    <div class="container-fluid" style="height: 100vh;">
        <div class="row h-100">
            
            <div class="BACKGROUND col-auto" style="background-image: url('assets/cover.png'); background-repeat: no-repeat; background-size: cover;"> 

                <div class="col d-flex justify-content-center">
                  <div class="container d-flex justify-content-center align-items-center">
                    <img src="assets/hero-img.png" alt="..." width="450rem" height="450rem">
                  </div>
                </div>
      
              </div>

            <div class="FORM col p-3 bg-white" style="box-shadow: 8px 10px 10px 8px rgba(0, 0, 0, 0.205);">
                
                <form method="POST">
                    <div class="col h-100">

                        <div class="col d-flex justify-content-start align-items-center" style="gap: 1rem;">
                            <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;"> <img src="assets/Logo.png" alt="..." width="60rem" height="60rem"> </div>
                            <span class="Logo-txt"> FlutterTask </span>
                        </div>
    
                        <br>

                        <div class="card border-0">

                            <div class="Welcome-form border-0 card-body pb-4 pt-4 d-flex flex-column justify-content-center align-items-center" style="gap: 1rem;">

                                <div class="border d-flex justify-content-center align-items-cetner" style="overflow: hidden; width: 10rem; height: 10rem; border-radius: 50%;">
                                    <img src="<?php echo $profile_img; ?>" alt="..." style="width: 10rem; height: 10rem;">
                                </div>

                                <div class="border-0 pb-2 pt-2 w-100 d-flex flex-column justify-content-center align-items-center" style="gap: 1rem;">
                                     <h1 class="Logo-txt"> Welcome to FlutterTask </h1>
                                     <h5><?php echo $username; ?></h5>
                                </div>

                                <div class="BUTTON w-100 col pb-2 d-flex justify-content-center align-items-center">
                                    <button type="submit" name="exit-welcome" style="width: 100%; height: 3rem; border-radius: 8px; background: linear-gradient(to right, #3DE5B1, #42B1F6); color: white; border: none;"> <b> RETURN TO LOG IN </b> </button>
                                </div>

                            </div>

                        </div>                        
    
                    </div>
                </form>

            </div>

        </div>
    </div>

    <script type="text/javascript">

        let default_lock = "assets/lock.png";
        let open_lock = "assets/unlock.png";
        
        let pass = document.querySelector("input[name='password']");
        let pslock = document.getElementById("pslock-state");

        let cpass = document.querySelector("input[name='cpassword']");
        let cslock = document.getElementById("cslock-state");

        function togglePassword() 
        {
            if(pass.type === "password") 
            {
                pass.type = "text";
                pslock.src = open_lock;
            } 
            else 
            {
                pass.type = "password";
                pslock.src = default_lock;
            }
        }

        function toggleCPassword() 
        {
            if(cpass.type === "password") 
            {
                cpass.type = "text";
                cslock.src = open_lock;
            } 
            else 
            {
                cpass.type = "password";
                cslock.src = default_lock;
            }
        }

    </script>
</body>
</html>