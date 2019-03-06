<form class="w-25" action="<?Php echo $_SERVER['PHP_SELF']?>" method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" id="exampleInputEmail1" 
        aria-describedby="emailHelp" placeholder="Username" name="Username">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="Password">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?Php
    $name = $_POST['Username'];
    $password = $_POST['Password'];
    $user = ['admin'=>'12345','james'=>'780902'];
    if($user[$name] == $password){
        echo $name." 您好!!";
    }else
        echo "帳號密碼錯誤";
?>