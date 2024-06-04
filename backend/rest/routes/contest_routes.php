<?php

require_once __DIR__ . '/../services/ContestsService.class.php';
require_once __DIR__ . '/../middleware.php';

Flight::set('contest_service', new ContestsService());


/**
 * @OA\Get(
 *      path="/contests", 
 *      tags={"contests"},
 *      summary="Get all contests",
 *      @OA\Response(
 *          response="200", 
 *          description="List of contests")
 * )
 */
Flight::route('GET /contests', function () {
    $contests = Flight::get('contest_service')->get_contests();
    Flight::json($contests);
}); 


/**
 * @OA\Get(
 *      path="/contest-details/{contest_id}", 
 *      tags={"contests"},
 *      summary="Get contest details",
 *      @OA\Response(
 *          response="200", 
 *          description="Contest details if contest exists"
 *      ),
 *      @OA\Parameter(@OA\Schema(type="integer"), in="path", name="contest_id", description="Contest id")
 * )
 */
Flight::route('GET /contest-details/@id', function ($id) {
    authMiddleware();
    $contest = Flight::get('contest_service')->get_contest_details($id);
    Flight::json($contest);
});


/**
 * @OA\Get(
 *      path="/categories", 
 *      tags={"contests"},
 *      summary="Get filtered contests",
 *      @OA\Response(
 *          response="200", 
 *          description="List of filtered contests"),
 *      @OA\Parameter(@OA\Schema(type="string"), in="query", name="name", description="Contest name"),
 *      @OA\Parameter(@OA\Schema(type="string"), in="query", name="category", description="Contest category")
 * )
 */
Flight::route('GET /categories', function () {
    $name = !empty(Flight::request()->query['name']) ? Flight::request()->query['name'] : null;
    $category = !empty(Flight::request()->query['category']) ? Flight::request()->query['category'] : null;
    $price = !empty(Flight::request()->query['price']) ? Flight::request()->query['price'] : null;

    $contests = Flight::get('contest_service')->get_filtered_contests($name, $category, $price);
    Flight::json($contests);
});
