<?php
session_start();
$db=new PDO("mysql:host=127.0.0.1;dbname=victoris", 'root', 'root');
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
$db->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
$db->exec('set names utf8');
