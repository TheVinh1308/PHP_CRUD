<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .header {
            height: 120px;
            background-color: #007bff;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
        }
        .navbar-list {
            list-style: none;
            padding-left: 0;
            margin-top: 4px;
        }
        .navbar-item {
            margin: 0 8px;
            position: relative;
            min-height: 26px;
        }
        .navbar-item
        {
            display: inline-block;
            font-size: 1.4rem;
            color: var(--white-color);
            text-decoration: none;
            font-weight: 300;
        }
        .navbar-item:hover
            {
            color: rgba(255, 255, 255, 0.7);
            cursor: pointer;

        }
        .navbar-item-bold {
            font-weight: 500;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh; /* Sử dụng min-height thay vì height */
          }

          form {
            background-color: #fff;
            padding: 20px; /* Tăng padding để tạo khoảng cách */
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.3);
            margin: 20px auto;
            max-width: 500px;
            width: 100%; /* Thêm width: 100% để form không thu lại quá nhỏ */
          }


        h2 {
            text-align: center;
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        input[type="tel"],
        textarea,
        select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 5px;
            box-sizing: border-box;
        }

        input[type="checkbox"],
        input[type="file"] {
            margin-right: 5px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container" style="margin: 0 auto">
        <form action="{{route('login')}}" method="POST">
            @csrf
                <div class="form-group">
                    <label for="">Email: </label>
                    <input type="email" name="email">
                    @if($errors->has('email')) {{$errors->first('email')}} @endif
                </div>
                <div class="form-group">
                    <label for="" >Password: </label>
                    <input type="text" name="password">
                    @if($errors->has('password')) {{$errors->first('password')}} @endif
                </div>
                <label for="">Remember: <input type="checkbox" name="remember"></label>
                <input type="submit">
        </form>
    </div>
</body>
</html>
