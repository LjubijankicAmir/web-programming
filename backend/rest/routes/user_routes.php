<?php

require_once __DIR__ . '/../services/UsersService.class.php';

Flight::set('user_service', new UsersService());


/**
 * @OA\Get(
 *      path="/user", 
 *      tags={"users"},
 *      summary="Get user details",
 *      @OA\Response(
 *          response="200", 
 *          description="User details if user exists"
 *      ),
 *     @OA\Response(
 *         response="500",
 *         description="User not logged in"
 *    )
 * )
 */
Flight::route('GET /user', function () {

    session_start();
    $user = Flight::get('user_service')->get_user($_SESSION['user_id']);
    Flight::json($user);
});

/**
 * @OA\Post(
 *      path="/register", 
 *      tags={"users"},
 *      summary="Register a new user",
 *      @OA\RequestBody(
 *          description="User data",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="username", type="string", description="The username of the user"),
 *              @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 *              @OA\Property(property="password", type="string", format="password", description="The password of the user"),
 *              @OA\Property(property="send_updates", type="boolean", description="Whether the user wants to receive updates")
 *          )
 *      ),
 *      @OA\Response(
 *          response="200", 
 *          description="Connection established"
 *      )
 * )
 */
Flight::route('POST /register', function () {
    $request = Flight::request();

    $username = $request->data->username;
    $email = $request->data->email;
    $password = $request->data->password;
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $send_updates = $request->data->send_updates;

    $user = array(
        'username' => $username,
        'email' => $email,
        'password' => $hashed_password,
        'send_updates' => $send_updates
    );

    Flight::get('user_service')->add_user($user);
});


/**
 * @OA\Post(
 *      path="/login", 
 *      tags={"users"},
 *      summary="Log in a user",
 *      @OA\RequestBody(
 *          description="User login data",
 *          required=true,
 *          @OA\JsonContent(
 *              type="object",
 *              @OA\Property(property="email", type="string", format="email", description="The email of the user"),
 *              @OA\Property(property="password", type="string", format="password", description="The password of the user")
 *          )
 *      ),
 *      @OA\Response(
 *          response="200",
 *          description="Connection established"
 *      )
 * )
 */
Flight::route('POST /login', function () {

    $request = Flight::request();
    $email = $request->data->email;
    $password = $request->data->password;

    $user = array(
        'email' => $email,
        'password' => $password,
    );

    Flight::get('user_service')->login($user);
});

/**
 * @OA\Post(
 *      path="/logout", 
 *      tags={"users"},
 *      summary="Log out a user",
 *      @OA\Response(
 *          response="200", 
 *          description="User logged out successfully"
 *      )
 * )
 */
Flight::route('POST /logout', function () {
    session_start();
    session_destroy();
});

/**
 * @OA\Get(
 *      path="/login_check", 
 *      tags={"users"},
 *      summary="Check if a user is logged in",
 *      @OA\Response(
 *          response="200", 
 *          description="Indicates whether the user is logged in",
 *      )
 * )
 */
Flight::route('GET /login_check', function () {
    session_start();
    $response = array('logged_in' => Flight::get('user_service')->logged_in());
    Flight::json($response);
});
