<?php
session_start();
$mov_ids = $_GET['id'];
$values = $_SESSION['watch_later_id'];
$movie_ids = explode(" ", $values);
$movie_ids[array_search("$mov_ids", $movie_ids)] = "";
$movie = implode(" ", $movie_ids);
$_SESSION['watch_later_id'] = $movie;
echo "<script>alert('Successfully removed')</script>";
echo "<script>location.href='movie_watch_later.php'</script>";
?>