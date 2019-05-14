<!DOCTYPE html>
<html>
<head>
    <title>Registrace dokončena.</title>
    <style>
        body{
            background-color: whitesmoke;
            color:black;
            font-family: Verdana, Geneva, Tahoma, sans-serif
        }
    </style>
</head>

<body>
<center><h2>Vítej {{$user['name']}}</h2></center>
<br/>
Registrace účtu <b>{{$user['email']}}</b> proběhla úspěšně.
Dalším krok je přihlásit se na <a href="http://www.petrsmille.cz/admin">www.petrsmille.cz/admin</a>
</body>

</html>