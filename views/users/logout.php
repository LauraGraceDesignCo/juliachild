<?php session_start();
session_destroy();
header("Location: /");

//here you logged them out and sent them back to the homepage
