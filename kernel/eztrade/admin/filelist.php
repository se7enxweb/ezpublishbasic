<?php
// 
// $Id: filelist.php,v 1.9 2001/08/30 07:55:56 bf Exp $
//
// Created on: <21-Dec-2000 17:43:40 bf>
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

include_once( "classes/INIFile.php" );
include_once( "classes/eztemplate.php" );
include_once( "classes/ezlocale.php" );
include_once( "classes/ezcurrency.php" );

$ini =& INIFile::globalINI();

$Language = $ini->read_var( "eZTradeMain", "Language" );
$SiteStyle = $ini->read_var( "site", "SiteStyle" );

include_once( "eztrade/classes/ezproductcategory.php" );
include_once( "eztrade/classes/ezproduct.php" );


$t = new eZTemplate( "eztrade/admin/" . $ini->read_var( "eZTradeMain", "AdminTemplateDir" ),
                     "eztrade/admin/intl/", $Language, "filelist.php" );

$t->setAllStrings();

$t->set_file(  "file_list_page_tpl", "filelist.tpl" );

$t->set_block( "file_list_page_tpl", "no_files_tpl", "no_files" );
$t->set_block( "file_list_page_tpl", "file_list_tpl", "file_list" );
$t->set_block( "file_list_tpl", "file_tpl", "file" );

$product = new eZProduct( $ProductID );

$session =& eZSession::globalSession();
$session->setVariable( "FileListReturnTo", $REQUEST_URI );
$session->setVariable( "NameInBrowse", $product->name() );

if ( isSet ( $AddFiles ) )
{
    if ( count ( $FileArrayID ) > 0 )
    {
        foreach( $FileArrayID as $fileID )
        {
            $file = new eZVirtualFile( $fileID );
			if ( $DescriptionArray[$fileID] != $file->description() );
				$file->setDescription( $DescriptionArray[$fileID] );
			$file->store();
            $product->addFile( $file );
        }
    }
}

$t->set_var( "product_name", $product->name() );

$t->set_var( "site_style", $SiteStyle );

$files =& $product->files();
if ( count( $files ) == 0 )
{
    $t->set_var( "file_list", "" );
    $t->parse( "no_files", "no_files_tpl", true );
}
else
{
    $t->set_var( "no_files", "" );

    $i=0;
    $t->set_var( "file", "" );
    foreach ( $files as $file )
    {
        if ( ( $i % 2 ) == 0 )
        {
            $t->set_var( "td_class", "bglight" );
        }
        else
        {
            $t->set_var( "td_class", "bgdark" );
        }

        $t->set_var( "file_number", $i + 1 );
        $t->set_var( "file_id", $file->id() );
        $t->set_var( "file_name", $file->name() );
        $t->set_var( "file_description", $file->description() );

        $t->parse( "file", "file_tpl", true );

        $i++;
    }

    $t->parse( "file_list", "file_list_tpl", true );
}


$t->set_var( "product_id", $product->id() );

$t->pparse( "output", "file_list_page_tpl" );

?>
