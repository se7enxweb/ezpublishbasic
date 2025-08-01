<?php
// 
// $Id: ezmessage.php,v 1.6 2001/08/27 10:22:53 br Exp $
//
// Definition of eZMessage class
//
// Created on: <05-Jun-2001 13:46:48 bf>
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

//!! eZMessage
//! eZMessage handles messages to eZ publish users.
/*!
  
*/

// include_once( "classes/ezdb.php" );


class eZMessage
{
    /*!
      Constructs a new eZMessage object.
    */
    function __construct( $id=-1 )
    {
        if ( $id != -1 )
        {
            $this->ID = $id;
            $this->get( $this->ID );
        }
    }

    /*!
      Stores or updates a eZMessage object in the database.
    */
    function store()
    {
        $db =& eZDB::globalDatabase();
        $db->begin();

        $subject = $db->escapeString( $this->Subject );
        $description = $db->escapeString( $this->Description );
        $timeStamp =& eZDateTime::timeStamp( true );

        if ( !isset( $this->ID ) )
        {
            $db->lock( "eZMessage_Message" );
            $nextID = $db->nextID( "eZMessage_Message", "ID" );
            $res[] = $db->query( "INSERT INTO eZMessage_Message
                       ( ID,
		                 Subject,
                         Created,
                         Description,
                         FromUserID,
                         ToUserID,
                         IsRead )
                       VALUES
                       ( '$nextID',
		                 '$subject',
                         '$timeStamp',
                         '$description',
                         '$this->FromUserID',
                         '$this->ToUserID',
                         '$this->IsRead' )" );
			$this->ID = $nextID;
        }
        else
        {
            $res[] = $db->query( "UPDATE eZMessage_Message SET
		                 Subject='$subject',
                         Created=Created, 
                         Description='$description',
                         FromUserID='$this->FromUserID',
                         ToUserID='$this->ToUserID',
                         IsRead='$this->IsRead',
                         TimeRead='$timeStamp'

                         WHERE ID='$this->ID'" );
        }

        eZDB::finish( $res, $db );
        return true;
    }

    /*!
      Deletes a eZMessage object from the database.
    */
    function delete()
    {
        $db =& eZDB::globalDatabase();
        $db->begin();

        if ( isset( $this->ID ) )
        {
            $res[] = $db->query( "DELETE FROM eZMessage_Message WHERE ID='$this->ID'" );
        }

        eZDB::finish( $res, $db );
        return true;
    }
    
    /*!
      Fetches the object information from the database.

      True is retuned if successful, false (0) if not.
    */
    function get( $id=-1 )
    {
        $db =& eZDB::globalDatabase();

        $ret = false;
        if ( $id != "" )
        {
            $db->array_query( $author_array, "SELECT * FROM eZMessage_Message WHERE ID='$id'" );
            if( count( $author_array ) == 1 )
            {
                $this->ID =& $author_array[0][$db->fieldName( "ID" )];
                $this->Subject =& $author_array[0][$db->fieldName( "Subject" )];
                $this->Description =& $author_array[0][$db->fieldName( "Description" )];
                $this->Created =& $author_array[0][$db->fieldName( "Created" )];
                $this->FromUserID =& $author_array[0][$db->fieldName( "FromUserID" )];
                $this->ToUserID =& $author_array[0][$db->fieldName( "ToUserID" )];
                $this->IsRead =& $author_array[0][$db->fieldName( "IsRead" )];
                $this->TimeRead =& $author_array[0][$db->fieldName( "TimeRead" )];
                $ret = true;
            }
            elseif( count( $author_array ) == 1 )
            {
                $this->ID = 0;
            }
        }
        return $ret;
    }


    /*!
      Fetches the user id from the database. And returns a array of eZMessage objects.
    */
    function &getAll(  )
    {
        $db =& eZDB::globalDatabase();

        $return_array = array();
        $message_array = array();


        $db->array_query( $message_array, "SELECT ID FROM eZMessage_Message
                                        ORDER By Created" );

        foreach ( $message_array as $message )
        {
            $return_array[] = new eZMessage( $message[0] );
        }
        return $return_array;
    }

    /*!
      Fetches the messages for a user.
    */
    function &messagesToUser( $user )
    {
        $userID = $user->id();
        $db =& eZDB::globalDatabase();

        $return_array = array();
        $message_array = array();

$query = "SELECT DISTINCT eZMessage_Message.ID, eZMessage_MessageDefinition.ToUserID, eZMessage_MessageDefinition.FromUserID
	FROM eZMessage_Message
        LEFT JOIN eZMessage_MessageDefinition ON 
        ( eZMessage_MessageDefinition.MessageID = eZMessage_Message.ID )
        WHERE eZMessage_Message.ToUserID = '$userID' AND eZMessage_MessageDefinition.ToUserID = '$userID'
        ORDER By eZMessage_Message.Created DESC";
   
        $db->array_query( $message_array, $query );

        foreach ( $message_array as $message )
        {
            $return_array[] = new eZMessage( $message[0] );
        }
        return $return_array;
    }

    /*!
      Fetches the messages for a user.
    */
    function &messagesFromUser( $user )
    {
        $userID = $user->id();
        $db =& eZDB::globalDatabase();

        $return_array = array();
        $message_array = array();

$query = "SELECT DISTINCT eZMessage_Message.ID, eZMessage_MessageDefinition.ToUserID, eZMessage_MessageDefinition.FromUserID
	FROM eZMessage_Message 
	LEFT JOIN eZMessage_MessageDefinition ON 
	( eZMessage_MessageDefinition.MessageID = eZMessage_Message.ID )
	WHERE eZMessage_Message.FromUserID = '$userID' AND eZMessage_MessageDefinition.FromUserID = '$userID'
	ORDER  BY eZMessage_Message.Created DESC";
        $db->array_query( $message_array, $query );

        foreach ( $message_array as $message )
        {
            $return_array[] = new eZMessage( $message[0] );
        }
        return $return_array;
    }

function string_tagster($str) { 
    $str = " ".$str." ";
    $str = eregi_replace("([[:space:]{()\"'\[~#=;\&?\_])((ftp|http|https|telnet|news|nttp|nntp|file):\/\/[a-z0-9~#%@\&\(\):;=\?\/\.,_-]+(\\[|\\]|[a-z0-9~#%@\*\&:;.,=\?!'\|\/_\+-])+)", "\\1<A HREF=\"\\2\" TARGET=\"_blank\">\\2</A>", $str);
    $str = eregi_replace("([[:space:]{()\"'\[~#;\&?\_])(www\.[a-z0-9~#%@\&\(\):;=\?!'\/\.,_-]+(\\[|\\]|[a-z0-9~#%@\*\&:;.,=\?!'\|\/_\+-])+)", "\\1<A HREF=\"http://\\2\" TARGET=\"_blank\">\\2</A>", $str);
    $str = eregi_replace("([[:space:]{()\"'\[~#=;\&?\_])(ftp\.[a-z0-9~#%@\&\(\):;=\?!'\/\.,_-]+(\\[|\\]|[a-z0-9~#%@\&:;.,=\?!'\|\/_\+-])+)", "\\1<A HREF=\"ftp://\\2\" TARGET=\"_blank\">\\2</A>", $str);
    $str = eregi_replace("(mail:|[[:space:]{()\"'\[~#;\&?])([_\.0-9a-z-]+@([_\.0-9a-z-]+)+\.[a-z]{2,4})","\\1<A HREF=\"mailto:\\2\">\\2</A>", $str);
    $str = ereg_replace("  ", "&nbsp;&nbsp; ", $str);
    $str = str_replace("\\n", "<BR>", $str);    
    return substr($str, 1);
} 

function format_post2 ($str) {
    $str = htmlentities($str);
    $str = str_replace("&quot;", "\"", $str);
    $str = $this->string_tagster($str);
    $str = ereg_replace("'</A>", "</A>'", $str);
    $str = ereg_replace("'\" TARGET=\"_blank\">", "\" TARGET=\"_blank\">'", $str);
    $str = ereg_replace("  ", " &nbsp; ", $str);
    $str = str_replace("\\t", "&nbsp;&nbsp;&nbsp; ", $str);
    $str = str_replace("\\r", "", $str);
    $str = str_replace("\\n", "<BR>", $str);

    # Return the result
    return $str;
} 
 
function render($str) {
if ( strlen($str) == 0)
return "";
$str =  $this->format_post2($str); 
$str = ereg_replace(chr(13), "<br>", $str);
$str = stripslashes($str);
  return "".$str;
}  
    /*!
      Returns the object id.
    */
    function id()
    {
        return $this->ID;
    }
    
    /*!
      Returns the subject.
    */
    function subject( $html = true )
    {
        if ( $html )
            return htmlspecialchars( $this->Subject );
        return $this->Subject;
    }

    /*!
      Sets the use which the message is from.
    */
    function setFromUser( $user )
    {
        if ( get_class( $user ) == "ezuser" )
        {
            $this->FromUserID = $user->id();
        }
    }

    /*!
      Returns the from user as an eZUser object.
    */
    function fromUser()
    {
        return new eZUser( $this->FromUserID );
    }
     

    /*!
      Returns the to user as an eZUser object.
    */
    function &toUser()
    {
        $ret = new eZUser( $this->ToUserID );
        return $ret;
    }

    /*!
      Returns true if the message is read.
    */
    function isRead()
    {
        if ( $this->IsRead == 1 )
            return true;
        else
            return false;
    }

    /*!
      Sets the message to be read/unread.
      
    */
    function setIsRead( $isRead )
    {
        if ( $isRead == true )
            $this->IsRead = 1;
        else
            $this->IsRead = 0;
    }
     
    
    /*!
      Sets the use which the message is to.
    */
    function setToUser( $user )
    {
        if ( get_class( $user ) == "ezuser" )
        {
            $this->ToUserID = $user->id();
        }
    }

    /*!
      Returns the message creation time as a eZDateTime object.
    */
    function &created()
    {
        $dateTime = new eZDateTime();    
        $dateTime->setTimeStamp( $this->Created );

        return $dateTime;
    }
    
    /*!
      Returns the message read time as a eZDateTime object.
    */
    function &TimeRead()
    {
        $dateTime = new eZDateTime();    
        $dateTime->setTimeStamp( $this->TimeRead );

        return $dateTime;
    }
    
    /*!
      Returns the description.
    */
    function description( )
    {
       return $this->Description;
    }

    /*!
      Sets the subject.
    */
    function setSubject( $value )
    {
       $this->Subject = $value;
    }
    
    /*!
      Sets the description.
    */
    function setDescription( $value )
    {
       $this->Description = $value;
    }
    
    var $ID;
    var $FromUserID;
    var $ToUserID;
    var $Created;
    var $Subject;
    var $Description;
    var $IsRead;
}

?>
