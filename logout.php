<?php
require 'configs/connection.php';
session_write_close();
header('Location: login.php');