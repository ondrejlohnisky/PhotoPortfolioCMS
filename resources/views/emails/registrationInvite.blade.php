<!DOCTYPE html>
<html>
<head>
    <title>Pozvánka k registraci.</title>
    <style>
        body{
            background-color: whitesmoke;
            color:black;
            font-family: Verdana, Geneva, Tahoma, sans-serif
        }
    </style>
</head>

<body>
<center><h2>Byl jsi pozván k registraci</h2></center>
<br/>
Registrujte se kliknutím na <a href="http://127.0.0.1:8000/admin/register?email={{ $email }}&token={{ $token }}">tento</a> odkaz.

</body>

</html>