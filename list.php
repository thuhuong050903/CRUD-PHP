<?php
 session_start();
 require_once 'functions.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>
</head>
<style>
    .btn{
        text-decoration: none;
        background-color: yellow;
        color: black;
        text-align: center;
        font-size: 20px;
    }

</style>
<body>

<?php


// echo '<pre>';
// print_r($_SESSION['student']);
// echo '</pre>';


?>
<?php
$mess = get_flash_session('mess_flash');

if (!empty($mess)){
    ?>
    <div class = "alert"><?php echo $mess ;?></div>
    <?php

}
?>
<hr>
    <table border ="1" style="background-color:burlywood; margin:auto" cellpadding="0" cellspacing="0" width="60%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ và tên</th>
                <th>Giới tính</th>
                <th>Quê quán</th>
                <th>Ngày sinh</th>
                <th>Ngành học</th>
                <th width="5%">Sửa</th>
                <th width="5%">Xóa</th>
                
            </tr>
        </thead> 
        <tbody>
            <?php
             if (!empty($_SESSION['student'])): 
                
                foreach ($_SESSION['student'] as $key => $value ): 
            
            ?>
            <tr>
                <td><?php echo $key ?></td>
                <td><?php echo $value['name']; ?></td>
                <td><?php echo $value['gender']; ?></td>
                <td><?php echo $value['hometown']; ?></td>
                <td><?php echo $value['birthday']; ?></td>
                <td><?php echo $value['major']; ?></td>
                <td style="text-align: center"><a href="edit.php?id=<?php echo $key;?>" class="btn">Sửa</a></td>
                <td style="text-align: center"><a href="delete.php?id=<?php echo $key; ?> "onclick="return confirm('Ban co muon xoa khong')"class="btn">Xóa</a></td>
                

            </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="6">Khong co data</td>
                </tr>
            <?php endif;
            ?>
            
        </tbody>

    </table>
    <br>
    <br/>
    <a href="add.php" class="btn" style="font-size:24px;margin-left:45%;background-color:aqua;color:red;font-weight:bold">Thêm sinh viên</a>
    <hr/>
</body>
</html>