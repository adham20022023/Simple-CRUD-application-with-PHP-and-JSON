<?php
function create_user($data){
    $users=read_users();
    $data['id']=rand(100000,2000000);
    $users[]=$data;
    putJson($users);
    return $data;
}
function get_user_by_id($id){
    $users=read_users();
    foreach($users as $user){
        if($user['id']==$id){
            return $user;
        }
    }
}
function putJson($users)
{
    file_put_contents(__DIR__ . '/users.json', json_encode($users, JSON_PRETTY_PRINT));
}
function validate_user($user,&$errors){
    $isValid=true;
    if(empty($user['name'])){
        $errors['name']='Name is required';
        $isValid=false;
    }

    if(!$user['username'] || strlen($user['username'])<6 || strlen($user['username'])>20){
        $errors['username']='Username is required and it must be more than 6 and less then 16 character';
        $isValid=false;
    }
    if(!$user['email'] || !filter_var($user['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email']='Email is required';
        $isValid=false;
    }
    if(!$user['phone'] || strlen($user['phone'])<10 || strlen($user['phone'])>20){
        $errors['phone']='Phone is required';
        $isValid=false;
    }
    return $isValid;
}
function update_user($data,$id){
    $updateUser=[];
    $users=read_users();
    foreach($users as $i =>$user){
        if($user['id']==$id){
            $users[$i]=$updateUser=array_merge($user,$data);
        }
    }
    putJson($users);
    return $updateUser;

}
function delete_User($id)
{
    $users = read_users();

    foreach ($users as $i => $user) {
        if ($user['id'] == $id) {
            if (!empty($user['extension'])) {
                $imagePath = __DIR__ . '/images/'.$user['id'].'.'.$user['extension'];
                unlink($imagePath);
            }

            array_splice($users, $i, 1);
        }
    }

    putJson($users);
}
function read_users(){
    $path = __DIR__.'/users.json';
    //true return associative array
    //file_get_contents return the content of file
    //decode a JSON string into a PHP data structure
    return json_decode(file_get_contents($path), true);

}
function uploadimage($file, $user) {
    if (!isset($file['name']) || !$file['name']) {
        // No file was uploaded
        return;
    }

    $directory = __DIR__ . '/images';
    if (!is_dir($directory)) {
        mkdir($directory);
    }

    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $filename = $user['id'] . '.' . $extension;
    $destination = $directory . '/' . $filename;

    move_uploaded_file($file['tmp_name'], $destination);

    $user['extension'] = $extension;
    // Update user with image extension
    update_user($user, $user['id']);
}








?>