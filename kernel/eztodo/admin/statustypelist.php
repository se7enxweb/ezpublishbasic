<?php
// 
// $Id: statustypelist.php 6968 2001-09-05 11:53:39Z jhe $
//
// Created on: <18-Oct-2000 15:04:39 bf>
//
// This source file is part of eZ publish, publishing software.
//
// Copyright (C) 1999-2001 eZ Systems.  All rights reserved.
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, US
//


// include_once( "classes/INIFile.php" );
// include_once( "classes/eztemplate.php" );

// include_once( "ezuser/classes/ezuser.php" );
// include_once( "ezuser/classes/ezusergroup.php" );
// include_once( "ezuser/classes/ezmodule.php" );
// include_once( "ezuser/classes/ezpermission.php" );

// include_once( "eztodo/classes/eztodo.php" );
// include_once( "eztodo/classes/ezstatus.php" );

$ini =& INIFile::globalINI();
$Language = $ini->read_var( "eZTodoMain", "Language" );


$t = new eZTemplate( "kernel/eztodo/admin/" . $ini->read_var( "eZTodoMain", "AdminTemplateDir" ),
                     "kernel/eztodo/admin/intl", $Language, "statustypelist.php" );
$t->setAllStrings();

$t->set_file( array(
    "status_type_page" =>  "statustypelist.tpl"
    ) );

$t->set_block( "status_type_page", "status_item_tpl", "status_item" );

$t->set_var( "site_style", $SiteDesign );

$category_type = new eZStatus();
$category_type_array = $category_type->getAll();

$i=0;
foreach ( $category_type_array as $categoryItem )
{
    if ( ( $i %2 ) == 0 )
        $t->set_var( "td_class", "bglight" );
    else
        $t->set_var( "td_class", "bgdark" );

    $t->set_var( "status_type_id", $categoryItem->id() );
    $t->set_var( "status_type_name", $categoryItem->name() );

    $i++;;
    $t->parse( "status_item", "status_item_tpl", true );
} 

$t->pparse( "output", "status_type_page" );
    
?>