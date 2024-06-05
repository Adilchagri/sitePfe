<?php
// Connect to database
require("connexion.php");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: ". mysqli_connect_error();
  exit();
}

// Calculate statistics for creator with ID 1
$creator_id = 1;
$total_demands = mysqli_num_rows(mysqli_query($con, "SELECT * FROM demande WHERE id_Service IN (SELECT id_Services FROM services WHERE id_CreateurSRV = $creator_id)"));
$total_posts = mysqli_num_rows(mysqli_query($con, "SELECT * FROM commentaire WHERE id_Service IN (SELECT id_Services FROM services WHERE id_CreateurSRV = $creator_id)"));
$total_comments = $total_posts;

$demand_percentage = calculate_percentage($total_demands, 30);
$post_percentage = calculate_percentage($total_posts, 30);
$comment_percentage = calculate_percentage($total_comments, 30);

$avg_demand_response_time = calculate_avg_response_time($con, "demande", $creator_id);
$avg_demand_response_time_percentage = calculate_percentage($avg_demand_response_time, 30);

function calculate_percentage($value, $days) {
  // calculate the percentage change over the past $days days
  // return the percentage as a string (e.g. "10.00%")
  // TO DO: implement this function
}

function calculate_avg_response_time($con, $table, $creator_id) {
  // calculate the average response time for the past $days days
  // return the average response time as a string (e.g. "30 minutes")
  // TO DO: implement this function
}

// Store statistics in an array
$statistics = array(
  "total_demands" => $total_demands,
  "total_posts" => $total_posts,
  "total_comments" => $total_comments,
  "demand_percentage" => $demand_percentage,
  "post_percentage" => $post_percentage,
  "comment_percentage" => $comment_percentage,
  "avg_demand_response_time" => $avg_demand_response_time,
  "avg_demand_response_time_percentage" => $avg_demand_response_time_percentage
);

?>