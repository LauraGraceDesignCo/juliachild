<?php require_once '../../core/includes.php';

$p = new Post;
$p->delete();
header("Location: /community.php");
exit();
