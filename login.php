<?php
    include "koneksi.php";
    if(isset($_POST['username'])) {

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $cek = mysqli_query($koneksi, "SELECT*FROM user WHERE username='$username' AND password='$password'");

         if(mysqli_num_rows($cek) > 0) {
            $data = mysqli_fetch_array($cek);
            $_SESSION['user'] = $data;
            echo '<script>alert("selamat datang, jangan lupa logout setelah selesai menggunakan halaman ini"); location.href="index.php" </script>';
            }else{
            echo '<script>alert("Username/Password salah.");</script>';
     
            }
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Login Aplikasi Kasir</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="bg-danger">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Login Aplikasi Kasir</h3></div>
                                    <div class="card-body">
                                        <form method="post">
                                            <div class="form-group">
                                                <label class="small mb-1" for="inputEmailAddress">Username</label>
                                                <input class="form-control py-4" id="inputEmailAddress" type="text" name="username" placeholder="Enter username " />
                                            </div>
                                            <div class="form-group">   
                                                <label class="small mb-1" for="inputPassword">Password</label>
                                                <input class="form-control py-4" id="inputPassword" name="password" type="password" placeholder="Enter Password" />
                                            </div>
                                            <div class="from-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <button class="btn btn-primary w-100" type="submit" name="login" value="login">Login</button>
                                                
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center">
                                        <div class="small">Belum punya akun? register!<a href="register.php">Daftar</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
    </body>
</html>