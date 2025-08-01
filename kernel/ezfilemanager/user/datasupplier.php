<?php
//
// $Id: datasupplier.php 7047 2001-09-06 11:16:40Z jhe $
//
// Created on: <23-Oct-2000 17:53:46 bf>
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


// include_once( "ezuser/classes/ezuser.php" );
// include_once( "classes/eztime.php" );
// include_once( "classes/ezlocale.php" );
// include_once( "classes/ezhttptool.php" );

$ini =& INIFile::globalINI();
$GlobalSectionID = $ini->read_var( "eZFileManagerMain", "DefaultSection" );

switch ( $url_array[2] )
{
    case "new" :        
    {
        $Action = "New";
        $NewFile = true;
        $FolderID = false;
        include( "kernel/ezfilemanager/user/fileupload.php" );
    }
    break;

    case "insert" :        
    {
        $Action = "Insert";
        include( "kernel/ezfilemanager/user/fileupload.php" );
    }
    break;

    case "edit" :
    {
        $FileID = $url_array[3];
        $Action = "Edit";
        include( "kernel/ezfilemanager/user/fileupload.php" );
    }
    break;
    
    case "update" :
    {
        $FileID = $url_array[3];
        $Action = "Update";
        include( "kernel/ezfilemanager/user/fileupload.php" );
    }
    break;
    
    case "fileview" :
    {
        $FileID = $url_array[3];
        include( "kernel/ezfilemanager/user/fileview.php" );
    }
    break;
    
    case "download" :
    {
        $FileID = $url_array[3];
        $FileNamePassed = $url_array[4];
        include( "kernel/ezfilemanager/user/filedownload.php" );
    }
    break;
    
    case "list" :
    {
        $FolderID = $url_array[3];
        if ( !isset( $FolderID ) || $FolderID == "" )
            $FolderID = 0;
        $Offset = $url_array[4];
        if ( !isset( $Offset ) || $Offset == "" )
            $Offset = 0;
        include( "kernel/ezfilemanager/user/filelist.php" );
    }
    break;

	case "import" :
    {
        include( "kernel/ezfilemanager/user/filelist.php" );
    }
    break;

    case "folder" :
    {
        switch ( $url_array[3] )
        {
           
            case "new" :
            {
                $parentID = $url_array[4];
                $Action = "New";
                $NewFolder = true;
                $FolderID = false;
                include( "kernel/ezfilemanager/user/folderedit.php" );
            }
            break;
            case "delete" :
            {
                $FolderID = $url_array[4];
                $Action = "Delete";
                include( "kernel/ezfilemanager/user/folderedit.php" );
            }
            break;
            
            case "insert" :
            {
                $Action = "Insert";
                include( "kernel/ezfilemanager/user/folderedit.php" );
            }
            break;

            case "edit" :
            {
                $FolderID = $url_array[4];
                $Action = "Edit";
                include( "kernel/ezfilemanager/user/folderedit.php" );
            }
            break;

            case "update" :
            {
                $FolderID = $url_array[4];
                $Action = "Update";
                include( "kernel/ezfilemanager/user/folderedit.php" );
            }
            break;

        }
    }
    break;

    case "browse":
    {
        $FolderID = $url_array[3];
        include( "kernel/ezfilemanager/admin/browse.php" );
    }
    break;

    case "search":
    {
        if ( $url_array[3] == "parent" )
        {
            $SearchText = urldecode( $url_array[4] );
            $Offset = $url_array[5];
        }
        
        include( "kernel/ezfilemanager/user/search.php" );
    }
    break;
    
    
    default:
    {
        eZHTTPTool::header( "Location: /error/404/" );
        exit();
    }
}

?>