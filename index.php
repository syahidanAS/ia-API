<?php 
    include'helper.php';

    if(isset($_POST['input'])){
        $uid = mysqli_real_escape_string($db_connect,$_POST['uid']);
        $name = mysqli_real_escape_string($db_connect,$_POST['name']);
        $address = mysqli_real_escape_string($db_connect,$_POST['address']);
        $gender = mysqli_real_escape_string($db_connect,$_POST['gender']);
        $position_id = mysqli_real_escape_string($db_connect,$_POST['position_id']);

        mysqli_query($db_connect, "INSERT INTO employee VALUES('$uid','$name','$address','$gender','$position_id')");
        echo "<script>window.alert('Berhasil menyimpan data!')
        window.location='index.php'</script>";
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Realtime</title>
</head>
<body>

    <form action="" method="post">
        <table>
            <tr>
                <td>UID</td>
                <td>
                    : <input type="text" name="uid" placeholder="ID Kartu" required="required">
                </td>
            </tr>
            <tr>
                <td>UID</td>
                <td>
                    : <input type="text" name="name" placeholder="Nama Pegawai" required="required">
                </td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td>
                    : <textarea type="text" name="address" placeholder="Alamat" required="required"></textarea>
                </td>
            </tr>
            <tr>
                <td>Jenis Kelamin</td>
                <td>
                    : <input type="text" name="gender" value="m" required="required">
                </td>
            </tr>
            <tr>
                <td>Jabatan</td>
                <td>
                    : <input type="text" name="position_id" value="1" required="required">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    : <input type="submit" name="input" value="Simpan">
                </td>
            </tr>
        </table>
    </form>
    
</body>
</html>