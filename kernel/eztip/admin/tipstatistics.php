<?php
// 
// $Id: tipstatistics.php,v 1.15 2001/10/12 15:58:37 br Exp $
//
// Created on: <26-Nov-2000 11:47:03 bf>
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
// include_once( "classes/ezlocale.php" );
// include_once( "classes/ezimagefile.php" );
// include_once( "classes/ezlog.php" );

// include_once( "classes/ezdatetime.php" );

// include_once( "eztip/classes/eztip.php" );
// include_once( "eztip/classes/eztipcategory.php" );


$ini =& INIFile::globalINI();

$Language = $ini->read_var( "eZTipMain", "Language" );
$ImageDir = $ini->read_var( "eZTipMain", "ImageDir" );

$t = new eZTemplate( "kernel/eztip/admin/" . $ini->read_var( "eZTipMain", "AdminTemplateDir" ),
                     "kernel/eztip/admin/intl/", $Language, "tipstatistics.php" );

$t->setAllStrings();

$t->set_file( array(
    "tip_edit_page_tpl" => "tipstatistics.tpl"
    ) );

$t->set_block( "tip_edit_page_tpl", "image_tpl", "image" );
$t->set_block( "tip_edit_page_tpl", "html_item_tpl", "html_item" );


$tip = new eZTip( $TipID );

$t->set_var( "tip_title", $tip->name() );
$t->set_var( "tip_description", $tip->description() );
$t->set_var( "tip_url", $tip->url() );
$t->set_var( "tip_id", $tip->id() );

$clickCount = $tip->clickCount();
$t->set_var( "tip_click_count", $clickCount );

$t->set_var( "tip_view_count", $tip->viewCount() );

$view_count = $tip->viewCount();

if ( is_numeric( $view_count ) and $view_count != 0 )
{
    $value = ( $tip->clickCount() / $view_count ) * 100;
    $t->set_var( "tip_click_percent", round( $value, 2 ) );
}
else
{
    $t->set_var( "tip_click_percent", ( 0 ) );
}

if ( $tip->isActive() == true )
{
    $t->set_var( "tip_is_active", "checked" );
}
else
{
    $t->set_var( "tip_is_active", "" );
}

if ( $tip->useHTML() )
{
    $t->set_var( "image", "" );
    
    $t->set_var( "html_banner", $tip->htmlBanner() );
    $t->parse( "html_item", "html_item_tpl" );

}    
else
{
    $image = $tip->image();
    
    if ( $image )
    {
        $t->set_var( "image_src",  $image->filePath() );
        $t->set_var( "image_alt", $image->caption() );
        $t->set_var( "image_width", $image->width() );
        $t->set_var( "image_height", $image->height() );
        $t->set_var( "image_file_name", $image->originalFileName() );

        $t->set_var( "html_item", "" );

        $t->parse( "image", "image_tpl" );
    }
}

$t->pparse( "output", "tip_edit_page_tpl" );

?>