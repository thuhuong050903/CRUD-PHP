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
        background-color: red;
        color:yellow;
        padding: auto;


    }
.form-group label{
    display:block;
}
.form-item{
    width:50%;
    /* padding: 5px 10px; */
}
.form-group{
    margin-bottom:15px;

}
.alert{
    border: 1px dotted red;
    padding: 5px 15px;
    

}
.error{
    color: red;
    font-style: italic;
    font-size: 90%
}
</style>
<body>
   <a href="list.php" class="btn"> Danh sách sinh viên</a> 
   <hr/>

   <?php
    error_reporting(0);
    if(!empty($_GET['id'])){
            $student_id = $_GET['id'];
                $student_infor = $_SESSION['student'][$student_id];
                echo '<pre>';
                print_r($student_infor);
                echo '</pre>';
    }else{
            redirect('list.php');
            
    }
?>
<?php

   if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Validate 
        $errors = array();
        if (!empty($_POST['student_id'])) {
            $student_id=$_POST['student_id'];

        }else {
            $errors[]='ma_err';
        }

        if (!empty($_POST['student_name'])) {
            $student_name=$_POST['student_name'];

        }else {
            $errors[]='name_err';
        }
        if (!empty($_POST['student_gender'])) {
            $student_gender=$_POST['student_gender'];

        }else {
            $errors[]='gender_err';
        }
        if (!empty($_POST['student_hometown'])) {
            $student_hometown=$_POST['student_hometown'];

        }else {
            $errors[]='hometown_err';
        }

        if (!empty($_POST['student_birthday'])) {

            $student_birthday=$_POST['student_birthday'];

        }else {
            $errors[]='birthday_err';
        }
        if (!empty($_POST['student_major'])) {
            $student_major=$_POST['student_major'];

        }else {
            $errors[]='major_err';
        }
   
        if (!empty($errors)){
            // co loi
            $mess = "Đã xảy ra lỗi. Vui lòng kiểm tra.";
            ?>
            <div class="alert">
                <?php echo $mess;?>
             </div>
             <?php
        }else{
            // khong co loi
            $item_student=[
                'maSV'=>$student_id,
                'name'=>$student_name,
                'gender'=>$student_gender,
                'hometown'=>$student_hometown,
                'birthday'=>$student_birthday,
                'major'=>$student_major
            ];
            if (!empty($_SESSION['student'])){
                $check= false;
                foreach ($_SESSION['student'] as  $item) {
                    if($student_id == $item['maSV'] ){
                        $check=true;
                        break;
                    }    
                }
            }else{
                $check= false;
            }
            // neu check bang false thi them 
            if ($check==true){
                $_SESSION['student'][$student_id]=$item_student;
                set_flash_session('mess_flash', 'Sửa thành công');
                redirect('list.php');
            }else{
                ?>
                <div class="alert alert-danger">
                    Bạn không thể thay đổi mã SV
                </div>
                <?php
             }
            }
        }
   ?>

   <form action="" method="post">
    <div class="form-group">
        <label for="">Mã sinh viên</label>
        <input type="text" class="form-item" name="student_id" placeholder="Nhập mã sinh viên " value="<?php echo $student_infor['maSV'];?>">
        <?php if (!empty($errors) && in_array('ma_err',$errors)): ?>
        <span class="error">Mã sinh viên không được để trống.</span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="">Họ và tên</label>
        <input type="text" class="form-item" name="student_name" placeholder="Nhập họ và tên sinh viên" value="<?php echo $student_infor['name'];?>">
        <?php if (!empty($errors) && in_array('name_err',$errors)): ?>
        <span class="error">Tên sinh viên không được để trống.</span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="">Giới tính</label>
        <input type="radio" class="form-item" name="student_gender" value="<?php echo $student_infor['gender'];?>">Nam
        <input type="radio" class="form-item" name="student_gender" value="<?php echo $student_infor['gender'];?>" >Nu
        <?php if (!empty($errors) && in_array('gender_err',$errors)): ?>
        <span class="error">Giới sinh viên không được để trống.</span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="">Quê quán</label>
        <input type="text" class="form-item" name="student_hometown" placeholder="Nhập quê quán" value="<?php echo $student_infor['hometown'];?>">
        <?php if (!empty($errors) && in_array('hometown_err',$errors)): ?>
        <span class="error">Quê quán sinh viên không được để trống.</span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="">Ngày sinh</label>
        <input type="date" class="form-item" name="student_birthday" value="<?php echo $student_infor['birthday'];?>">
        <?php if (!empty($errors) && in_array('birthday_err',$errors)): ?>
        <span class="error">Ngày sinh viên không được để trống.</span>
        <?php endif;?>
    </div>
    <div class="form-group">
        <label for="">Ngành học</label>
        <input type="text" class="form-item" name="student_major" placeholder="Nhập ngành học" value="<?php echo $student_infor['major'];?>">
        <?php if (!empty($errors) && in_array('major_err',$errors)): ?>
        <span class="error">Ngày học sinh viên không được để trống.</span>
        <?php endif;?>
    </div>
    <button type="submit">Save</button>
   </form>
</body>
</html>