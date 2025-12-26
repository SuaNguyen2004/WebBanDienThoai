<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập</title>
    <style>
        .warning {
            color: red;
            text-align: center;
            margin-top: -15px;
        }

        main {
            /* width: 50%; */
            margin: auto;
            background: #f1f0f0ff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 100px;
            border: 2px solid #29a2cfff;
        }

        .box1 {
            margin-bottom: 10px;
            /* text-align: center; */
        }

        .box1 input {
            margin-top: 10px;
            width: 100%;
            text-align: center;
            height: 20px;
            border-radius: 5px;
            border: 1px solid black;
        }

        .message p {
            text-align: center;
        }
        a{
            text-decoration:none;
        }
    </style>
</head>

<body>

    <form action="login.php" method="post">
        <main>
            <h1 style="text-align: center" ;>Đăng nhập</h1>
            <div class="box1">
                Tên đăng nhập : <br>
                <input type="text" name="tendangnhap" placeholder="Điền tên đăng nhập">
            </div>
            <div class="box1">
                Mật khẩu : <br>
                <input type="password" name="matkhau" placeholder="Điền mật khẩu">
            </div>
            <input style="width: 408px; 
            margin-top: 10px; 
            height: 23px; border-radius: 5px;
            border: 1px solid black;
            background-color: #aeaeaeff" type="submit" value="Đăng nhập">
            <div class="message">
                <p>Chưa có tài khoản?</p>
                <a href="../manager/register.php">
                    <p>Đăng kí</p>
                </a>
                <a href="../index.php">
                    <p>Trang chủ</p>
                </a> <br>
            </div>

            <?php if (isset($error)) : ?>
                <p style="color:red; font-weight:bold; font-size:14px;"><?php echo $error; ?></p>
            <?php endif; ?>
    </form>

    <?php
    include('../connect.php');
    if (isset($_POST['tendangnhap']) && isset($_POST['matkhau'])) {
        $tenDangNhap = $_POST['tendangnhap'];
        $matKhau = $_POST['matkhau'];

        $sql = "select * from nguoi_dung where ten_dang_nhap = '$tenDangNhap' && mat_khau = '$matKhau'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION["ten_dang_nhap"] = $tenDangNhap;
            $_SESSION['nguoi_dung_id'] = $user['id'];
            $_SESSION["vai_tro"] = $user["vai_tro"];
            // header('location: trangchu.php');
            if ($user['ten_dang_nhap'] == 'admin') {
                header('location: ../admin/dashboard.php');
            } else {
                header('Location:../index.php');
            }
        } else {
            echo "<p class='warning'>Tên đăng nhập hoặc mật khẩu không chính xác!</p>";
        }
    }

    ?>
    </main>
</body>

</html>