<?php
// 
// $Id: menubox.php 6363 2001-08-02 13:09:42Z jhe $
//
// Created on: <18-April-2001 13:00:00 th>
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

$ini =& $GLOBALS["GlobalSiteIni"];

$Language = $ini->read_var( "eZTradeMain", "Language" );
    
// include_once( "classes/eztemplate.php" );
// include_once( "classes/ezdb.php" );
// include_once( "ezuser/classes/ezobjectpermission.php" );

$t = new eZTemplate( "kernel/eztrade/user/" . $ini->read_var( "eZTradeMain", "TemplateDir" ),
                     "kernel/eztrade/user/intl", $Language, "menubox.php" );

$t->setAllStrings();

$t->set_file( "menu_box_tpl", "menubox.tpl" );

$t->set_var( "sitedesign", $GlobalSiteDesign );

$t->pparse( "output", "menu_box_tpl" );
		
?>
