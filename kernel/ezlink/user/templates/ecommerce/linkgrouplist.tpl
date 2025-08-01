<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left" valign="bottom">
        <h1>{intl-headline}</h1>
     </td>
     <td align="right">
	 <form action="{www_dir}{index}/link/search/" method="post">
	       <input type="text" name="QueryString" size="12" />
	       <input class="stdbutton" type="submit" name="search" value="{intl-search}" />
         </form>
     </td>
</tr>
</table>

<hr noshade size="4">

<!-- BEGIN path_tpl -->

<img src="{www_dir}/design/admin/images/layout/path-arrow.gif" height="10" width="12" border="0" alt="" />

<a class="path" href="{www_dir}{index}/link/group/0/">{intl-top}</a>

<!-- END path_tpl -->

<!-- BEGIN path_item_tpl -->

<img src="{www_dir}/images/path-slash.gif" height="10" width="16" border="0" alt="" />

<a class="path" href="{www_dir}{index}/link/group/{group_id}/">{group_name}</a>

<!-- END path_item_tpl -->

<hr noshade size="4">

<!-- BEGIN group_list_tpl -->
<table class="list" width="100%" cellspacing="0" cellpadding="4" border="0">
<tr>
	<td>
	<h2>{categories}</h2>
	</td>
</tr>
<!-- BEGIN group_item_tpl -->
<tr>
	<td class="{td_class}" valign="top" width="99%">
	<b><a href="{www_dir}{index}/link/group/{linkgroup_id}/">{linkgroup_title}</a></b><br />
<!--	<div class="spacer"><span class="p">{linkgroup_description}</span></div> -->
	</td>
    <td class="{td_class}" width="1%">
	<!-- BEGIN image_item_tpl -->
	<a href="{www_dir}{index}/link/group/{linkgroup_id}/">
	<img src="{www_dir}{image_url}" alt="{image_caption}" width="{image_width}" height="{image_height}" border="0" /></a>
	<!-- END image_item_tpl -->
	<!-- BEGIN no_image_tpl -->
	&nbsp;
	<!-- END no_image_tpl -->
    </td>
</tr>
<!-- END group_item_tpl -->
</table>
<!-- END group_list_tpl -->


<!-- BEGIN link_list_tpl -->
<table class="list" width="100%" cellspacing="0" cellpadding="4" border="0">
<tr>
	<td>
	<h2>{links}</h2>
	<div class="boxtext">({link_start}-{link_end}/{link_total})</div>
	</td>
</tr>
<!-- BEGIN link_item_tpl -->
<tr class="{td_class}">
	<td valign="top" width="99%">
	<b><a href="{www_dir}{index}/link/gotolink/addhit/{link_id}/?Url={link_url}"  target="_blank">{link_title}</a></b><br />
 	<span class="p">{link_description}</span><br />
	<span class="small">(Hits: {link_hits})</span>
   	</td>
	<td valign="top" width="1%">
	<!-- BEGIN link_image_item_tpl -->
	<img src="{www_dir}{image_url}" alt="{image_caption}" width="{image_width}" height="{image_height}" border="0" />
	<!-- END link_image_item_tpl -->
	</td>
</tr>
<!-- END link_item_tpl -->
</table>
<!-- END link_list_tpl -->

<!-- BEGIN type_list_tpl -->
<br />
<table cellpadding="0" cellspacing="0" border="0">
<tr>
	<!-- BEGIN type_list_previous_tpl -->
	<td>
	<a class="path" href="{www_dir}{index}/link/group/{group_id}/parent/{item_previous_index}">&lt;&lt;&nbsp;{intl-previous}</a>&nbsp;
	</td>
	<!-- END type_list_previous_tpl -->

	<!-- BEGIN type_list_previous_inactive_tpl -->
	<td>
	&nbsp;
	</td>
	<!-- END type_list_previous_inactive_tpl -->

	<!-- BEGIN type_list_item_list_tpl -->

	<!-- BEGIN type_list_item_tpl -->
	<td>
	|&nbsp;<a class="path" href="{www_dir}{index}/link/group/{group_id}/parent/{item_index}">{type_item_name}</a>&nbsp;
	</td>
	<!-- END type_list_item_tpl -->

	<!-- BEGIN type_list_inactive_item_tpl -->
	<td>
	|&nbsp;&lt;&nbsp;{type_item_name}&nbsp;&gt;&nbsp;
	</td>
	<!-- END type_list_inactive_item_tpl -->

	<!-- END type_list_item_list_tpl -->

	<!-- BEGIN type_list_next_tpl -->
	<td>
	|&nbsp;<a class="path" href="{www_dir}{index}/link/group/{group_id}/parent/{item_next_index}">{intl-next}&nbsp;&gt;&gt;</a>
	</td>
	<!-- END type_list_next_tpl -->

	<!-- BEGIN type_list_next_inactive_tpl -->
	<td>
	|&nbsp;
	</td>
	<!-- END type_list_next_inactive_tpl -->

</tr>
</table>
<!-- END type_list_tpl -->
