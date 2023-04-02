<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>Page Title</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
</head>
<body>
    <form action="http://localhost/PI_api/public_html/api/auth/login" method="post">
        <br><h2>Login </h2>
        <input type="email" name="email" id="" value="teste@gmail.com">
        <input type="text" name="name" id="" value="danilo">
        <input type="password" name="password" id="" value="123">
        <input type="submit" value="ir">
    </form>

    <form action="" method="get"></form>











    
    <script src="jquery-3.5.1.min.js"></script>
    <script>
        var user_email = 'teste@gmail.com';
        var user_password = '123';
        
        function loginApi() {
            $.ajax({
                url: "http://localhost/PI_api/public_html/api/auth/login",
                method: 'POST',
                data: {'email' : user_email, 'password': user_password},
                })
                .done(function(data) {
                    console.log("<br> entrou no done");
                    console.log("<br>".dado);
                    localStorage.setItem('user_token_jwt', data.data);
                    
            });
        }

        function getUsers(){
            $.ajax({
                url: "http://localhost/PI_api/public_html/api/user",
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + localStorage.getItem('user_token_jwt')
                },
                })
                .done(function( data ) {
                    console.log(data);
            });
        }
    </script>
</body>
</html>