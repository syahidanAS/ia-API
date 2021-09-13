
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tampil data</title>
</head> 
<body>
    <input type="text" value="" id="masuk">

    
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            selesai();
        });

        function selesai(){
            setTimeout(function(){
                update();
                selesai();
            },400);
        }

        function update(){
            $.getJSON("aksi-tampil.php", function(data){
                $("ul").empty;
                $.each(data.result, function(){
                    // $("ul").append("<li>UID : "+this['uid']+"</li>");
                    document.getElementById("masuk").value = this['uid'];
                });
            });
        }

    </script>
</body>
</html>