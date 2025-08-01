<!-- start #breadcrumbs -->
<div id="breadcrumbs">
&nbsp; 
</div>
<!-- end #breadcrumbs -->
<!-- start #contentWrap -->
<div id="contentWrap">
   <h1 class="mainHeading">{headline}</h1>

<form method="post" action="{www_dir}{index}/link/suggestlink/{action_value}/{link_id}/" enctype="multipart/form-data">
<input type="hidden" name="max_file_size" value="3000000" />
<input type="hidden" name="RefererURL" value="{referer_url}" />

<p class="error">{error_msg}</p>

<p class="boxtext">{intl-name}:</p>
<!-- {intl-nameedit} -->
<input type="text" class="box" name="Name" size="40" value="{name}" />
<br />
<br />
<table width="80%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left" valign="top">
    <p class="boxtext">{intl-linkcategory}:</p>
    <!-- {intl-choosecategory} -->
    <select name="LinkCategoryID">
	<!-- BEGIN link_category_tpl -->
	<option {is_selected} value="{link_category_id}">{option_level}{link_category_name}</option>
	<!-- END link_category_tpl -->
    </select>
    </td>
    <td align="left" valign="top">
    <p class="boxtext">{intl-add_linkcategory}:</p>
    <select multiple="multiple" size="{num_select_categories}" name="CategoryArray[]">
        <!-- BEGIN multiple_category_tpl -->
	<option value="{link_category_id}" {multiple_selected}>&nbsp;{option_level} {link_category_name}</option>
        <!-- END multiple_category_tpl -->
    </select>
    </td>
</tr>
</table>


<p class="boxtext">{intl-url}: <a href="{www_dir}{index}/link/gotolink/addhit/{link_id}/?Url={url}">{url}</a> </p>
<!-- {intl-urledit} -->
<span class="p">http://</span><input type="text" class="halfbox" name="Url" size="40" value="{url}" />

<input class="stdbutton" type="submit" value="{intl-meta}" name="GetSite" />

<p class="boxtext">{intl-key}:</p>
<!-- {intl-search} -->
<textarea class="box" rows="5" cols="40" name="Keywords">{keywords}</textarea>

<br />

<p class="boxtext">{intl-desc}:</p>
<!-- {intl-discedit} -->
<textarea class="box" rows="5" cols="40" name="Description">{description}</textarea>
<br />

<!-- BEGIN image_item_tpl -->
<p class="boxtext">{intl-current_image}:</p>
<img src="{www_dir}{image_url}" alt="{image_caption}" width="{image_width}" height="{image_height}" />

<input type="checkbox" name="DeleteImage" />&nbsp;{intl-delete_image}
<!-- END image_item_tpl -->

<p class="boxtext">{intl-upload_image}:</p>
<input size="40" name="ImageFile" type="file" />&nbsp;
<br /><br />

<select name="TypeID">
<option value="-1">{intl-no_attributes}</option>
<!-- BEGIN type_tpl -->
<option value="{type_id}" selected="{selected}">{type_name}</option>
<!-- END type_tpl -->
</select>&nbsp;<input class="stdbutton" type="submit" name="Update" value="{intl-update}" />

<br /><br />

<!-- BEGIN attribute_list_tpl -->
<table width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
	<th>{intl-attribute_name}:</th>
	<th>{intl-attribute_value}:</th>
</tr>
<!-- BEGIN attribute_tpl -->
<tr>
	<td>
	{attribute_name}: 
	</td>
	<td>
	<input type="hidden" name="AttributeID[]" value="{attribute_id}" />
	<input type="text" name="AttributeValue[]" value="{attribute_value}" />
	</td>
</tr>

<!-- END attribute_tpl -->
</table>
<!-- END attribute_list_tpl -->

<hr noshade="noshade" size="4"/>

<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<td>
	<input class="okbutton" type="submit" value="{intl-ok}" />
	</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>
	<input class="okbutton" type="submit" name="Back" value="{intl-back}" />
	</td>
</tr>
</table>

</form>
</div>