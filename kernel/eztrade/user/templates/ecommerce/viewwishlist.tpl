<!-- start #breadcrumbs -->
<div id="breadcrumbs">
&nbsp; <a href="{www_dir}{index}/trade/findwishlist/">{intl-find_wishlist}</a>
</div>
<!-- end #breadcrumbs -->
<!-- start #contentWrap -->
<div id="contentWrap">
   <h1 class="mainHeading">{intl-wishlist}</h1>

<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center">

    <td>

      <!-- BEGIN empty_wishlist_tpl -->
      <h2>{intl-empty_wishlist}</h2>
      <!-- END empty_wishlist_tpl --> <!-- BEGIN wishlist_item_list_tpl -->
      <table class="list" width="90%" cellspacing="0" cellpadding="4" border="0">
		<tr> 
		  <th>&nbsp;</th>
		  <th>{intl-product_name}:</th>
		  <th>{intl-product_options}:</th>
		  <th>{intl-move_to_cart}:</th>
		  <th>{intl-someone_has_bought_this}:</th>
		  <!-- BEGIN product_available_header_tpl -->
		  <th>{intl-product_availability}:</th>
		  <!-- END product_available_header_tpl -->
		  <th>{intl-product_qty}:</th>
		  <td align="right"><b>{intl-product_price}:</b></td>
		</tr>
		<!-- BEGIN wishlist_item_tpl --> 
		<tr> 
		  <td class="{td_class}"> <!-- BEGIN wishlist_image_tpl --> <img src="{www_dir}{product_image_path}" border="0" width="{product_image_width}" height="{product_image_height}" alt="{product_image_caption}"/> 
			<!-- END wishlist_image_tpl --> </td>
		  <td class="{td_class}"> <a href="{www_dir}{index}/trade/productview/{product_id}/">{product_name}</a> 
		  </td>
		  <td class="{td_class}"> <!-- BEGIN wishlist_item_option_tpl --> {option_name}: 
			{option_value}<!-- BEGIN wishlist_item_option_availability_tpl -->({option_availability})
<!-- END wishlist_item_option_availability_tpl -->
			<!-- END wishlist_item_option_tpl --> &nbsp;</td>
		  <td class="{td_class}"> 
		  <!-- BEGIN move_to_cart_item_tpl -->
		  <a href="{www_dir}{index}/trade/viewwishlist/movetocart/{wishlist_item_id}/{wishlist_item_count}/"> 
			{intl-move_to_cart} </a> 
		  <!-- END move_to_cart_item_tpl -->
		  <!-- BEGIN no_move_to_cart_item_tpl -->
		  &nbsp;
		  <!-- END no_move_to_cart_item_tpl -->
                  </td>

  		  <td class="{td_class}">

		  <!-- BEGIN is_bought_tpl -->
		  {intl-is_bought}
		  <!-- END is_bought_tpl -->

		  <!-- BEGIN is_not_bought_tpl -->
		  {intl-is_not_bought}
		  <!-- END is_not_bought_tpl -->

   		  </td>

		  <!-- BEGIN product_available_item_tpl -->
		  <td class="{td_class}">
		  {product_availability}
		  </td>
		  <!-- END product_available_item_tpl -->

  		  <td class="{td_class}">
		  {wishlist_item_count}
   		  </td>
		  <td class="{td_class}" align="right"><nobr>{product_price}</nobr></td>
		</tr>
		<!-- END wishlist_item_tpl --> 
		<tr> 
		  <td colspan="6">&nbsp;</td>
		  <th>{intl-shipping}:</th>
		  <td align="right"><nobr>{shipping_cost}</nobr></td>
		  <td align="right">&nbsp;</td>
		</tr>
		<tr> 
		  <td colspan="6">&nbsp;</td>
		  <th>{intl-total}:</th>
		  <td align="right"><nobr>{wishlist_sum}</nobr></td>
		  <td align="right">&nbsp;</td>
		</tr>
	  </table>
      <!-- END wishlist_item_list_tpl -->

    </td>
  </tr>
</table>
</div>
