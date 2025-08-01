<?php
//
// $Id: productview.php 9895 2004-04-06 11:08:44Z br $
//
// Created on: <24-Sep-2000 12:20:32 bf>
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
// include_once( "classes/ezcurrency.php" );
// include_once( "classes/eztexttool.php" );

// include_once( "eztrade/classes/ezproduct.php" );
// include_once( "eztrade/classes/ezproductcategory.php" );
// include_once( "eztrade/classes/ezoption.php" );
// include_once( "eztrade/classes/ezpricegroup.php" );
// include_once( "eztrade/classes/ezproductcurrency.php" );
// include_once( "eztrade/classes/ezproductpermission.php" );
// include_once( "eztrade/classes/ezproductpricerange.php" );
// include_once( "ezuser/classes/ezuser.php" );

// include_once( "classes/ezmodulelink.php" );
// include_once( "classes/ezlinksection.php" );
// include_once( "classes/ezlinkitem.php" );

$ini =& INIFile::globalINI();

$Language = $ini->read_var( "eZTradeMain", "Language" );
$ShowPriceGroups = $ini->read_var( "eZTradeMain", "PriceGroupsEnabled" ) == "true";
$RequireUserLogin = $ini->read_var( "eZTradeMain", "RequireUserLogin" ) == "true";
$SimpleOptionHeaders = $ini->read_var( "eZTradeMain", "SimpleOptionHeaders" ) == "true";
$ShowQuantity = $ini->read_var( "eZTradeMain", "ShowQuantity" ) == "true";
$ShowNamedQuantity = $ini->read_var( "eZTradeMain", "ShowNamedQuantity" ) == "true";
$RequireQuantity = $ini->read_var( "eZTradeMain", "RequireQuantity" ) == "true" ;
$ShowOptionQuantity = $ini->read_var( "eZTradeMain", "ShowOptionQuantity" ) == "true";
$PurchaseProduct = $ini->read_var( "eZTradeMain", "PurchaseProduct" ) == "true";
$PricesIncludeVAT = $ini->read_var( "eZTradeMain", "PricesIncludeVAT" ) == "enabled" ? true : false;
$locale = new eZLocale( $Language );

$AdminSiteURL = $ini->read_var( "site", "AdminSiteURL" );
$SiteURL = $ini->read_var( "site", "SiteURL" );

if ( isset( $CategoryID ) )
    $categoryID = $CategoryID;
else
    $categoryID = 0;

$product = new eZProduct();

if ( isset( $ProductID ) && !$product->get( $ProductID, $categoryID ) )
{
    if ( $product->get( $ProductID ) )
    {
        eZHTTPTool::header( "Location: /error/403/" );
    }
    else
    {
        eZHTTPTool::header( "Location: /error/404/" );
    }
    exit();
}

if ( !isset( $CategoryID ) )
{
    $category = $product->categoryDefinition();
}
else
{
    $category = new eZProductCategory();
    $category->get( $CategoryID );
}

$CapitalizeHeadlines = $ini->read_var( "eZArticleMain", "CapitalizeHeadlines" );

$MainImageWidth = $ini->read_var( "eZTradeMain", "MainImageWidth" );
$MainImageHeight = $ini->read_var( "eZTradeMain", "MainImageHeight" );

$SmallImageWidth = $ini->read_var( "eZTradeMain", "SmallImageWidth" );
$SmallImageHeight = $ini->read_var( "eZTradeMain", "SmallImageHeight" );


// sections
// include_once( "ezsitemanager/classes/ezsection.php" );

$GlobalSectionID = eZProductCategory::sectionIDStatic( $category->id() );

// init the section
$sectionObject =& eZSection::globalSectionObject( $GlobalSectionID );
$sectionObject->setOverrideVariables();


$user =& eZUser::currentUser();


if ( !eZObjectPermission::hasPermission( $category->id(), "trade_category", "r", $user ) )
{
  eZHTTPTool::header( "Location: /trade/productlist/0/" );
  exit();
}

if ( !isset( $IntlDir ) )
    $IntlDir = "kernel/eztrade/user/intl";
if ( !isset( $IniFile ) )
    $IniFile = "productview.php";

$t = new eZTemplate( "kernel/eztrade/user/" . $ini->read_var( "eZTradeMain", "TemplateDir" ),
                     $IntlDir, $Language, $IniFile );

$t->setAllStrings();

if ( !isset( $productview ) )
    $productview = "productview.tpl";

if ( isset( $template_array ) and isset( $variable_array ) and
     is_array( $template_array ) and is_array( $variable_array ) )
{
    $standard_array = array( "product_view_tpl" => $productview );
    $temp_arr = array_merge( $standard_array, $template_array );
    $t->set_file( $temp_arr );
    $t->set_file_block( $template_array );
    if ( isset( $block_array ) and is_array( $block_array ) )
        $t->set_block( $block_array );
    $t->parse( $variable_array );
}
else
{
    $t->set_var( "extra_product_info", "" );
    $t->set_file( "product_view_tpl", $productview );
}

// begin inline edit mod RBS

$t->set_block( "product_view_tpl", "user_login_tpl", "user_login" );

$t->set_var( "admin_site", "http://$AdminSiteURL" );

if ( $user && ( eZPermission::checkPermission( $user, "eZTrade", "WriteToRoot" ) ) )
	{
    		$t->parse( "user_login", "user_login_tpl" );
	}
	else
	{
    		$t->set_var( "user_login", "" );
	}
//end inline edit mod RBS

//  $t->set_file( array(
//      "product_view_tpl" => "productview.tpl"
//      ) );

$t->set_block( "product_view_tpl", "shipping_message_tpl", "shipping_message" );
$t->set_block( "shipping_message_tpl", "free_ups_tpl", "free_ups" );
$t->set_block( "shipping_message_tpl", "free_usps_tpl", "free_usps" );
$t->set_block( "shipping_message_tpl", "flat_ups_tpl", "flat_ups" );
$t->set_block( "shipping_message_tpl", "flat_usps_tpl", "flat_usps" );
$t->set_block( "shipping_message_tpl", "flat_ups_combine_tpl", "flat_ups_combine" );
$t->set_block( "shipping_message_tpl", "flat_usps_combine_tpl", "flat_usps_combine" );

$t->set_block( "product_view_tpl", "product_number_item_tpl", "product_number_item" );
$t->set_block( "product_view_tpl", "price_tpl", "price" );
$t->set_block( "product_view_tpl", "list_price_tpl", "list_price" );

$t->set_block( "product_view_tpl", "price_to_high_tpl", "price_to_high" );
$t->set_block( "product_view_tpl", "price_to_low_tpl", "price_to_low" );

$t->set_block( "product_view_tpl", "attached_file_list_tpl", "attached_file_list" );
$t->set_block( "attached_file_list_tpl", "attached_file_tpl", "attached_file" );

$t->set_block( "product_view_tpl", "price_range_tpl", "price_range" );
$t->set_block( "product_view_tpl", "mail_method_tpl", "mail_method" );
$t->set_block( "price_range_tpl", "price_range_min_unlimited_tpl", "price_range_min_unlimited" );
$t->set_block( "price_range_tpl", "price_range_min_limited_tpl", "price_range_min_limited" );
$t->set_block( "price_range_tpl", "price_range_max_unlimited_tpl", "price_range_max_unlimited" );
$t->set_block( "price_range_tpl", "price_range_max_limited_tpl", "price_range_max_limited" );

$t->set_block( "price_tpl", "alternative_currency_list_tpl", "alternative_currency_list" );
$t->set_block( "alternative_currency_list_tpl", "alternative_currency_tpl", "alternative_currency" );

$t->set_block( "product_view_tpl", "quantity_item_tpl", "quantity_item" );
$t->set_block( "product_view_tpl", "date_available_tpl", "date_available" );
$t->set_block( "product_view_tpl", "add_to_cart_tpl", "add_to_cart" );
$t->set_block( "product_view_tpl", "voucher_buttons_tpl", "voucher_buttons" );
$t->set_block( "product_view_tpl", "path_tpl", "path" );
$t->set_block( "product_view_tpl", "image_list_tpl", "image_list" );

$t->set_block( "image_list_tpl", "image_tpl", "image" );
$t->set_block( "product_view_tpl", "main_image_tpl", "main_image" );
$t->set_block( "product_view_tpl", "option_tpl", "option" );
$t->set_block( "option_tpl", "value_price_header_tpl", "value_price_header" );
$t->set_block( "option_tpl", "value_tpl", "value" );

$t->set_block( "value_price_header_tpl", "value_description_header_tpl", "value_description_header" );
$t->set_block( "value_price_header_tpl", "value_price_header_item_tpl", "value_price_header_item" );
$t->set_block( "value_price_header_tpl", "value_currency_header_item_tpl", "value_currency_header_item" );

$t->set_block( "value_tpl", "value_description_tpl", "value_description" );
$t->set_block( "value_tpl", "value_price_item_tpl", "value_price_item" );
$t->set_block( "value_tpl", "value_availability_item_tpl", "value_availability_item" );
$t->set_block( "value_tpl", "value_price_currency_list_tpl", "value_price_currency_list" );

$t->set_block( "value_price_currency_list_tpl", "value_price_currency_item_tpl", "value_price_currency_item" );
$t->set_block( "product_view_tpl", "external_link_tpl", "external_link" );
$t->set_block( "product_view_tpl", "attribute_list_tpl", "attribute_list" );

$t->set_block( "attribute_list_tpl", "attribute_tpl", "attribute" );
$t->set_block( "attribute_list_tpl", "attribute_value_tpl", "attribute_value" );
$t->set_block( "attribute_list_tpl", "attribute_header_tpl", "attribute_header" );

$t->set_block( "product_view_tpl", "numbered_page_link_tpl", "numbered_page_link" );
$t->set_block( "product_view_tpl", "print_page_link_tpl", "print_page_link" );
$t->set_block( "product_view_tpl", "section_item_tpl", "section_item" );

$t->set_block( "section_item_tpl", "link_item_tpl", "link_item" );

if ( !isset( $ModuleName ) )
    $ModuleName = "trade";
if ( !isset( $ModuleList ) )
    $ModuleList = "productlist";
if ( !isset( $ModuleView ) )
    $ModuleView = "productview";
if ( !isset( $ModulePrint ) )
    $ModulePrint = "productprint";

// Add Product Information into Site / Page Title
// escape product names with quotes (kicks new error) re: htmlspecialchars are not search engine friendly 
$SiteTitleAppend = $product->name();
$SiteTitleAppend .= " - ". $product->productNumber();

$t->set_var( "module", $ModuleName );
$t->set_var( "module_list", $ModuleList );
$t->set_var( "module_view", $ModuleView );
$t->set_var( "module_print", $ModulePrint );
$t->set_var( "product_category_id", $categoryID );
$t->set_var( "attribute_header", "" );
$t->set_var( "attribute_value", "" );
$t->set_var( "price_range", "" );
$t->set_var( "price_to_high", "" );
$t->set_var( "price_to_low", "" );

$MailMethod = 1;

if ($product->flatUSPS() != 'off') {
	if (0 == $product->flatUSPS()) {	
		$t->set_var( "flat_usps_combine", "");
		$t->set_var( "flat_usps", "");
		$t->parse("free_usps", "free_usps_tpl");
	} elseif ($product->flatCombine()) {
		$t->set_var("free_usps", "");
		$t->set_var("flat_usps", "");
		$t->set_var ("flat_usps_price", $product->flatUSPS() );
		$t->parse("flat_usps_combine", "flat_usps_combine_tpl");
	} else {
		$t->set_var("free_usps", "");
		$t->set_var("flat_usps_combine", "");
		$t->set_var ("flat_usps_price", $product->flatUSPS() );
		$t->parse("flat_usps", "flat_usps_tpl");
	}
} else {
	$t->set_var("free_usps", "");
	$t->set_var("flat_usps", "");
	$t->set_var("flat_usps_combine", "");
}
if ($product->flatUPS() != 'off') {
	if (0 == $product->flatUPS()) {
		$t->set_var( "flat_ups_combine", "");
		$t->set_var( "flat_ups", "");
		$t->parse("free_ups", "free_ups_tpl");
	} elseif ($product->flatCombine()) {
		$t->set_var( "free_ups", "");
		$t->set_var( "flat_ups", "");
		$t->set_var ("flat_ups_price", $product->flatUPS() );
		$t->parse("flat_ups_combine", "flat_ups_combine_tpl");
	} else {
		$t->set_var( "free_ups", "");
		$t->set_var( "flat_ups_combine", "");
		$t->set_var ("flat_ups_price", $product->flatUPS() );
		$t->parse("flat_ups", "flat_ups_tpl");
	}
} else {
	$t->set_var("free_ups", "");
	$t->set_var("flat_ups", "");
	$t->set_var("flat_ups_combine", "");
}


if ($product->flatUPS() != 'off' || $product->flatUSPS() != 'off')
{
	$t->parse("shipping_message", "shipping_message_tpl");
} else {
	$t->set_var("shipping_message", "");
} 

if ( !$product->showProduct() )
{
    eZHTTPTool::header( "Location: /error/404/" );
	echo "Sorry, this product is not currently available.";	
	exit();
}
if ( isset ( $Voucher ) )
{
    $range = $product->priceRange();
    
    if ( isset( $_REQUEST['PriceRange'] ) )
        $PriceRange = $_REQUEST['PriceRange'];
    else
        $PriceRange = $range->min();

    $error = false;
    if ( ( $range->min() != 0 ) && ( $range->min() > $PriceRange ) )
    {
        $error = true;
        $t->parse( "price_to_low", "price_to_low_tpl" );
    }
    if ( ( $range->max() != 0 ) && ( $range->max() < $PriceRange ) )
    {
        $error = true;
        $t->parse( "price_to_high", "price_to_high_tpl" );
    }

    if ( !$error )
    {
        eZHTTPTool::header( "Location: /trade/voucherinformation/$ProductID/$PriceRange/$MailMethod/" );
        exit();
    }
}
else
$session->setVariable( "VoucherInformationID", 0 );

$pathArray =& $category->path();

$t->set_var( "path", "" );
foreach ( $pathArray as $path )
{
    $t->set_var( "category_id", $path[0] );
    $t->set_var( "category_name", $path[1] );

    $t->parse( "path", "path_tpl", true );
}

$mainImage = $product->mainImage();
$mainImageID = false;

if ( $mainImage )
{
    $variation = $mainImage->requestImageVariation( $MainImageWidth, $MainImageHeight );

    $t->set_var( "main_image_id", $mainImage->id() );
    $t->set_var( "main_image_uri", "/" . $variation->imagePath() );
    $t->set_var( "main_image_width", $variation->width() );
    $t->set_var( "main_image_height", $variation->height() );
    $t->set_var( "main_image_caption", $mainImage->caption() );
    
	if ( $mainImage->caption() != "" )
	{
	    $t->set_var( "main_image_caption", $mainImage->caption() );
	} else {
			$t->set_var( "main_image_caption", "&nbsp;" );
	}
    $mainImageID = $mainImage->id();

    $t->parse( "main_image", "main_image_tpl" );
}
else
{
    $t->set_var( "main_image", "" );
}

if ( $CapitalizeHeadlines == "enabled" )
{
    // include_once( "classes/eztexttool.php" );
    $t->set_var( "title_text", eZTextTool::capitalize( $product->name() ) );
}
else
{
    $t->set_var( "title_text", $product->name() );
}
$t->set_var( "intro_text", $product->brief() );
$t->set_var( "description_text", $product->description() );

if ( $product->productType() == 2 )
{
    $useVoucher = true;
    $t->set_var( "action_url", "productview" );
}
else
{
    $useVoucher = false;
    $t->set_var( "action_url", "cart/add" );
}

$images = $product->images();

$i = 0;
$t->set_var( "image", "" );
$t->set_var( "image_list", "" );
$image_count = 0;

foreach ( $images as $imageArray )
{
    $image = $imageArray["Image"];
    if ( $image->id() != $mainImageID )
    {

        if ( ( $i % 2 ) == 0 )
        {
            $t->set_var( "td_class", "bglight" );
        }
        else
        {
            $t->set_var( "td_class", "bgdark" );
        }

        $t->set_var( "image_name", $image->name() );

        $t->set_var( "image_title", $image->name() );
        $t->set_var( "image_caption", eZTextTool::nl2br( $image->caption() ) );
        $t->set_var( "image_id", $image->id() );
        $t->set_var( "product_id", $ProductID );

        $variation = $image->requestImageVariation( $SmallImageWidth, $SmallImageHeight );

        $t->set_var( "image_url", "/" .$variation->imagePath() );
        $t->set_var( "image_width", $variation->width() );
        $t->set_var( "image_height", $variation->height() );

        $t->parse( "image", "image_tpl", true );

        $image_count++;
        $i++;
    }
}

if ( $image_count > 0 )
    $t->parse( "image_list", "image_list_tpl" );

$options = $product->options();
$t->set_var( "option", "" );

$t->set_var( "value_price_header", "" );
if ( $ShowPrice and $product->showPrice() == true  )
    $t->parse( "value_price_header", "value_price_header_tpl" );

// show alternative currencies
$currency = new eZProductCurrency( );
$currencies =& $currency->getAll();
$t->set_var( "currency_count", count( $currencies ) );
$t->set_var( "value_price_header_item", "" );
$t->set_var( "value_currency_header_item", "" );
if ( !$RequireUserLogin or is_a( $user, "eZUser" ) )
{
    $t->parse( "value_price_header_item", "value_price_header_item_tpl" );
    if ( count( $currencies ) > 0 )
        $t->parse( "value_currency_header_item", "value_currency_header_item_tpl" );
}

$can_checkout = true;

$currency_locale = new eZLocale( $Language );
foreach ( $options as $option )
{
    $values = $option->values();

    $t->set_var( "value", "" );
    $i = 0;
    $headers = $option->descriptionHeaders();
    $t->set_var( "value_description_header", "" );
    if ( $SimpleOptionHeaders )
    {
        $t->set_var( "description_header", $headers[0] );
        $t->parse( "value_description_header", "value_description_header_tpl" );
    }
    else
    {
        foreach ( $headers as $header )
        {
            $t->set_var( "description_header", $header );
            $t->parse( "value_description_header", "value_description_header_tpl", true );
        }
    }

    foreach ( $values as $value )
    {
        $value_quantity = $value->totalQuantity();
        if ( $ShowOptionQuantity or ( is_bool( $value_quantity ) and !$value_quantity ) or
             !$RequireQuantity or ( $RequireQuantity and $value_quantity > 0 ) )
        {
            if ( !$value->hasQuantity( $RequireQuantity ) )
                $can_checkout = false;
            $t->set_var( "value_td_class", ( $i % 2 ) == 0 ? "bglight" : "bgdark" );
            $id = $value->id();

            $descriptions = $value->descriptions();
            $t->set_var( "value_description", "" );
            if ( $SimpleOptionHeaders )
            {
                $t->set_var( "value_id", $value->id() );

                $t->set_var( "value_name", $descriptions[0] );
                $t->parse( "value_description", "value_description_tpl" );
            }
            else
            {
                foreach ( $descriptions as $description )
                {
                    $t->set_var( "value_name", $description );
                    $t->parse( "value_description", "value_description_tpl", true );
                }
            }

            $t->set_var( "value_price", "" );
            $t->set_var( "value_price_item", "" );
            $t->set_var( "value_price_currency_list", "" );
            if ( $ShowPrice and $product->showPrice() == true  )
            {
                $price = new eZCurrency( $value->correctPrice( $PricesIncludeVAT, $product ) );
                if ( $value->price() != 0 )
                    $t->set_var( "value_price", "+".$value->localePrice( $PricesIncludeVAT, $product ) );
                else
                    $t->set_var( "value_price", "" );

                $t->parse( "value_price_item", "value_price_item_tpl" );

                $t->set_var( "value_price_currency_item", "" );
                foreach ( $currencies as $currency )
                {
                    $altPrice = $price;
                    $altPrice->setValue( $price->value() * $currency->value() );

                    $currency_locale->setSymbol( $currency->sign() );
                    $currency_locale->setPrefixSymbol( $currency->prefixSign() );

                    $t->set_var( "alt_value_price", $currency_locale->format( $altPrice ) );
                    $t->parse( "value_price_currency_item", "value_price_currency_item_tpl", true );
                }

                $t->set_var( "value_price_currency_list", "" );
                if ( count( $currencies ) > 0 )
                    $t->parse( "value_price_currency_list", "value_price_currency_list_tpl" );
            }

            $t->set_var( "value_availability_item", "" );
            if ( !( is_bool( $value_quantity ) and !$value_quantity ) )
            {
                $named_quantity = $value_quantity;
                if ( $ShowNamedQuantity )
                    $named_quantity = eZProduct::namedQuantity( $value_quantity );
                $t->set_var( "value_availability", $named_quantity );
                $t->parse( "value_availability_item", "value_availability_item_tpl" );
            }

            $t->parse( "value", "value_tpl", true );
            $i++;
        }
    }

    if ( $i > 0 )
    {
        $t->set_var( "option_name", $option->name() );
        $t->set_var( "option_description", $option->description() );
        $t->set_var( "option_id", $option->id() );
        $t->set_var( "product_id", $ProductID );

        $t->parse( "option", "option_tpl", true );
    }
}

if ( !$product->hasQuantity( $RequireQuantity ) )
    $can_checkout = false;

// $can_checkout = $product->showPrice();


// link list
$module_link = new eZModuleLink( "eZTrade", "Product", $product->id() );
$sections =& $module_link->sections();
$t->set_var( "section_item", "" );
foreach ( $sections as $section )
{
    $t->set_var( "link_item", "" );
    $t->set_var( "section_name", $section->name() );
    $t->set_var( "section_id", $section->id() );
    $links =& $section->links();
    $i = 0;
    foreach ( $links as $link )
    {
        $t->set_var( "td_class", ($i % 2) == 0 ? "bglight" : "bgdark" );
        $t->set_var( "link_name", $link->name() );
        $t->set_var( "link_url", $link->url() );
        $t->set_var( "link_id", $link->id() );
        $t->parse( "link_item", "link_item_tpl", true );
        ++$i;
    }
    $t->parse( "section_item", "section_item_tpl", true );
}

// attribute list
$type = $product->type();
if ( $type )
{
    $attributes = $type->attributes();
    for ( $i = 0; $i < count( $attributes ); $i++ )
    {
        if ( ( $i % 2 ) == 0 )
        {
            $t->set_var( "begin_tr", "<tr>" );
            $t->set_var( "end_tr", "" );
        }
        else
        {
            $t->set_var( "begin_tr", "" );
            $t->set_var( "end_tr", "</tr>" );
        }

        $value =& $attributes[$i]->value( $product );
        $t->set_var( "attribute_id", $attributes[$i]->id( ) );
        $t->set_var( "attribute_name", $attributes[$i]->name( ) );
        $t->set_var( "attribute_unit", $attributes[$i]->unit( ) );
        $t->set_var( "attribute_value_var", $value );

        if ( $attributes[$i]->attributeType() == 1 )
        {
            // don''t who empty attributes or attributes == 0.0
            if ( ( is_numeric( $value ) and ( $value > 0 ) ) || ( !is_numeric( $value ) and $value != "" ) )
            {
                $t->parse( "attribute", "attribute_value_tpl", true );
            }
        }
        else if ( $attributes[$i]->attributeType() == 2 )
        {
            $j = $i;
            $header = false;
            for ( $j++; $j < count( $attributes ); $j++ )
            {
                if ( $attributes[$j]->attributeType() == 2 )
                    break;
                $value =& $attributes[$j]->value( $product );
                if ( ( is_numeric( $value ) and ( $value > 0 ) ) || ( !is_numeric( $value ) and $value != "" ) )
                {
                    $t->parse( "attribute", "attribute_header_tpl", true );
                    break;
                }
            }
        }
    }
}

if ( isset( $attributes ) && count( $attributes ) > 0 )
{
    $t->parse( "attribute_list", "attribute_list_tpl" );
}
else
{
    $t->set_var( "attribute_list", "" );
}


$t->set_var( "product_id", $product->id() );

if ( trim( $product->externalLink() ) != "" )
{
    $t->set_var( "external_link_url", "http://" . $product->externalLink() );
    $t->parse( "external_link", "external_link_tpl" );
}
else
{
    $t->set_var( "external_link", "" );
    $t->set_var( "external_link_url", "" );
    $t->parse( "external_link", "external_link_tpl" );
}

$t->set_var( "product_number_item", "" );
if ( $product->productNumber() != "" )
{
    $t->set_var( "product_number", $product->productNumber() );
    $t->parse( "product_number_item", "product_number_item_tpl" );
}

$t->set_var( "product_catalog_number_item", "" );
if ( $product->catalogNumber() != "" )
{
  $t->set_var( "product_catalog_number", $product->catalogNumber() );
  $t->parse( "product_catalog_number_item", "product_catalog_number_item_tpl" );
}


$Quantity = $product->totalQuantity();
if ( is_bool( $Quantity ) and !$Quantity )
    $ShowQuantity = false;
$t->set_var( "quantity_item", "" );

if ( $ShowQuantity and $product->hasPrice() )
{
    $NamedQuantity = $Quantity;
    if ( $ShowNamedQuantity )
    {
        $NamedQuantity = eZProduct::namedQuantity( $Quantity );
    }
    $t->set_var( "product_quantity", $NamedQuantity );
    $t->parse( "quantity_item", "quantity_item_tpl" );
}

$t->set_var( "date_available", "" );

if ( $product->stockDate() && $NamedQuantity == 0 )
            {
                $Stock = new eZDate();
                $Stock->setTimeStamp( $product->stockDate() );	
				$t->set_var( "date_available", $locale->format( $Stock ) );
				$t->parse( "date_available", "date_available_tpl" );				
}

$t->set_var( "price", "" );
$t->set_var( "list_price", "" );
$t->set_var( "product_list_price", "" );
$t->set_var( "add_to_cart", "" );
$t->set_var( "voucher_buttons", "" );

if ( $product->listPrice() && $product->listPrice() > 0 )
	{
		$currency = new eZCurrency();
		$currency->setValue( $product->listPrice() );
		$t->set_var( "product_list_price", $locale->format( $currency ) );
		$t->parse( "list_price", "list_price_tpl", true );
	}

if ( $ShowPrice and $product->showPrice() == true and $product->hasPrice()  )
{
    $currency = new eZCurrency();
    $currency->setValue( $product->correctPrice( $PricesIncludeVAT ) );
    $t->set_var( "product_price", $locale->format( $currency ) );

//    $t->set_var( "product_price", $product->localePrice( $PricesIncludeVAT ) );

    $price = new eZCurrency( $product->correctPrice( $PricesIncludeVAT ) );

    // show alternative currencies

    $currency = new eZProductCurrency( );
    $currencies =& $currency->getAll();

    if ( $product->hasOptions() )
    {
        $priceRange = $product->correctPriceRange( $PricesIncludeVAT );

        foreach ( $currencies as $currency )
        {
            $altMinPrice = $price;
            $altMaxPrice = $price;

            $altMinPrice->setValue( $priceRange["min"] * $currency->value() );
            $altMaxPrice->setValue( $priceRange["max"] * $currency->value() );

            $locale->setSymbol( $currency->sign() );

            if ( $currency->prefixSign() )
            {
                $locale->setPrefixSymbol( true );
            }
            else
            {
                $locale->setPrefixSymbol( false );
            }

            $t->set_var( "alt_price", $locale->format( $altMinPrice ) . " - " . $locale->format( $altMaxPrice ) );
            $t->parse( "alternative_currency", "alternative_currency_tpl", true );
        }
    }
    else
    {
        foreach ( $currencies as $currency )
        {
            $altPrice = $price;
            $altPrice->setValue( $price->value() * $currency->value() );

            $locale->setSymbol( $currency->sign() );

            if ( $currency->prefixSign() )
            {
                $locale->setPrefixSymbol( true );
            }
            else
            {
                $locale->setPrefixSymbol( false );
            }

            $t->set_var( "alt_price", $locale->format( $altPrice ) );

            $t->parse( "alternative_currency", "alternative_currency_tpl", true );
        }
    }

    if ( count( $currencies ) > 0 )
    {
        $t->parse( "alternative_currency_list", "alternative_currency_list_tpl" );
    }
    else
    {
        $t->set_var( "alternative_currency_list", "" );
    }

    $t->set_var( "price_range", "" );
    $t->set_var( "mail_method", "" );
    $t->parse( "price", "price_tpl" );
}
else
{
    $t->set_var( "price_range", "" );
    $t->set_var( "mail_method", "" );

    $priceRange =& $product->priceRange();
    $currency = new eZCurrency( );

    if ( ( is_a ( $priceRange, "eZProductPriceRange" ) ) && is_numeric ( $priceRange->id() ) )
    {
        $min = $priceRange->min();
        $max = $priceRange->max();
        if ( $min )
        {
            $currency->setValue( $min );
            $t->set_var( "price_min", $locale->format( $currency ) );
            $t->set_var( "price_range_min_unlimited", "" );
            $t->parse( "price_range_min_limited", "price_range_min_limited_tpl" );
        }
        else
        {
            $t->set_var( "price_range_min_limited", "" );
            $t->parse( "price_range_min_unlimited", "price_range_min_unlimited_tpl" );
        }
        if ( $max )
        {
            $currency->setValue( $max );
            $t->set_var( "price_max", $locale->format( $currency ) );
            $t->set_var( "price_range_max_unlimited", "" );
            $t->parse( "price_range_max_limited", "price_range_max_limited_tpl" );
        }
        else
        {
            $t->set_var( "price_range_max_limited", "" );
            $t->parse( "price_range_max_unlimited", "price_range_max_unlimited_tpl" );
        }

        $t->parse( "mail_method", "mail_method_tpl" );
        $t->parse( "price_range", "price_range_tpl" );
    }
}

if ( ( $PurchaseProduct and !$product->discontinued() and $can_checkout ) and !$useVoucher )
    $t->parse( "add_to_cart", "add_to_cart_tpl" );
if ( ( $PurchaseProduct and !$product->discontinued() and $can_checkout ) and $useVoucher )
    $t->parse( "voucher_buttons", "voucher_buttons_tpl" );

if ( isset( $PrintableVersion ) && $PrintableVersion == "enabled" )
{
    $t->parse( "numbered_page_link", "numbered_page_link_tpl" );
    $t->set_var( "print_page_link", "" );
}
else
{
    $t->set_var( "print_page_link", "" );
    //    $t->parse( "print_page_link", "print_page_link_tpl" );
    $t->set_var( "numbered_page_link", "" );
}

if ( isset( $func_array ) and is_array( $func_array ) )
{
    foreach ( $func_array as $func )
    {
        $func( $t, $ProductID );
    }
}

// files
$files = $product->files();

if ( count( $files ) > 0 )
{
    $i=0;
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

	
        $t->set_var( "site_protocol", "http://" );
        $t->set_var( "site_host", $SiteURL );


        $t->set_var( "file_id", $file->id() );
        $t->set_var( "original_file_name", $file->fileName() );
        $t->set_var( "file_name", $file->name() );
        $t->set_var( "file_url", $file->name() );
        $t->set_var( "file_description", $file->description() );

        $size = $file->siFileSize();
        $t->set_var( "file_size", $size["size-string"] );
        $t->set_var( "file_unit", $size["unit"] );


        $i++;
        $t->parse( "attached_file", "attached_file_tpl", true );
    }

    $t->parse( "attached_file_list", "attached_file_list_tpl" );
}
else
	 $t->set_var( "attached_file_list", "" );


$SiteTitleAppend = $product->name();
$SiteDescriptionOverride = str_replace( "\"", "", strip_tags( $product->brief() ) );
$SiteKeywordsOverride = str_replace( "\"", "", strip_tags( $product->keywords() ) );

if ( isset( $GenerateStaticPage ) && $GenerateStaticPage == "true" && !$useVoucher )
{

    $title_check_single = strstr( $SiteTitleAppend, "'" );
    $title_check_double = strstr( $SiteTitleAppend, '"' );

    $template_var = "product_view_tpl";

    // add PHP code in the cache file to store variables
    $output = "<?php\n";
    $output .= "\$GlobalSectionID=\"$GlobalSectionID\";\n";

    if ( $title_check_double && !$title_check_single )  
    {
        $output .= "\$SiteTitleAppend='". $SiteTitleAppend ."';" ."\n";
    } elseif ( $title_check_single && !$title_check_double ) {
        $output .= "\$SiteTitleAppend=\"". $SiteTitleAppend ."\";" ."\n";
        // print ( '$SiteTitleAppend="1-'. $SiteTitleAppend .'";' ."\n" );
    } else {
        $output .= "\$SiteTitleAppend='". $SiteTitleAppend ."';" ."\n";
        // print ( '$SiteTitleAppend="1-'. $SiteTitleAppend .'";' ."\n" );
    }

    $output .= "\$SiteDescriptionOverride=\"$SiteDescriptionOverride\";\n";
    $output .= "\$SiteKeywordsOverride=\"$SiteKeywordsOverride\";\n";
    $output .= "?>\n";


    $output .= $t->parse("output", $template_var );
    // print the output the first time while printing the cache file.
    print( $output );
    $CacheFile->store( $output );
}
else
{
    $t->pparse( "output", "product_view_tpl" );
}

?>