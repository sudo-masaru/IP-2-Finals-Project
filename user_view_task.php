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

    if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['sign-out']))
    {
        // echo "hello world";

        if(isset($_COOKIE['alwaysLogged']))
        {
            // echo "false";
            if(isset($_COOKIE['TOKEN']))
            {
                $sql = "DELETE FROM auth_tokens WHERE token_id='".$_COOKIE['TOKEN']."'";
                if($conn->query($sql) === TRUE) 
                {
                    setcookie("TOKEN", "", time()+(86400 * 30), "/");
                    setcookie("alwaysLogged", "", time()+(86400 * 30), "/");

                    session_unset();
                    session_destroy();

                    $conn->close();
                    header("Location: index.php");
                } 
                else 
                {
                    // echo "Error deleting record: " . $conn->error;
                        echo "
                        <script>
                            if (Notification.permission === \"granted\") {
                                new Notification(\"Notice,\", {
                                    body: \"Failed to delete token.\",
                                    icon: \"icon.png\"
                                });
                                window.location.href=\"index.php\";
                                } else if (Notification.permission !== \"denied\") {
                                    Notification.requestPermission().then(permission => {
                                        if (permission === \"granted\") {
                                            new Notification(\"Notice,\", {
                                            body: \"Failed to delete token.\",
                                            icon: \"icon.png\"
                                        });
                                    }
                                });
                            }
                        </script>";
                }
            }
        }
        else
        {
            // echo "true";
            $conn->close();
            header("Location: index.php");
        }
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['profile']))
    {
        $conn->close();
        header("Location: user_account_profile.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['account-settings']))
    {
        $conn->close();
        header("Location: user_account_edit.php?&id=".$id);
    }

    
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['tasks']))
    {
        $conn->close();
        echo" <script> window.location.href=\"home.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['calendar']))
    {
        $month = date("n");
        $days = date("j");

        if($month > 10)
        {
            if($days > 10)
            {
                $date = date("Y-n-j");
                $conn->close();
                echo" <script> window.location.href=\"calendar.php?&id={$id}&date={$date}\"; </script> ";
            }
            else
            {
                $date = date("Y-n-0j");
                $conn->close();
                echo" <script> window.location.href=\"calendar.php?&id={$id}&date={$date}\"; </script> ";
            }
        }
        else
        {
            if($days > 10)
            {
                $date = date("Y-0n-j");
                $conn->close();
                echo" <script> window.location.href=\"calendar.php?&id={$id}&date={$date}\"; </script> ";
            }
            else
            {
                $date = date("Y-0n-0j");
                $conn->close();
                echo" <script> window.location.href=\"calendar.php?&id={$id}&date={$date}\"; </script> ";
            }
        }
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['files']))
    {
        $conn->close();
        echo" <script> window.location.href=\"files.php?&id={$id}\"; </script> ";
    }

    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['edit-task']))
    {
        // code

        //$createtask = new createtask($_POST['status'], $_POST['priority'], $_POST['due_date'], $_POST['title'], $_POST['description'], $id, $conn);


        $taskID = $_POST['edit-task'];
        $conn->close();
        echo" <script> window.location.href=\"user_edit_task.php?&id={$id}&taskID={$taskID}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['delete-task']))
    {
        //$taskID = mysqli_real_escape_string($conn, $_GET['taskID']);
        $taskID = $_POST['delete-task'];
        $sql = "DELETE FROM tasks WHERE id='$taskID' AND user_id='$id'";
        if($conn->query($sql) === TRUE) 
            {
                $conn->close();
                echo "
                <script>
                        if (Notification.permission === \"granted\") {
                            new Notification(\"Notice,\", {
                                body: \"Task has been removed.\",
                                icon: \"icon.png\"
                            });
                            window.location.href=\"home.php?&id={$id}\";
                            } else if (Notification.permission !== \"denied\") {
                                Notification.requestPermission().then(permission => {
                                    if (permission === \"granted\") {
                                        new Notification(\"Notice\", {
                                        body: \"Task has been removed.\",
                                        icon: \"icon.png\"
                                    });
                                }
                            });
                        }
                </script>";
            }
        
        // echo "task id: ". $taskID;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - create task</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <style>
        body{
            overflow: hidden;
        }

        .my-row{
            display: flex;
            flex-direction: row-reverse;
        }

        .my-main-content{
            overflow-x: auto;
            height: 100vh;
        }

        .Logo-txt {
            font-size: 1.25rem; 
            font-weight: bold;
            background: linear-gradient(to right, #3DE5B1, #42B1F6);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent; 
            background-clip: text;
            text-fill-color: transparent;
        }

        select:focus-within{
            outline-style: none;
        }

        .card-headline{
            display: flex;
        }


        .card-header-grid{
            display: flex;
        }

        .CONTENT{
            padding-bottom: 3rem;
        }

        @media (max-width: 780px){
            .my-row{
                display: flex;
                flex-direction:column;
            }

            .my-main-content
            {
                overflow: auto;
                scrollbar-width: none;
                -ms-overflow-style: none;
            }

            .my-main-content::-webkit-scrollbar 
            {
                display: none;
            }

            select:focus-within{
                outline-style: none;
            }

            .card-headline{
                display: none;
            }

            .card-header-grid-2{
                display: none;
            }

            .CONTENT{
                padding-bottom: 8rem;
            }
        }

        @media (max-width: 600px){ 
            .card-header-grid-1{
                display: none;
            }
        }

        @media (max-width: 500px){ 
            .btn-txt{
                display: none;
            }
        }
    </style>
</head>
<body>

        <div class="container-fluid" style="height: 100vh;">
            
            <div class="row my-row h-100">

                <div class="col p-0 my-col-content border-0 d-flex flex-column">
                    
                    

                    <!-- task content -->
                    <div class="my-main-content border-0 d-flex flex-column">

                        <nav class="p-0 navbar navbar-expand navbar-light topbar mb-4 static-top border-bottom" style="background-color: #ffff;">
                            <nav class="navbar bg-body-white p-0 w-100">
                              <div class="container-fluid d-flex justify-content-between align-items-center">
                          
                                <div class="border-0">
                                    <a class="navbar-brand d-flex justify-content-center align-items-center" href="#">
                                        <img src="assets/Logo.png"Logo" width="50rem" height="48rem" class="d-inline-block align-text-top">
                                        <span class="Logo-txt"> FlutterTask </span>
                                    </a>
                                </div>
                          
                                <!-- Profile -->
                                <div class="d-flex align-items-center gap-2">
                                  <span class="me-2 nav-name" style="font-size: 1rem;"> <?php echo $username; ?> </span>
                                  <div class="dropdown">
                                    <button class="btn border-white d-flex justify-content-center align-items-center"
                                      style="overflow: hidden; width: 2.5rem; height: 2.5rem; border-radius: 50%;" type="button"
                                      data-bs-toggle="dropdown" aria-expanded="false">
                                      <img src="<?php echo $profile_img; ?>" alt="..." width="40rem" height="40rem">
                                       
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                      <form method="POST">
        
                                        <div class="col p-2 d-flex flex-column justify-content-center align-items-center" style="gap: 0.8rem;">
                                            <div class="border d-flex justify-content-center align-items-center" style="width: 2rem; height: 2rem; overflow: hidden; border-radius: 50%;">
                                                <img src="<?php echo $profile_img; ?>" alt="..." width=35rem" height=35rem">
                                            </div>
                                            <span class="me-2" style="font-size: 0.8rem;"> <?php echo $username; ?> </span>
                                        </div>
                                        <hr class="dropdown-divider">
        
                                        <li><button class="dropdown-item" type="submit" name="profile" value="<?php echo $id; ?>">Profile</button></li>
                                        <li><button class="dropdown-item" type="submit" name="account-settings" value="<?php echo $id; ?>">Account settings</button></li>
        
                                        <hr class="dropdown-divider">
                                        <li><button class="dropdown-item" type="submit" name="sign-out">Sign out</button></li>
                                      </form>
                                    </ul>
                                  </div>
                                </div>
                          
                              </div>
                            </nav>
                        </nav>
                        
                        <div class="CONTENT d-flex flex-column border-0 p-1 ps-3 pe-3">
                            
                            
                            <!-- content -->
                            <div class="card border p-2 ps-3 pe-3 pt-3 pb-3" style="">
                                
                                <form method="POST" class="w-100 h-100">
                                    <!-- <div class="header bg-white border-0 d-flex flex-row" style="height: 2rem;">
                                        <div class="border-0 w-100 d-flex justify-content-start align-items-center">
                                            <span> <b>CREATE TASK</b> </span>
                                        </div>
                                        <div class="border-0 w-100 d-flex justify-content-end align-items-center">
                                            <button type="submit" name="create-task" class="rounded-5 ps-3 pe-3 text-white" style="border: 1px solid #42B1F6; background-color: #42B1F6;">
                                                create task
                                            </button>
                                        </div>
                                    </div>

                                    <div class="header bg-white border-0 d-flex flex-row" style="height: 2rem;">
                                        <div class="border-0 w-100 d-flex flex-row justify-content-start align-items-center">
                                            <div class="border-0 w-10 pe-3 h-100 d-flex justify-content-start align-items-center"><span> Tags: </span></div>
                                            <div class="border-0 w-25 pe-3 h-100 d-flex justify-content-start align-items-center">
                                                <select name="status" class="w-100 h-100">
                                                    <option value="todo">todo</option>
                                                    <option value="in-progress">in-progress</option>
                                                    <option value="">complete</option>
                                                </select>
                                            </div>
                                            <div class="border-0 w-25 h-100 d-flex justify-content-start align-items-center">
                                                <select name="priority" class="w-100 h-100">
                                                    <option value="low">low</option>
                                                    <option value="medium">medium</option>
                                                    <option value="high">high</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="border-0 w-100 d-flex flex-row" style="height: 2rem;">
                                        <div class="border-0 d-flex flex-row w-100">
                                            <div class="h-100 pe-3 d-flex justify-content-center align-items-center">
                                                <span> Due: </span>
                                            </div>
                                            <div class="h-100 w-100">
                                                <input type="date" name="due_date" class="w-100 h-100">
                                            </div>
                                        </div>
                                        <div class="border-0 d-flex flex-row w-100"></div>
                                    </div>

                                    <br>
                                    <div class="card-body border-0 p-0">

                                        <div class="border p-0 rounded-3" style="height: 3rem;">
                                            <input type="text" name="title" placeholder="TITLE" class="rounded-3 w-100 h-100 border-0 ps-3">
                                        </div>

                                        <br>

                                        <div class="border rounded-3" style="height: 14rem; display: flex;">
                                            <textarea name="description" placeholder="DESCRIPTION" class="border-0 rounded-3 w-100 h-100 p-3" style="outline: none; resize: vertical;"></textarea>
                                        </div>

                                    </div> -->
                                    <?php
                                    
                                        $task_id = mysqli_real_escape_string($conn, $_GET['taskID']);

                                        //echo "task id: ". $task_id;

                                            $sql_fetch_task="SELECT id, user_id, title, description, due_date, created_at, priority, status FROM tasks WHERE id='$task_id' AND user_id='$id'";
                                            $result_display = mysqli_query($conn, $sql_fetch_task);
                                            
                                            if($result_display->num_rows > 0)
                                            {
                                                while($row = $result_display->fetch_assoc())
                                                {
                                                    $ID = $row['id'];
                                                    $USERID = $row['user_id'];
                                                    $DUE = $row['due_date'];
                                                    $TITLE = $row['title'];
                                                    $DESCRIPTION = $row['description'];
                                                    $STATUS = $row['status'];
                                                    $PRIORITY = $row['priority'];

                                                    echo"
                                                    
                                                        <div class='header bg-white border-0 d-flex flex-row' style='height: 2rem;'>
                                                            <div class='border-0 w-100 d-flex justify-content-start align-items-center'>
                                                                <span> <b>VIEWING TASK</b> </span>
                                                            </div>
                                                            <div class='border-0 w-100 d-flex justify-content-end align-items-center'>
                                                                <button type='submit' value='$ID' name='edit-task' class='rounded-5 ps-3 pe-3 text-white' style='border: 1px solid #42B1F6; background-color: #42B1F6;'>
                                                                    edit task
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class='header bg-white border-0 d-flex flex-row' justify-content-start style='height: 2rem; gap: 1rem;'>
                                                                <div class='border h-100 rounded-5 ps-4 pe-4 d-flex justify-content-center align-items-center'>$STATUS</div>
                                                                <div class='border h-100 rounded-5 ps-4 pe-4 d-flex justify-content-center align-items-center'>$PRIORITY</div>
                                                        </div>

                                                        <br>

                                                        <div class='border-0 w-100 d-flex flex-row' style='height: 2rem;'>
                                                            <div class='border-0 d-flex flex-row w-100'>
                                                                <div class='h-100 pe-3 d-flex justify-content-center align-items-center'>
                                                                    <span> Due: </span>
                                                                </div>
                                                                <div class='h-100 w-100 border-0'>
                                                                    <input disabled type='text' name='due_date' value='$DUE' class='w-100 h-100 bg-white border-0'>
                                                                </div>
                                                            </div>
                                                            <div class='border-0 d-flex flex-row w-100'></div>
                                                        </div>

                                                        <br>
                                                        <div class='card-body border-0 p-0'>

                                                            <div class='border p-0 rounded-3' style='height: 3rem;'>
                                                                <input disabled type='text' value='$TITLE'  name='title' placeholder='TITLE' class='rounded-3 w-100 h-100 border-0 ps-3'>
                                                            </div>

                                                            <br>

                                                            <div class='border rounded-3' style='height: 8rem; display: flex;'>
                                                                <textarea disabled  name='description' placeholder='DESCRIPTION' class='border-0 rounded-3 w-100 h-100 p-3' style='outline: none; resize: vertical;'> $DESCRIPTION </textarea>
                                                            </div>

                                                             <button type='submit' title='' value='$ID' name='delete-task' class='inactive sidebar-nav border-0 d-flex flex-column justify-content-center bg-white pt-3 pb-3'>
                                                                <span class='text-danger'> Delete task </span>
                                                            </button>

                                                        </div>

                                                    ";
                                                }
                                            }
                                        
                                    
                                    ?>
                                </form>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- START OF SIDEBAR -->
                <div class="col-auto border my-sidebar bg-light p-0">
                   <form method="POST">

                        <div class="brand border-0 pt-3 pb-3 justify-content-center align-items-center">
                            <img src="assets/Logo.png" alt="..." width="60rem" height="55rem">
                        </div>

                        <button type="submit" title="Dashboard"  value="<?php echo $id; ?>" name="tasks" class="active sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-card-checklist align-self-center"></i>
                            <span> <b>Tasks</b> </span>
                        </button>

                        <button type="submit" title="Users" value="<?php echo $id; ?>" name="calendar" class="inactive sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-calendar-week align-self-center"></i>
                            <span> <b>Calendar</b> </span>
                        </button>

                        <button type="submit" title="Users" value="<?php echo $id; ?>" name="files" class="inactive sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-file-earmark-fill align-self-center"></i>
                            <span> <b>Files</b> </span>
                        </button>


                   </form>
                </div>
                <!-- End OF SIDEBAR -->

            </div>

        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        <script>
            let logoutTimer;
            function logoutUser() 
            {
                alert("You have been logged out due to inactivity.");
                window.location.href = 'index.php'; 
            }

            function resetTimer() 
            {
                clearTimeout(logoutTimer);
                logoutTimer = setTimeout(logoutUser, 30 * 60 * 1000); 
            }

            window.onload = resetTimer;
            window.onmousemove = resetTimer;
            window.onkeypress = resetTimer;
            window.onscroll = resetTimer;
            window.onclick = resetTimer;
        </script>
</body>
</html>