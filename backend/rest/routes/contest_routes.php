<?php

require_once __DIR__ . '/../services/ContestsService.class.php';

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
    $contest = Flight::get('contest_service')->get_contest_details($id);
    Flight::json($contest);
});