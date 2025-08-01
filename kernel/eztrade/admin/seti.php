<?php
// 
// $Id: seti.php,v 0.1 2004/01/10 
//
// Created on: <10-Jan-2004 Bob Sims>
//
// This source file integrates Stone Edge Order Manager
// with eZ publish v2.2 publishing software.
//
// Copyright (C) 2004 Bob Sims.  All rights reserved.

include_once( "classes/INIFile.php" );
include_once( "classes/ezhttptool.php" );

$ini =& INIFile::globalINI();
$wwwDir = $ini->WWWDir;
$indexFile = $ini->Index;

$UserName = $ini->read_var( "eZTradeMain", "SetiUser" );
$Password = $ini->read_var( "eZTradeMain", "SetiPassword" );
$Code = $ini->read_var( "eZTradeMain", "Code" );
$AdminSite = $ini->read_var( "site", "AdminSiteURL" );

if( ($_SERVER['HTTP_PORT'] != 443) || ($_SERVER['HTTPS'] != 'on') ) 
{ 
// page is not secure, redirect
eZHTTPTool::header( "Location: https://" . $AdminSite . "/trade/seti/" );
} 


?>