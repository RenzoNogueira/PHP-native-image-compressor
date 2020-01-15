<?php
include "test.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body {
            background-color: #e1f5fe;
        }

        .image {
            width: 300px;
            height: 300px;
        }

        .container {
            display: grid;
            grid-template-columns: auto auto;
        }
    </style>
</head>

<body>
    <center>
        <h1>PHP native image compressor</h1>
        <div class="container">
            <div>
                <h2>Before</h2>
                <img class="image" src="img/image.jpg" alt="">
            </div>
            <div>
                <h2>After</h2>
                <img class="image" src="compress/new_image.jpeg" alt="">
            </div>
        </div>
    </center>
</body>

</html>