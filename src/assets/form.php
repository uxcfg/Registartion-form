<?php
    include_once('logging.php');
    $_POST = json_decode(file_get_contents('php://input'), true);

    $firstName = isset($_POST['firstName']) ? trim($_POST['firstName']) : '';
    $lastName = isset($_POST['lastName']) ? trim($_POST['lastName']) : '';
    $email = isset($_POST['email']) ?  trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';
    $repeatPassword = isset($_POST['repeatPassword']) ?trim( $_POST['repeatPassword']) : '';

    $ok = true;
    $validEmail = strpos($email, '@');
    $messages = [];
    $users = [
        1 => [
            "id" => 1,
            "name"=> "Leanne Graham",
            "email"=> "Sincere@april.biz",
        ], 

        [
            "id" => 2,
            "name"=> "Ervin Howell",
            "email"=> "Sincere@april.biz",
        ],

        [
            "id" => 3,
            "name"=> "Clementine Bauch",
            "email"=> "Sincere@april.biz",
        ],

        [
            "id" => 4,
            "name"=> "Leanne Graham",
            "email"=> "Sincere@april.biz",
        ],

        [
            "id" => 4,
            "name"=> "Leanne Graham",
            "email"=> "mrneek69@mail.ru",
        ]
    ];
    $containUser = false;

    foreach ($users as $id => $user) { 
        if($user['email'] == $email) { 
            $containUser = true;
            logger($email);
        }
    };

    if($validEmail === false) { 
        $ok = false;
        $messages[] = 'Invalid email format';
    };

    
    if($containUser) { 
        $ok = false;
        $messages[] = 'Email address already exists';
    }

    if(!isset($password) || empty($password)) {
        $ok = false;
        $messages[] = 'Password is required';
    }
    
    if(!($password === $repeatPassword))  {
        $ok = false;
        $messages[] = 'Passwords do not match';
    };


    if ($ok) {
        $messages[] = 'Successful login!';
    };

    echo json_encode(
        [
            'ok' => $ok,
            'messages' => $messages
        ]
    );

?>
