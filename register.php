<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng ký</title>
    <!-- <link rel="stylesheet" href="../css/register.css" /> -->
    <style>
        main {
            /* width: 50%; */
            margin: auto;
            background: #f1f0f0ff;
            padding: 40px 30px;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
            margin-top: 50px;
            border: 2px solid #29a2cfff;
        }

        .input-group input {
            margin-top: 10px;
            margin-bottom: 10px;
            width: 100%;
            height: 25px;
            border-radius: 5px;
            border: 1px solid black;
        }

        button {
            justify-content: center;
            width: 407px;
            background-color: #bdbdbdff;
            height: 25px;
            border-radius: 5px;
            border: 1px solid black;
            margin-top: 10px;
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
    <main>
        <?php
        include('../connect.php');
        $error = '';
        if (!empty($_POST['ten_dang_nhap']) && !empty($_POST['mat_khau']) && !empty($_POST['mat_khau_again'])) {
            $ten_dang_nhap = $_POST['ten_dang_nhap'];
            $mat_khau = $_POST['mat_khau'];
            $mat_khau_again = $_POST['mat_khau_again'];

            if ($mat_khau != $mat_khau_again) {
                $error = "Vui lòng nhập lại thông tin cho đúng!";
            } else {
                $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = '$ten_dang_nhap'";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $error = "Tên đăng nhập đã tồn tại, vui lòng chọn tên khác.";
                } else {
                    $sql_res = "INSERT INTO nguoi_dung (`ten_dang_nhap`, `mat_khau`, `vai_tro`) VALUES ('$ten_dang_nhap', '$mat_khau', 'user')";
                    mysqli_query($conn, $sql_res);
                    header('Location: login.php');
                    exit();
                }
            }
        }
        ?>

        <div class="register-container">
            <form class="register-form" action="register.php" method="POST">
                <h1 style="text-align: center" ;>Tạo tài khoản</h1>
                <div class="input-group">
                    <label for="ten_dang_nhap">Tên đăng nhập</label> <br>
                    <input type="text" name="ten_dang_nhap" id="ten_dang_nhap" placeholder="Điền tên đăng nhập" required />
                </div>
                <div class="input-group">
                    <label for="mat_khau">Mật khẩu</label> <br>
                    <input type="mat_khau" name="mat_khau" id="mat_khau" placeholder="Điền mật khẩu" required />
                </div>
                <div class="input-group">
                    <label for=" mat_khau">Nhập lại mật khẩu</label> <br>
                    <input type="mat_khau" name="mat_khau_again" id="mat_khau" placeholder="Nhập lại mật khẩu"
                        required />
                </div>
                <button type="submit">Đăng ký</button>
                <div class="message">
                    <p>Đã có tài khoản?</p> <a href="../manager/login.php">
                        <p>Đăng nhập</p>
                    </a>
                    <a href="../index.php">
                        <p>Trang chủ</p>
                    </a>
                </div>
                <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
            </form>
        </div>
    </main>
</body>

</html>