<?php

    session_start();
    if(!isset($_SESSION["role"]) && $_SESSION["role"] !== "admin"){
        Header("location:index.php");
		return;
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Print</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
    <style>
        .input-spacing{
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
    <script>
        function tambahInput(ol){
            var memperhatikanList = document.getElementById(ol);
            var input = document.createElement("textarea");
            input.setAttribute("class","form-control input-spacing");
            input.setAttribute("name","memperhatikan[]");
            
            var container = document.createElement("li");
            container.appendChild(input);
            memperhatikanList.appendChild(container);
        }
    </script>
    <div class="container">
        <form action="print_format.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>
            <div class="form-group">
                <label for="nomorInput">Nomor Surat : </label>
                <input name="nomorsurat" type="text" class="form-control" id="nomorInput">
            </div>
            <label for="memperhatikanInput">Memperhatikan : </label>
            <div id="memperhatikanInput">
                <ol id="memperhatikanList">
                    <li>
                        <textarea class="form-control input-spacing" name="memperhatikan[]"></textarea>
                    </li>
                </ol>
                <a style="margin-top:10px;float: right;" onclick="tambahInput('memperhatikanList')" class="btn btn-success">Tambah Input</a>
                <div style="clear: both;">
            </div>
            <label for="memutuskanInput">Memutuskan : </label>
            <div id="memutuskanInput">
                <ol id="memutuskanList">
                    <li>
                        <textarea class="form-control input-spacing" name="memutuskan[]"></textarea>
                    </li>
                </ol>
                <a style="margin-top:10px;float: right;" onclick="tambahInput('memutuskanList')" class="btn btn-success">Tambah Input</a>        
                <div style="clear: both;"/>
            </div>      
            <button type="submit" class="btn btn-primary">Generate</button>      
        </form>
    </div>
</body>
</html>