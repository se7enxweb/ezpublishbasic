<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td valign="bottom">
	<h1>{intl-head_line}</h1>
	</td>
	<td align="right">
	<form action="{www_dir}{index}/article/search/" method="post">
        <input type="hidden" name="SectionIDOverride" value="{section_id}">
	<input class="searchbox" type="text" name="SearchText" size="10" />	
	<input class="stdbutton" type="submit" value="{intl-search}" />
	</form>	
	</td>
</tr>
</table>

<hr noshade="noshade" size="4" />
<!--
<img src="{www_dir}/design/base/images/icons/path-arrow.gif" height="10" width="12" border="0" alt="">
<a class="path" href="{www_dir}{index}/article/archive/0/">{intl-top_level}</a>


<hr noshade="noshade" size="4" />
-->
<!-- BEGIN element_list_tpl -->
<!-- END element_list_tpl -->

<!-- BEGIN one_column_article_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td valign="top" width="100%">
		<div class="article">
			<div class="listheadline"><a class="listheadline" href="{www_dir}{index}/article/static/{article_id}/1/{category_id}/">{article_name}</a></div>
			<div class="small">( {article_published} )</div>

	<!-- BEGIN one_column_article_image_tpl -->
	    <div class="imagetable" width="1%" cellpadding="2" cellspacing="0" align="left">
	        <div>
			<a href="{www_dir}{index}/article/static/{article_id}/1/{category_id}/"><img src="{www_dir}{thumbnail_image_uri}" border="0" width="{thumbnail_image_width}" height="{thumbnail_image_height}" /></a>
			</div>
			<div class="pictext">
              {thumbnail_image_caption}
            </div>
		</div>
        <!-- END one_column_article_image_tpl -->


	<div class="spacer"><div class="p">{article_intro}</div>
	    <!-- BEGIN message_count_tpl -->
		<span class="smallbold">&nbsp;({messages} {intl-message_count})</span>
		<!-- END message_count_tpl -->
		</div>

        <!-- BEGIN one_column_read_more_tpl -->
		<div>
			<div>
				<img src="{www_dir}/design/base/images/icons/path-arrow.gif" height="10" width="12" border="0" alt="" />

				<a class="path" href="{www_dir}{index}/article/articleview/{article_id}/1/{category_id}/">{article_link_text}</a>
				| <a class="path" href="{www_dir}{index}/article/archive/{category_def_id}/">{category_def_name}</a>
				<br /><img src="{www_dir}/design/base/images/design/1x1.gif" height="8" width="4" border="0" alt="" /><br />
			</div>
		</div>
    <!-- END one_column_read_more_tpl -->
	</div>
	</td>
</tr>
</table>
<!-- END one_column_article_tpl -->


<!-- BEGIN two_column_article_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td valign="top" width="48%">
	<!-- BEGIN left_article_tpl -->
	<div class="article">
		<div class="listheadline"><a class="listheadline" href="{www_dir}{index}/article/static/{article_id}/1/{category_id}/">{article_name}</a></div>
		<div class="small">( {article_published} )</div>

	<!-- BEGIN left_article_image_tpl -->

		<div class="imagetable" width="1%" cellpadding="2" cellspacing="0" align="left">
			<div>
				<a href="{www_dir}{index}/article/static/{article_id}/1/{category_id}/"><img src="{www_dir}{thumbnail_image_uri}" border="0" width="{thumbnail_image_width}" height="{thumbnail_image_height}" /></a>
			</div>
			<div class="pictext">
				{thumbnail_image_caption}
			</div>
		</div>
	<!-- END left_article_image_tpl -->


	<div class="spacer"><div class="p">{article_intro}</div></div>
        <!-- BEGIN left_message_count_tpl -->
		<span class="smallbold">&nbsp;({messages} {intl-message_count})</span>
		<!-- END left_message_count_tpl -->
        <!-- BEGIN left_read_more_tpl -->

		<div>
			<div>
				<img src="{www_dir}/design/base/images/icons/path-arrow.gif" height="10" width="12" border="0" alt="" />

				<a class="path" href="{www_dir}{index}/article/articleview/{article_id}/1/{category_id}/">{article_link_text}</a>
				| <a class="path" href="{www_dir}{index}/article/archive/{category_def_id}/">{category_def_name}</a>
				<br /><img src="{www_dir}/design/base/images/design/1x1.gif" height="8" width="4" border="0" alt="" /><br />
			</div>
		</div>
        <!-- END left_read_more_tpl -->

	</div>
	<!-- END left_article_tpl -->
	</td>
	
	<td width="2%"><img src="{www_dir}/design/base/images/design/1x1.gif" height="10" width="4" border="0" alt="" /></td>
	
	<td valign="top" width="48%">
		<div class="article">
	<!-- BEGIN right_article_tpl -->
			<div class="listheadline"><a class="listheadline" href="{www_dir}{index}/article/static/{article_id}/1/{category_id}/">{article_name}</a></div>
			<div class="small">( {article_published} )</div>

	<!-- BEGIN right_article_image_tpl -->
		<div class="imagetable" width="1%" cellpadding="2" cellspacing="0" align="left">
			<div>
				<a href="{www_dir}{index}/article/static/{article_id}/1/{category_id}/"><img src="{www_dir}{thumbnail_image_uri}" border="0" width="{thumbnail_image_width}" height="{thumbnail_image_height}" /></a>
			</div>
			<div class="pictext">
				{thumbnail_image_caption}
			</div>
		</div>
    <!-- END right_article_image_tpl -->

	<div class="spacer"><div class="p">{article_intro}</div>
	<!-- BEGIN right_message_count_tpl -->
	<span class="smallbold">&nbsp;({messages} {intl-message_count})</span>
	<!-- END right_message_count_tpl -->
	</div>

        <!-- BEGIN right_read_more_tpl -->
		<div>
			<div>
				<img src="{www_dir}/design/base/images/icons/path-arrow.gif" height="10" width="12" border="0" alt="" />

				<a class="path" href="{www_dir}{index}/article/articleview/{article_id}/1/{category_id}/">{article_link_text}</a>
				| <a class="path" href="{www_dir}{index}/article/archive/{category_def_id}/">{category_def_name}</a>
				<br /><img src="{www_dir}/design/base/images/design/1x1.gif" height="8" width="4" border="0" alt="" /><br />
			</div>
		</div>
        <!-- END right_read_more_tpl -->
		</div>
	<!-- END right_article_tpl -->
	</td>
</tr>
</table>
<!-- END two_column_article_tpl -->

<!-- BEGIN two_column_product_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td valign="top" width="49%">
	<!-- BEGIN left_product_tpl -->
        <table width="100%" align="left" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
	    <div class="listproducts"><a class="listheadline" href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">{product_name}</a></div>
            <!-- BEGIN left_product_image_tpl -->
            <table align="right">
            <tr>
                <td>
	        <a href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">
	        <img src="{www_dir}{thumbnail_image_uri}" border="0" width="{thumbnail_image_width}" height="{thumbnail_image_height}" />
	        </a>
	        </td>
            </tr>
	    <tr>
	        <td class="pictext">
	        {thumbnail_image_caption}
	        </td>
	    </tr>
            </table>
	    <!-- END left_product_image_tpl -->

            <div class="p">{product_intro_text}</div>

	    <div class="pris">
		<!-- BEGIN left_price_tpl -->
	    {product_price}
	    <!-- END left_price_tpl -->
		<img src="{www_dir}/design/base/images/icons/path-arrow.gif" height="10" width="12" border="0" alt="" />
		<a class="path" href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">{intl-get_more_info}</a>
	</div>

	   </td>
        </tr>
	</table>
	<!-- END left_product_tpl -->
	</td>

	<td width="2%"><img src="{www_dir}/design/base/images/design/1x1.gif" height="10" width="4" border="0" alt="" /></td>
	
	<td valign="top" width="49%">
	<!-- BEGIN right_product_tpl -->
        <table width="100%" cellpadding="0" cellspacing="0" align="right" border="0"> 
        <tr>
	    <td>
            <div class="listproducts"><a class="listheadline" href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">{product_name}</a></div>
	    <!-- BEGIN right_product_image_tpl -->
	    <table align="right" cellpadding="0" cellspacing="0" border="0">
	    <tr>
	        <td>
		<a href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">
		<img src="{www_dir}{thumbnail_image_uri}" border="0" width="{thumbnail_image_width}" height="{thumbnail_image_height}" />
		</a>
		</td>
	   </tr>
           <tr>
               <td class="pictext">
	       {thumbnail_image_caption}
	       </td>
           </tr>
        </table>
	<!-- END right_product_image_tpl -->

	<div class="p">{product_intro_text}</div>
	
	<div class="pris">
	<!-- BEGIN right_price_tpl -->
	{product_price}
	<!-- END right_price_tpl -->
	<img src="{www_dir}/design/base/images/icons/path-arrow.gif" height="10" width="12" border="0" alt="" />
	<a class="path" href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">{intl-get_more_info}</a>
	</div>
	</td>
	</tr>
	</table>
	<!-- END right_product_tpl -->
	</td>
</tr>
</table>
<br />
<!-- END two_column_product_tpl -->


<!-- BEGIN one_column_product_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td valign="top" width="49%">
	<!-- BEGIN product_tpl -->
        <table width="100%" align="left" cellpadding="0" cellspacing="0" border="0">
        <tr>
            <td>
	    <div class="listproducts"><a class="listheadline" href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">{product_name}</a></div>
            <!-- BEGIN product_image_tpl -->
            <table align="right">
            <tr>
                <td>
	        <a href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">
	        <img src="{www_dir}{thumbnail_image_uri}" border="0" width="{thumbnail_image_width}" height="{thumbnail_image_height}" />
	        </a>
	        </td>
            </tr>
	    <tr>
	        <td class="pictext">
	        {thumbnail_image_caption}
	        </td>
	    </tr>
            </table>
	    <!-- END product_image_tpl -->

            <div class="p">{product_intro_text}</div>

	    <div class="pris">
		<!-- BEGIN price_tpl -->
	    {product_price}
	    <!-- END price_tpl -->
		<img src="{www_dir}/design/base/images/icons/path-arrow.gif" height="10" width="12" border="0" alt="" />
		<a class="path" href="{www_dir}{index}/trade/productview/{product_id}/{category_id}/">{intl-get_more_info}</a>
	</div>

	   </td>
        </tr>
	</table>
	<!-- END product_tpl -->
	</td>
</tr>
</table>
<br />
<!-- END one_column_product_tpl -->

<!-- BEGIN one_short_article_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td width="70%">
	<a class="path" href="{www_dir}{index}/article/static/{article_id}/1/{category_id}/">{article_name}</a></div>
	</td>
	<td align="right" width="30%">
	<div class="small">( {article_published} )</div>
	</td>
</tr>
</table>
<!-- END one_short_article_tpl -->


<!-- BEGIN ad_column_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td class="tdmini"><img src="{www_dir}/design/base/images/design/1x1.gif" height="4" width="4" border="0" alt="" /></td>
</tr>

<tr>
	<td valign="top" align="center">

	<!-- BEGIN html_ad_tpl -->	
	{html_ad_contents}
	<!-- END html_ad_tpl -->

	<!-- BEGIN standard_ad_tpl -->	
	<a target="_blank" href="{www_dir}{index}/ad/goto/{ad_id}/"><img src="{www_dir}{image_src}" width="{image_width}" height="{image_height}" border="0" alt="" /></a>
	<!-- END standard_ad_tpl -->	
	</td>
</tr>
<tr>
	<td class="tdmini"><img src="{www_dir}/design/base/images/design/1x1.gif" height="3" width="4" border="0" alt="" /></td>
</tr>
</table>
<!-- END ad_column_tpl -->