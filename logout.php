<?php

    session_start(); //memulai session
    session_destroy(); //menghapus semua data session
    header("location:login.php"); //mengalihkan ke halaman login

?>