<?php
include "config/koneksi.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Kasirku</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="favicon.ico">
  <link rel="icon" href="icon.ico" type="image/ico">
  <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css" />
  
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">


  <style>
    .btn-group-xs>.btn,
    .btn-xs {
      padding: .25rem .4rem;
      font-size: .875rem;
      line-height: .5;
      border-radius: .2rem;
    }

    .card {
      border: none;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgb(17 26 104 / 10%);
    }

    .card-header {
      border-radius: 15px 15px 0px 0px !important;
    }

    .form-control {
      border-radius: 15px;
    }

    .btn {
      border-radius: 15px;
    }

    button.buttons-html5 {
      padding: .25rem .4rem !important;
      font-size: .875rem !important;
      line-height: .5 !important;
    }
  </style>
</head>

<body>
  <div class="bg-success text-center py-2 shadow-sm sticky-top d-none d-md-block">
    <a class="navbar-brand text-white"><i class="fa fa-shopping-cart mr-1"></i><b>
       <h3>TOKO KONCO TANI</h3></b></a>
  </div>
  <br>