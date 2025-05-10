<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'vendor/autoload.php';
        
    $mail = new PHPMailer(true);

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['send-email-verification']))
    {
        if(empty($_POST['email']))
        {
            echo "
                <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Dear user,\", {
                                body: \"Pls add your email.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"forgot_password_step_1.php\";
                        } else if (Notification.permission !== \"denied\") {
                            Notification.requestPermission().then(permission => {
                                if (permission === \"granted\") {
                                    new Notification(\"Dear user,\", {
                                        body: \"Pls add your email.\",
                                        icon: \"icon.png\"
                                    });
                                }
                            });
                        }
                </script>";
        }
        else
        {
            include_once("conn_db.php");

            $sql = "SELECT * FROM users WHERE email='".$_POST['email']."'";
            $result = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($result);

            if($count === 0)
            {
                echo "
                <script>
                    if (Notification.permission === \"granted\") {
                        new Notification(\"Dear user,\", {
                            body: \"User not found.\",
                            icon: \"icon.png\"
                        });
                        window.location.href=\"forgot_password_step_1.php\";
                        } else if (Notification.permission !== \"denied\") {
                            Notification.requestPermission().then(permission => {
                                if (permission === \"granted\") {
                                    new Notification(\"Dear user\", {
                                    body: \"User not found.\",
                                    icon: \"icon.png\"
                                });
                            }
                        });
                    }
                </script>";
            }
            else
            {
                $sender = $_POST['email'];
                $receiver = $_POST['email'];

                try {
                    // SMTP configuration
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com'; // Use your SMTP provider
                    $mail->SMTPAuth = true;
                    $mail->Username = 'bsmir.vendor@gmail.com';       // Your Gmail address
                    $mail->Password = 'xtbe rzxz nuch jfjz';          // App password, NOT Gmail password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;

                    // Email settings
                    $mail->setFrom('bsmir.vendor@gmail.com', 'BSMIR Task Management System');
                    $mail->addAddress($receiver); // Receiver's email

                    $verificationCode = rand(100000, 999999); // Generate a code
                    $mail->Subject = 'Your Verification Code';
                    $mail->Body    = "Your verification code is: $verificationCode";

                    $mail->send();
                    // echo 'Verification code sent successfully.'.$verificationCode;
                    
                    // $code[] = $verificationCode;

                    $_SESSION["code"] = $verificationCode;
                    $_SESSION["email"] = $receiver;

                    //echo "<script> alert('Verification code sent successfully. Please check your spam folder or primary messages.') </script>";

                    
                    echo "
                    <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Verification Code Sent!\", {
                                    body: \"Check your inbox or spam folder.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"forgot_password_step_2.php\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Verification Code Sent!\", {
                                            body: \"Check your inbox or spam folder.\",
                                            icon: \"icon.png\"
                                        });
                                    }
                                });
                            }
                    </script>";
                    // header("Location: forgot_password_step_2.php");
                } catch (Exception $e) {
                    //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    //echo "<script> alert('Message could not be sent.') </script>";
                    echo "
                    <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Dear user,\", {
                                    body: \"Message could not be sent.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"forgot_password_step_1.php\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Dear user,\", {
                                            body: \"Message could not be sent.\",
                                            icon: \"icon.png\"
                                        });
                                    }
                                });
                            }
                    </script>";
                }
            }


            
        }
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

        .progress-bar {
            /* transition: 0.3s ease-in-out; */
            background: linear-gradient(to right, #3DE5B1, #42B1F6);

            animation: growBar 0.6s ease-in-out forwards;
        }

        @keyframes growBar {
            0% {
                width: 0%;
            }
            100% {
                width: 50%;
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
                
                <form id="form" method="POST">
                    <div class="col h-100">

                        <div class="col d-flex justify-content-start align-items-center" style="gap: 1rem;">
                            <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;"> <img src="assets/Logo.png" alt="..." width="60rem" height="60rem"> </div>
                            <span class="Logo-txt"> FlutterTask </span>
                        </div>
    
                        <div class="col pt-2 d-flex justify-content-start align-items-center">
                            <span style="font-size: 1rem; opacity: 40%;"> Forgot your password? Change it with Flow. </span>
                        </div>

                        <div class="card-header pt-3 pb-2">
                            
                            <div class="border rounded-4" style="height: 0.6rem;">
                                <div class="progress-bar d-flex h-100"></div>
                            </div>
                            <div class="d-flex flex-row">
                                <div class="w-100 d-flex justify-content-start"> 
                                    <span style="font-size: 0.8rem;"> Step 1 </span> 
                                </div>
                                <div class="w-100 d-flex justify-content-end"> 
                                    <span style="font-size: 0.8rem;"> Step 2 </span> 
                                </div>
                            </div>

                        </div>
    
                        <div class="col pt-4 d-flex flex-column" style="gap: 1rem;">
    
                            <div class="INPUT col pt-2 pb-2 d-flex justify-content-start align-items-center">
                                <div class="col-auto d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem;">
                                    <i class="bi bi-envelope-at"></i>
                                </div>
    
                                <!-- email -->
                                <input type="email" name="email" placeholder="Email" style="width: 100%;">
                            </div>

                        </div>

                        <br>
    
                        <div class="BUTTON col pb-2 d-flex justify-content-center align-items-center">
                            <button type="submit" name="send-email-verification" style="width: 100%; height: 3rem; border-radius: 8px; background: linear-gradient(to right, #3DE5B1, #42B1F6); color: white; border: none;"> <b> SEND VERIFICATION </b> </button>
                        </div>
    
                        <div class="col pt-3 pb-5 d-flex justify-content-center align-items-center">
                            <span style="font-size: 0.8rem;"> Change your mind? <a href="index.php"> Click here. </a> </span>
                        </div>
    
                    </div>
                </form>

            </div>

        </div>
    </div>
</body>
</html>