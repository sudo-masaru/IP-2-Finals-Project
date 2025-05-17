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
        $conn->close();
        echo" <script> window.location.href=\"calendar.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['files']))
    {
        $conn->close();
        echo" <script> window.location.href=\"files.php?&id={$id}\"; </script> ";
    }

    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['create-new-task']))
    {
        $conn->close();
        echo" <script> window.location.href=\"create_task.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['view-task']))
    {
        $taskID = $_POST['view-task'];

        // echo "task id: ".$taskID;

        $conn->close();
        echo" <script> window.location.href=\"user_view_task.php?&id={$id}&taskID={$taskID}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['filter-by']))
    {
        $filter_val = $_POST['filtered-option'];
        $conn->close();
        header("Location: filter_by.php?&id=".$id."&filter_val=".$filter_val);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['filter-date']))
    {
        $date_val = $_POST['date_val'];
        $conn->close();
        header("Location: filter_date.php?&id=".$id."&date_val=".$date_val);
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - home</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <style>
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

        .my-card{
            flex-direction: row;
        }

        .sub-card{
            width: 15rem;
            height: 8rem;

            background-color:rgb(90, 69, 69);
            box-shadow: 0px 2px 2px 0px rgba(0,0,0,0.2); 
        }

        .search-bar-column{
            flex-direction: row;
        }


        .list-card{
            border: 1px solid #ffffff;
            background-color:#ffffff;
        }
        /* .list-card:hover{
            background-color:rgb(247, 247, 247);
            border: 1px solid rgb(247, 247, 247);
        } */
        .LIST-BTN{
            background-color:#ffffff;
        }
        .LIST-BTN:hover{
            background-color:rgb(247, 247, 247);
        }
        .LIST-BTN:hover .list-card{
            border: 1px solid rgb(247, 247, 247);
            background-color:rgb(247, 247, 247);
        }

        .content-mobile{
            padding-bottom: 6rem;
            gap: 1rem;
        }

        /* .TITLE {
            width: 100%;
        } */

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

            .my-card{
                flex-direction: column;
            }

            .search-bar-column{
                flex-direction: column;
            }


            .content-mobile{
                padding-bottom: 6rem;
                gap: 1rem;
            }


            /* .TITLE {
                width: 50%;
                overflow: hidden; 
                text-overflow: ellipsis;
                white-space: nowrap;
            } */

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

        .hide-column{
            display: flex;
        }
        @media (max-width: 800px){ 
            .hide-column{
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
                        
                        <div class="d-flex flex-column border-0 ps-3 pe-3" style="gap: 1rem;">
                            
                            <div class="card p-0 rounded-3 border d-flex justify-content-center align-items-center" style="height: 20rem; overflow: hidden; background-color: #F3FAFB;">
                                <img src="assets/banner.jpeg" alt="..." style="width: 20rem height: 20rem;">
                            </div>

                            <div class="card rounded-0 border-0 d-flex flex-row" style="height: 3rem;">
                                <div class="w-100 h-100 d-flex justify-content-start align-items-center border-0">
                                    <span> <b>TASKS</b> </span>
                                </div>
                                <div class="w-100 h-100 d-flex justify-content-end align-items-center border-0">
                                    <div class="border-0 pt-2 pb-2 pe-3 w-100 h-100 d-flex justify-content-end align-items-center">
                                            <form method="POST">
                                                <button type="submit" name="create-new-task" class="p-1 ps-3 pe-3 rounded-4" style="border: 1px solid #42B1F6; background-color: #42B1F6; color: #ffffff;">
                                                    <i class="bi bi-plus-circle"></i>
                                                    <span class="text-white btn-txt">New Task</span>
                                                </button>
                                            </form>
                                    </div> 
                                </div>
                            </div>
                            <div class="card rounded-0 border-0 d-flex flex-row" style="height: 2rem;">
                                <div class="w-50 border-0 h-100 d-flex justify-content-start align-items-center">
                                    <form method="POST" class="w-100 h-100">
                                        <div class="d-flex flex-row justify-content-center align-items-center w-100 h-100">
                                            <button type="submit" name="filter-by" class="border-0 h-100" style="background-color: #42B8EA;">
                                                    <i class="bi bi-funnel-fill text-white"></i>
                                            </button>
                                            <select name="filtered-option" class="bg-white border w-100 h-100">
                                                <!-- <option value="default"> Filter by </option> -->
                                                <optgroup label="Status">
                                                    <option value="todo">todo</option>
                                                    <option value="in-progress">in-progress</option>
                                                    <option value="completed">completed</option>
                                                </optgroup>
                                                <optgroup label="Priority">
                                                    <option value="todo">low</option>
                                                    <option value="in-progress">medium</option>
                                                    <option value="completed">completed</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div class="w-25 h-100 d-flex justify-content-start align-items-center border-0"></div>
                                <div class="border-0 w-100 d-flex justify-content-start align-items-center">
                                    <form method="POST" class="w-100 h-100 d-flex flex-row">
                                        <button type="submit" name="filter-date" class="border-0 h-100" style="background-color: #42B8EA;">
                                            <i class="bi bi-calendar-week align-self-center text-white"></i>
                                        </button>
                                        <input type="date" name="date_val" class="h-100 w-100 border">
                                    </form>
                                </div>
                            </div>

                            <form method="POST" class="content-mobile card border-0 rounded-0 d-flex flex-column">
                                
                                        <!-- list -->
                                        
                                        <!-- <div class="card rounded-2 d-flex" style="height: 6rem;">
                                            <button type="submit" class="list-card rounded-2 w-100 h-100 d-flex flex-row">
                                                    <div class="border-0 h-100 d-flex justify-content-center align-items-center" style="width: 5rem;">
                                                        <i class="bi bi-view-list"></i>
                                                    </div>
                                                    <div class="border-0 w-100 d-flex justify-content-start flex-column">
                                                        <div class="border-0 w-100 h-100 d-flex justify-content-start align-items-center">
                                                                <span> <b> Hello world </b> </span>
                                                        </div>
                                                        <div class="border-0 w-100 h-100 d-flex justify-content-start align-items-center">
                                                                <span> May 14 </span>
                                                        </div>
                                                    </div>
                                            </button>
                                        </div> 

                                        <div class="card rounded-2 d-flex" style="height: 6rem;">
                                            <button type="submit" class="list-card rounded-2 w-100 h-100 d-flex flex-row">
                                                    <div class="border-0 h-100 d-flex justify-content-center align-items-center" style="width: 5rem;">
                                                        <i class="bi bi-view-list"></i>
                                                    </div>
                                                    <div class="border-0 w-100 d-flex justify-content-start flex-column">
                                                        <div class="border-0 w-100 h-100 d-flex justify-content-start align-items-center">
                                                                <span> <b> Hello world </b> </span>
                                                        </div>
                                                        <div class="border-0 w-100 h-100 d-flex justify-content-start align-items-center">
                                                                <span> May 14 </span>
                                                        </div>
                                                    </div>
                                            </button>
                                        </div>  -->

                                        <?php

                                            $date_val = mysqli_real_escape_string($conn, $_GET['date_val']);
                                            if(isset($date_val))
                                            {                                            
                                                
                                                $sql_query_tasks="SELECT id, user_id, title, priority, status, DATE(created_at) AS created_date FROM tasks WHERE (user_id='$id' AND due_date='$date_val')";
                                                $result_display = mysqli_query($conn, $sql_query_tasks);
                                                
                                                if($result_display->num_rows > 0)
                                                {
                                                    while($row = $result_display->fetch_assoc())
                                                    {
                                                        $TASKID = $row['id'];
                                                        $USERID = $row['user_id'];
                                                        $TITLE = $row['title'];
                                                        $DATE = $row['created_date'];
                                                        $STATUS = $row['status'];
                                                        $PRIORITY = $row['priority'];

                                                        if($row['status']==="todo")
                                                        {
                                                            echo "
                                                        
                                                            <div class='LIST-BTN card rounded-2 d-flex pt-3 pb-3'>
                                                                <button type='submit' name='view-task' value='$TASKID' class='pt-2 pb-2 ps-2 pe-2 list-card rounded-2 w-100 h-100 d-flex flex-row'>
                                                                        <div class='border-0 h-100 d-flex justify-content-center align-items-center' style='width: 3rem;'>
                                                                            <i class='bi bi-view-list'></i>
                                                                        </div>
                                                                        <div class='border-0 w-75 h-100 d-flex justify-content-start flex-column'>
                                                                            <div class=' border-0 h-100 d-flex justify-content-start align-items-center' style='text-align: justify;'>
                                                                                    <span> <b> $TITLE </b> </span>
                                                                            </div>
                                                                            <div class='border-0 h-100 d-flex justify-content-start align-items-center'>
                                                                                    <span> $DATE </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='d-flex w-25 border-0 justify-content-end align-items-center h-100 pe-3'>
                                                                            <div class='border-secondary bg-secondary' style='width: 0.8rem; height: 0.8rem; border-radius: 50%;'></div>
                                                                        </div>
                                                                </button>
                                                            </div>
                                                            ";
                                                        }
                                                        else if($row['status']==="in-progress")
                                                        {
                                                            echo "
                                                        
                                                            <div class='LIST-BTN card rounded-2 d-flex pt-3 pb-3'>
                                                                <button type='submit' name='view-task' value='$TASKID' class='pt-2 pb-2 ps-2 pe-2 list-card rounded-2 w-100 h-100 d-flex flex-row'>
                                                                        <div class='border-0 h-100 d-flex justify-content-center align-items-center' style='width: 3rem;'>
                                                                            <i class='bi bi-view-list'></i>
                                                                        </div>
                                                                        <div class='border-0 w-75 h-100 d-flex justify-content-start flex-column'>
                                                                            <div class=' border-0 h-100 d-flex justify-content-start align-items-center' style='text-align: justify;'>
                                                                                    <span> <b> $TITLE </b> </span>
                                                                            </div>
                                                                            <div class='border-0 h-100 d-flex justify-content-start align-items-center'>
                                                                                    <span> $DATE </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='d-flex w-25 border-0 justify-content-end align-items-center h-100 pe-3'>
                                                                            <div class='border-warning bg-warning' style='width: 0.8rem; height: 0.8rem; border-radius: 50%;'></div>
                                                                        </div>
                                                                </button>
                                                            </div>
                                                            ";
                                                        }
                                                        else if($row['status']==="completed")
                                                        {
                                                            echo "
                                                        
                                                            <div class='LIST-BTN card rounded-2 d-flex pt-3 pb-3'>
                                                                <button type='submit' name='view-task' value='$TASKID' class='pt-2 pb-2 ps-2 pe-2 list-card rounded-2 w-100 h-100 d-flex flex-row'>
                                                                        <div class='border-0 h-100 d-flex justify-content-center align-items-center' style='width: 3rem;'>
                                                                            <i class='bi bi-view-list'></i>
                                                                        </div>
                                                                        <div class='border-0 w-75 h-100 d-flex justify-content-start flex-column'>
                                                                            <div class=' border-0 h-100 d-flex justify-content-start align-items-center' style='text-align: justify;'>
                                                                                    <span> <b> $TITLE </b> </span>
                                                                            </div>
                                                                            <div class='border-0 h-100 d-flex justify-content-start align-items-center'>
                                                                                    <span> $DATE </span>
                                                                            </div>
                                                                        </div>
                                                                        <div class='d-flex w-25 border-0 justify-content-end align-items-center h-100 pe-3'>
                                                                            <div class='border-success bg-success' style='width: 0.8rem; height: 0.8rem; border-radius: 50%;'></div>
                                                                        </div>
                                                                </button>
                                                            </div>
                                                            ";
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    // echo "No results.";
                                                    echo"
                                                        <div class='card w-100 pt-5 pb-3 border-0 d-flex justify-content-center align-items-center'>
                                                        
                                                            No results.
                                                        
                                                        </div>
                                                    ";
                                                }
                                        
                                        }

                                        ?>

                                
                                

                            </form>

                        </div>

                    </div>

                    <br>
                    <br>
                    <br>

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


                   </form>
                </div>
                <!-- End OF SIDEBAR -->

            </div>

        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        
</body>
</html>