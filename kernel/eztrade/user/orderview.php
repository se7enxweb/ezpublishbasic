<?php
// 
// $Id: orderview.php 8850 2002-01-02 21:42:12Z kaid $
//
// Created on: <30-Sep-2000 13:03:13 bf>
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

if ( isset( $Cancel ) )
{
    eZHTTPTool::header( "Location: /trade/orderlist/" );
    exit();
}

// include_once( "classes/INIFile.php" );
// include_once( "classes/eztemplate.php" );
// include_once( "classes/ezlocale.php" );
// include_once( "classes/ezcurrency.php" );
// include_once( "ezcontact/classes/ezperson.php" );
// include_once( "ezcontact/classes/ezcompany.php" );
// include_once( "ezuser/classes/ezuser.php" );


$ini =& INIFile::globalINI();
$Language = $ini->read_var( "eZTradeMain", "Language" );

$TinyImageWidth = $ini->read_var( "eZImageCatalogueMain", "TinyImageWidth" );
$TinyImageHeight = $ini->read_var( "eZImageCatalogueMain", "TinyImageHeight" );

$ShowPriceGroups = $ini->read_var( "eZTradeMain", "PriceGroupsEnabled" ) == "true";
$upscheck = $ini->read_var( "eZTradeMain", "UPSXMLShipping" )==enabled?1:0;
$uspscheck = $ini->read_var( "eZTradeMain", "USPSXMLShipping" )==enabled?1:0;
if(($upscheck==0)&&($uspscheck==0))
$checkups=0;
else
$checkups=1;

$languageINI = new INIFIle( "kernel/eztrade/user/intl/" . $Language . "/orderview.php.ini", false );


// include_once( "eztrade/classes/ezproductcategory.php" );
// include_once( "eztrade/classes/ezproduct.php" );
// include_once( "eztrade/classes/ezorder.php" );
// include_once( "eztrade/classes/ezcheckout.php" );
// include_once( "eztrade/classes/ezpricegroup.php" );

// include_once( "eztrade/classes/ezorderstatustype.php" );

$t = new eZTemplate( "kernel/eztrade/user/" . $ini->read_var( "eZTradeMain", "TemplateDir" ),
                     "kernel/eztrade/user/intl/", $Language, "orderview.php" );

$t->setAllStrings();

$t->set_file( "order_edit_tpl", "orderview.tpl" );

$t->set_block( "order_edit_tpl", "visa_tpl", "visa" );
$t->set_block( "order_edit_tpl", "mastercard_tpl", "mastercard" );
$t->set_block( "order_edit_tpl", "cod_tpl", "cod" );
$t->set_block( "order_edit_tpl", "invoice_tpl", "invoice" );

$t->set_block( "order_edit_tpl", "order_item_list_tpl", "order_item_list" );
$t->set_block( "order_item_list_tpl", "order_item_tpl", "order_item" );

//$t->set_block( "order_edit_tpl", "order_status_option_tpl", "order_status_option" );
$t->set_block( "order_item_list_tpl", "order_status_history_tpl", "order_status_history" );

$t->set_block( "order_item_tpl", "order_item_option_tpl", "order_item_option" );

$order = new eZOrder( $OrderID );

$user = eZUser::currentUser();

if ( !$user )
{
    eZHTTPTool::header( "Location: /error/403/" );
    exit();

}
    

// get the customer
if ( !$order->isOwner( eZUser::currentUser() ) )
{
    eZHTTPTool::header( "Location: /error/403" );
    exit();
}
else
$localUser = $order->user();

if ( $localUser )
{
    if ( $order->personID() == 0 && $order->companyID() == 0 )
    {
        $t->set_var( "customer_email", $localUser->email() );    
        $t->set_var( "customer_first_name", $localUser->firstName() );
        $t->set_var( "customer_last_name", $localUser->lastName() );
    }
    else
    {
        if ( $order->personID() > 0 )
        {
            $customer = new eZPerson( $order->personID() );
            $t->set_var( "customer_first_name", $customer->firstName() );
            $t->set_var( "customer_last_name", $customer->lastName() );
        }
        else
        {
            $customer = new eZCompany( $order->companyID() );
            $t->set_var( "customer_first_name", $customer->name() );
            $t->set_var( "customer_last_name", "" );
        }
        $emailList = $customer->emailAddress();
        $t->set_var( "customer_email", $emailList[0] );
    }

    // print out the addresses
    $shippingAddress =& $order->shippingAddress();

    $t->set_var( "shipping_street1", $shippingAddress->street1() );
    $t->set_var( "shipping_street2", $shippingAddress->street2() );
    $t->set_var( "shipping_zip", $shippingAddress->zip() );
    $t->set_var( "shipping_place", $shippingAddress->place() );

    if ( $order->personID() == 0 && $order->companyID() == 0 )
    {    
        $shippingUser = $order->shippingUser();

        if ( $shippingUser )
        {
            $t->set_var( "shipping_first_name", $shippingUser->firstName() );
            $t->set_var( "shipping_last_name", $shippingUser->lastName() );   
        }
    }
    else
    {
        if ( $order->personID() > 0 )
        {
            $customer = new eZPerson( $order->personID() );
            $t->set_var( "shipping_first_name", $customer->firstName() );
            $t->set_var( "shipping_last_name", $customer->lastName() );
        }
        else
        {
            $customer = new eZCompany( $order->companyID() );
            $t->set_var( "shipping_first_name", $customer->name() );
            $t->set_var( "shipping_last_name", "" );
        }
    }

    $region= $shippingAddress->region();
    if ( is_object( $region ) )
    {
        $t->set_var( "shipping_region", $region->name() );
    }
    else
    {
        $t->set_var( "shipping_region", "" );
    }

    $country = $shippingAddress->country();
    if ( is_object( $country ) )
    {
        $t->set_var( "shipping_country", $country->name() );
    }
    else
    {
        $t->set_var( "shipping_country", "" );
    }
    $billingAddress =& $order->billingAddress();

    $t->set_var( "billing_street1", $billingAddress->street1() );
    $t->set_var( "billing_street2", $billingAddress->street2() );
    $t->set_var( "billing_zip", $billingAddress->zip() );
    $t->set_var( "billing_place", $billingAddress->place() );

    $PriceGroup = eZPriceGroup::correctPriceGroup( $localUser->groups( false ), true );

    $region = $billingAddress->region();
    if ( is_object( $region ) )
    {
        $t->set_var( "billing_region", $region->name() );
    }
    else
    {
        $t->set_var( "billing_region", "" );
    }

    $country = $billingAddress->country();
    if ( is_object( $country ) )
    {
        $t->set_var( "billing_country", $country->name() );
    }
    else
    {
        $t->set_var( "billing_country", "" );
    }
}

if( !isset( $OrderType ) )
    $OrderType = false;

// fetch the order items
$items = $order->items( $OrderType );
$locale = new eZLocale( $Language );
$currency = new eZCurrency();

$i = 0;
$sum = 0.0;
$t->set_var( "product_image_caption", "" );


foreach ( $items as $item )
{
    $product =& $item->product();

    $image = $product->thumbnailImage();
    
    if ( $image )
    {
        $thumbnail =& $image->requestImageVariation( $TinyImageWidth, $TinyImageHeight );
        
        $t->set_var( "product_image_path", "/" . $thumbnail->imagePath() );
        $t->set_var( "product_image_width", $thumbnail->width() );
        $t->set_var( "product_image_height", $thumbnail->height() );
        $t->set_var( "product_image_caption", $image->caption() );
    }

    $price = $item->price() * $item->count();

    $currency->setValue( $price );

    $sum += $price;
    $t->set_var( "product_name", $product->name() );
    $t->set_var( "product_id", $product->id() );
    $t->set_var( "product_number", $product->productNumber() );
    $t->set_var( "product_price", $locale->format( $currency ) );

    $t->set_var( "order_item_count", $item->count() );
    
    if ( ( $i % 2 ) == 0 )
        $t->set_var( "td_class", "bglight" );
    else
        $t->set_var( "td_class", "bgdark" );

    $optionValues =& $item->optionValues();

    $t->set_var( "order_item_option", "" );
    foreach ( $optionValues as $optionValue )
    {
        $t->set_var( "option_name", $optionValue->optionName() );
        $t->set_var( "option_value", $optionValue->valueName() );
            
        $t->parse( "order_item_option", "order_item_option_tpl", true );
    }
    $t->parse( "order_item", "order_item_tpl", true );
        
    $i++;
}
$shippingCost = $order->shippingCharge();

$currency->setValue( $shippingCost );
$t->set_var( "shipping_cost", $locale->format( $currency ) );

//print_r($order); print_r( $order->shippingVAT() ); exit();

$totalVAT = $order->totalVAT();
$currency->setValue( $totalVAT );
$t->set_var( "vat_cost", $locale->format( $currency ) );
if ( $order->isVATInc() )
{
	$totalVAT = $order->totalVAT();
	if ( $order->shippingVAT() > 0 )
		$totalVAT = $totalVAT + $order->shippingVAT();
	$currency->setValue( $totalVAT );
	$t->set_var( "vat_cost", $locale->format( $currency ) );
    $sum = $order->totalPriceIncVAT() + $shippingCost + $order->shippingVAT();
    $currency->setValue( $sum );
    $t->set_var( "order_sum", $locale->format( $currency ) );
}
else
{
	$currency->setValue( 0 );
	$t->set_var( "vat_cost", $locale->format( $currency ) );
    $sum += $shippingCost;
    $currency->setValue( $sum );
    $t->set_var( "order_sum", $locale->format( $currency ) );
}

//$statusType = new eZOrderStatusType();
/*
$statusTypeArray = $statusType->getAll();
foreach ( $statusTypeArray as $status )
{
    $statusName = preg_replace( "#intl-#", "", $status->name() );
    $statusName =  $languageINI->read_var( "strings", $statusName );
    
    $t->set_var( "option_name", $statusName );
    $t->set_var( "option_id", $status->id() );
    $t->parse( "order_status_option", "order_status_option_tpl", true );
}
*/

$historyArray = $order->statusHistory();
/*
echo "<pre>";
print_r($historyArray);
echo "</pre>";
exit();
*/
$j=0;
foreach ( $historyArray as $status )
{
    if ( ( $j % 2 ) == 0 )
        $t->set_var( "td_class", "bglight" );
    else
        $t->set_var( "td_class", "bgdark" );

    $admin =  $status->admin();
    
    $statusType = $status->type();

    $statusName = preg_replace( "#intl-#", "", $statusType->name() );
//    $statusName =  $languageINI->read_var( "strings", $statusName );
    
    $t->set_var( "status_date", $locale->format( $status->altered() ) );
    $t->set_var( "status_name", $statusName );
    $t->set_var( "status_comment", $status->comment() );
    $t->set_var( "admin_login", $admin->login() );
    $t->parse( "order_status_history", "order_status_history_tpl", true );
    $j++;
}



$checkout = new eZCheckout();
$instance =& $checkout->instance();
$paymentMethod = $instance->paymentName( $order->paymentMethod() );

$t->set_var( "payment_method", $paymentMethod );

$shippingType = $order->shippingType();

$t->set_var( "shipping_method", "" );


 if (( $shippingType )&&($checkups==1))
        {

$getnames =array ( 

	'01' => 'UPS Next Day Air',

       	'02' => 'UPS 2nd Day Air',

	'03' => 'UPS Ground',

	'07' => 'UPS Worldwide Express',

	'08' => 'UPS Worldwide Expedited',

	'11' => 'UPS Standard',

	'12' => 'UPS 3 Day Select',

	'13' => 'UPS Next Day Air Saver',

	'14' => 'UPS Next Day Air Early A.M.',

	'54' => 'UPS Worldwide Express Plus',

	'59' => 'UPS 2nd Day Air A.M.',

	'64' => '',

	'65' => 'UPS Express Saver',

   );
if (!$getnames["$shippingType"])
$service_name=$shippingType;
else
$service_name=$getnames["$shippingType"];

 $t->set_var( "shipping_method", $service_name );
}

if (( $shippingType )&&($checkups!=1))
{    
    $t->set_var( "shipping_method", $shippingType->name() );
}

$t->set_var( "order_id", $order->id() );

$t->parse( "order_item_list", "order_item_list_tpl" );

$t->pparse( "output", "order_edit_tpl" );

?>