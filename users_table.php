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

    /* start of fetching to display list of users in a table */  //* DISPLAY USERS TABLE
    $start = 0;
    $rows_per_page = 10;

    $records = mysqli_query($conn, "SELECT * FROM users");

    $nr_of_rows = mysqli_num_rows($records);

    $pages = ceil($nr_of_rows / $rows_per_page);

    if(isset($_GET['page-nr'])) 
    {
        $page = intval($_GET['page-nr']) - 1; 
        if($page < 0) 
        {
            $page = 0;
        }
        $start = $page * $rows_per_page;
    }

    $sql_display = "SELECT id, username, email, profile_img FROM users LIMIT $start, $rows_per_page";
    $result_display = mysqli_query($conn, $sql_display);
    /* end of fetching to display list of users in a table */

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
        header("Location: admin_account_profile.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['account-settings']))
    {
        $conn->close();
        header("Location: admin_account_edit.php?&id=".$id);
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['admin-dashboard']))
    {
        $conn->close();
        echo" <script> window.location.href=\"admin_dashboard.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['users-table']))
    {
        $conn->close();
        echo" <script> window.location.href=\"users_table.php?&id={$id}\"; </script> ";
    }
    else if($_SERVER['REQUEST_METHOD']==='POST' && isset($_POST['create-new-user']))
    {
        $conn->close();
        echo" <script> window.location.href=\"create_user.php?&id={$id}\"; </script> ";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fluttertask - dashboard</title>
    <link rel="icon" href="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgdmlld0JveD0iMCAwIDI0IDI0Ij48cGF0aCBmaWxsPSIjZmZmIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIGQ9Ik0xNC4yNSAyLjVhLjI1LjI1IDAgMCAwLS4yNS0uMjVIN0EyLjc1IDIuNzUgMCAwIDAgNC4yNSA1djE0QTIuNzUgMi43NSAwIDAgMCA3IDIxLjc1aDEwQTIuNzUgMi43NSAwIDAgMCAxOS43NSAxOVY5LjE0N2EuMjUuMjUgMCAwIDAtLjI1LS4yNUgxNWEuNzUuNzUgMCAwIDEtLjc1LS43NXptLjc1IDkuNzVhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41em0wIDRhLjc1Ljc1IDAgMCAxIDAgMS41SDlhLjc1Ljc1IDAgMCAxIDAtMS41eiIgY2xpcC1ydWxlPSJldmVub2RkIi8+PHBhdGggZmlsbD0iI2ZmZiIgZD0iTTE1Ljc1IDIuODI0YzAtLjE4NC4xOTMtLjMwMS4zMzYtLjE4NnEuMTgyLjE0Ny4zMjMuMzQybDMuMDEzIDQuMTk3Yy4wNjguMDk2LS4wMDYuMjItLjEyNC4yMkgxNmEuMjUuMjUgMCAwIDEtLjI1LS4yNXoiLz48L3N2Zz4=" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <link rel="stylesheet" href="main.css">
    <link rel="stylesheet" href="my_sidebar.css">
    <link rel="stylesheet" href="admin_dashboard.css">

    <style>

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
                        
                        <div class="d-flex flex-column border-0 p-2">
                            
                            
                            <!-- content -->
                            <div class="card my-card border ps-3 pe-3 pt-1 pb-3 rounded-0">
                                
                                    <form method="POST" class="w-100 h-100">

                                        <div class="p-1 card-header border-0 w-100 bg-white d-flex flex-row justify-content-center align-items-center">
                                            <div class="border-0 pt-2 pb-2 w-100 h-100 d-flex justify-content-start align-items-center">
                                                <span> USERS </span>
                                            </div>
                                            <div class="border-0 pt-2 pb-2 pe-3 w-100 h-100 d-flex justify-content-end align-items-center">
                                                <button type="submit" name="create-new-user" class="p-1 ps-3 pe-3 rounded-4" style="border: 1px solid #42B1F6; background-color: #42B1F6; color: #ffffff;">
                                                    <i class="bi bi-person-add"></i>
                                                    <span class="text-white btn-txt">New User</span>
                                                </button>
                                            </div>    
                                        </div>
                                        <div class="p-1 card-header border-0 w-100 bg-white d-flex flex-row justify-content-center align-items-center">
                                            <div class="border-0 pt-2 pb-2 w-100 h-100 d-flex justify-content-start align-items-center">
                                                <div class="container-fluid border-0 p-0" style="height: 2rem;">
                                                    <input class="form-control me-2 h-100" type="search" placeholder="Search" aria-label="Search"/>
                                                </div>
                                                <button type="submit" class="border-light bg-light" style="font-size: 0.8rem;"><i class="bi bi-search"></i></button>
                                            </div>

                                            <div class="border-0 pt-2 pb-2 pe-3 w-100 h-100 d-flex justify-content-end align-items-center">
                                                <div class="d-flex border-0 flex-row justify-content-center align-items-center h-100" style="gap: 0.6rem;">
                                                    <!-- <i class="bi bi-caret-left-fill"></i>
                                                    <span> 1 out of 100 </span>
                                                    <i class="bi bi-caret-right-fill"></i> -->
                                                    <!-- first
                                                    prev
                                                    next
                                                    last -->

                                                    <!-- FIRST -->
                                                    <?php
                                                        $userID=mysqli_real_escape_string($conn, $_GET['id']);
                                                        if(isset($userID))
                                                        {
                                                            echo"
                                                            <a href='?page-nr=1&id=$userID' class='border-0 d-flex justify-content-center align-items-center' style='background-color:rgb(235, 235, 235); text-decoration: none; border-radius: 6px; width: 1.75rem; font-size: 1.5rem; text-align: center;' title='First'>
                                                                <span style='font-size: 1rem;'> &laquo; </span>
                                                            </a>
                                                            ";
                                                        }
                                                    ?>

                                                    <!-- NEXT -->
                                                    <?php
                                                        $userID=mysqli_real_escape_string($conn, $_GET['id']);
                                                        if(isset($userID))
                                                        {
                                                            if(isset($_GET['page-nr']) && $_GET['page-nr'] > 1)
                                                            {
                                                                $previous_page = intval($_GET['page-nr']) - 1;
                                                                echo "
                                                                    <a href='?page-nr=$previous_page&id=$userID' class='border d-flex justify-content-center align-items-center' style='background-color:rgb(235, 235, 235); text-decoration: none; border-radius: 6px; width: 1.75rem; font-size: 1.5rem; text-align: center;' title='Previous'>
                                                                        <span style='font-size: 1rem;'> &lsaquo; </span>
                                                                    </a>
                                                                ";
                                                            }
                                                            else
                                                            {
                                                                echo "
                                                                    <a class='border d-flex justify-content-center align-items-center' style='background-color:rgb(235, 235, 235); text-decoration: none; border-radius: 6px; width: 1.75rem; font-size: 1.5rem; text-align: center;' title='Previous'>
                                                                        <span style='font-size: 1rem;'> &lsaquo; </span>
                                                                    </a>
                                                                ";
                                                            }   
                                                        }
                                                    ?>

                                                    <!-- COUNT -->
                                                    <span style="font-size: 0.6rem;"> <b> 1 out of <?php echo $pages; ?> </b> </span>

                                                    <!-- NEXT -->
                                                     <?php
                                                        $userID=mysqli_real_escape_string($conn, $_GET['id']);
                                                        if(isset($userID))
                                                        {
                                                            if(!isset($_GET['page-nr']))
                                                            {
                                                                echo"
                                                                    <a href='?page-nr=2&id=$userID' class='border d-flex justify-content-center align-items-center' style='background-color:rgb(235, 235, 235); text-decoration: none; border-radius: 6px; width: 1.75rem; font-size: 1.5rem; text-align: center;' title='Next'>
                                                                        <span style='font-size: 1rem;'> &rsaquo; </span>
                                                                    </a> 
                                                                ";
                                                            }
                                                            else
                                                            {
                                                                if($_GET['page-nr'] >= $pages2)
                                                                {
                                                                    echo "
                                                                        <a class='border d-flex justify-content-center align-items-center' style='background-color:rgb(235, 235, 235); text-decoration: none; border-radius: 6px; width: 1.75rem; font-size: 1.5rem; text-align: center;' title='Next'>
                                                                            <span style='font-size: 1rem;'> &rsaquo; </span>
                                                                        </a> 
                                                                    ";
                                                                }
                                                                else
                                                                {
                                                                    $next_page = intval($_GET['page-nr']) + 1;
                                                    
                                                                    echo "
                                                                        <a href='?page-nr=$next_page&id=$userID' class='border d-flex justify-content-center align-items-center' style='background-color:rgb(235, 235, 235); text-decoration: none; border-radius: 6px; width: 1.75rem; font-size: 1.5rem; text-align: center;' title='Next'>
                                                                            <span style='font-size: 1rem;'> &rsaquo; </span>
                                                                        </a>
                                                                    ";
                                                                }
                                                            }
                                                        }
                                                    ?>

                                                    <!-- last -->
                                                    <?php
                                                        $userID=mysqli_real_escape_string($conn, $_GET['id']);
                                                        if(isset($userID))
                                                        {
                                                            echo"
                                                                <a href='?page-nr=$pages2&id=$userID' class='border d-flex justify-content-center align-items-center' style='background-color:rgb(235, 235, 235); text-decoration: none; border-radius: 6px; width: 1.75rem; font-size: 1.5rem; text-align: center;' title='Last'>
                                                                    <span style='font-size: 1rem;'> &raquo; </span>
                                                                </a>
                                                            ";
                                                        }
                                                    ?>


                                                </div>
                                            </div>    
                                        </div>
                                        
                                        <div class="border-0 pt-2 pb-2" style="height: 30rem;">

                                                <div class="border-0 w-100 h-100" style="overflow: hidden;">

                                                    <div class="w-100 h-100 border-top" style="overflow-y: auto;">

                                                            <div class="card-header p-0 d-flex flex-row justyf-content-start align-items-center">
                                                                
                                                                <div class="hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2">
                                                                    <span> ID </span>
                                                                </div>
                                                                <div class="hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2">
                                                                    <span> PROFILE </span>
                                                                </div>
                                                                <div class="hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2">
                                                                    <span> USERNAME </span>
                                                                </div>
                                                                <div class="border-0 w-100 d-flex h-100 justify-content-center align-items-center pt-2 pb-2">
                                                                    <span> EMAIL </span>
                                                                </div>
                                                                <div class="border-0 w-100 h-100 d-flex justify-content-center align-items-center pt-2 pb-2">
                                                                    <span> ACTION </span>
                                                                </div>

                                                            </div>


                                                            <!-- list -->
                                                            <!-- <div class="border-bottom pb-3 pt-3 w-100 p-0 d-flex flex-row justify-content-start align-items-center">
                                                                <div class="hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2">
                                                                    <span> 7 </span>
                                                                </div>
                                                                <div class="hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2">
                                                                    <img src="..." alt="...">
                                                                </div>
                                                                <div class="hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2">
                                                                    <span> Masaru </span>
                                                                </div>
                                                                <div class="border-0 p-1 w-100 d-flex h-100 justify-content-center align-items-center pt-2 pb-2" style="text-align: justify;">
                                                                    <span> a.404authadm@gmail.com  </span>
                                                                </div>
                                                                <div class="border-0 w-100 h-100 d-flex justify-content-center align-items-center pt-2 pb-2">
                                                                    <div class="border d-flex flex-row">
                                                                        <button type="submit" name="sort_by" class="bg-light border-0 rounded-3" title="Press to operate">
                                                                            <i class="bi bi-three-dots"></i>
                                                                        </button>
                                                                        <div>
                                                                            <select name="filter" class="w-100 border-0 bg-light p-1 rounded-3" style="font-size: 0.8rem;">
                                                                                <optgroup label="Actions">
                                                                                    <option value="view">view</option>
                                                                                    <option value="edit">edit</option>
                                                                                    <option value="delete">delete</option>
                                                                                </optgroup>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div> -->

                                                            <?php
                                                                if($result_display->num_rows > 0)
                                                                {
                                                                    while($row = $result_display->fetch_assoc())
                                                                    {
                                                                        echo 
                                                                        " 
                                                                        <div class='border-bottom pb-3 pt-3 w-100 p-0 d-flex flex-row justify-content-start align-items-center'>
                                                                                <div class='hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2'>
                                                                                    <span> ".$row['id']." </span>
                                                                                </div>
                                                                                <div class='hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2'>
                                                                                    <div class='border d-flex justify-content-center align-items-center' style='border-radius: 50%; width: 2rem; height: 2rem; overflow: hidden;'>
                                                                                        <img src='".$row['profile_img']."' alt='...' style='width: 3rem; height: 3rem;'>
                                                                                    </div>
                                                                                </div>
                                                                                <div class='hide-column border-0 w-100 h-100 justify-content-center align-items-center pt-2 pb-2'>
                                                                                    <span> ".$row['username']." </span>
                                                                                </div>
                                                                                <div class='border-0 p-1 w-100 d-flex h-100 justify-content-center align-items-center pt-2 pb-2' style='text-align: justify;'>
                                                                                    <span> ".$row['email']."  </span>
                                                                                </div>
                                                                                <div class='border-0 w-100 h-100 d-flex justify-content-center align-items-center pt-2 pb-2'>
                                                                                    <div class='border d-flex flex-row'>
                                                                                        <button type='submit' name='action' value='".$row['id']."' class='bg-light border-0 rounded-3' title='Press to operate'>
                                                                                            <i class='bi bi-three-dots'></i>
                                                                                        </button>
                                                                                        <div>
                                                                                            <select name='selected_action' class='w-100 border-0 bg-light p-1 rounded-3' style='font-size: 0.8rem;'>
                                                                                                <optgroup label='Actions'>
                                                                                                    <option value='".$row['id']."'>view</option>
                                                                                                    <option value='".$row['id']."'>edit</option>
                                                                                                    <option value='".$row['id']."'>delete</option>
                                                                                                </optgroup>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        ";
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    echo "";
                                                                }   
                                                            ?>

                                                    </div>

                                                </div>

                                        </div>
                                        

                                    </form>

                            </div>

                            <br><br><br>

                        </div>

                    </div>

                </div>

                <!-- START OF SIDEBAR -->
                <div class="col-auto border my-sidebar bg-light p-0">
                   <form method="POST">

                        <div class="brand border-0 pt-3 pb-3 justify-content-center align-items-center">
                            <img src="assets/Logo.png" alt="..." width="60rem" height="55rem">
                        </div>

                        <button type="submit" title="Dashboard"  value="<?php echo $id; ?>" name="admin-dashboard" class="inactive sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-speedometer2 align-self-center"></i>
                            <span> <b>Dashboard</b> </span>
                        </button>

                        <button type="submit" title="Users" value="<?php echo $id; ?>" name="users-table" class="active sidebar-nav border-0 d-flex flex-column justify-content-center">
                            <i class="bi bi-table align-self-center"></i>
                            <span> <b>Users</b> </span>
                        </button>

                   </form>
                </div>
                <!-- End OF SIDEBAR -->

            </div>

        </div>

    

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
       
        
</body>
</html>