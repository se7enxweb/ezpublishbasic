<form method="post" action="{www_dir}{index}{link_list_url}{item_id}">

<h1>{intl-head_line} ({client_name}/{client_type})</h1>
<hr noshade="noshade" size="4" />

<table cellpadding="4" cellspacing="0" border="0">
<tr>
	<td valign="top">
	<p class="boxtext">{intl-link_type}:</p>
	<select name="ModuleType">
	<!-- BEGIN value_tpl -->
	<option value="{module_type}" {selected}>{type_level}{type_name}</option>
	<!-- END value_tpl -->
	<option value="std/url" {url_selected}>{intl-url_type}</option>
	</select>
	</td>
	<td align="left" valign="bottom">
	<input class="stdbutton" type="submit" name="Choose" value="{intl-browse}" />
	</td>
</tr>
</table>

<br />

<table width="100%" cellpadding="2" cellspacing="0" border="0">
<tr>
	<th>&nbsp;
	</th>
	<th>{intl-name}:
	</th>
	<th>{intl-type}:
	</th>
	<th>&nbsp;</th>
	<th>&nbsp;</th>
	<th>&nbsp;
	</th>
	<th>&nbsp;
	</th>
</tr>
<!-- BEGIN section_item_tpl -->
<tr>
	<td width="1%">
	<input type="radio" {section_checked} name="SectionID" value="{section_id}" />
	</td>
	<th>
	<input type="text" name="SectionName[{section_id}]" size="20" value="{section_name}" />:
	<input type="hidden" name="SectionIDList[]" value="{section_id}" />
	</th>
	<th>&nbsp;
	<td width="1%"><a href="{www_dir}{index}{item_down_command}"><img src="{www_dir}/admin/images/move-down.gif" height="12" width="12" border="0" alt="Move down" /></a></td>
	<td width="1%"><a href="{www_dir}{index}{item_up_command}"><img src="{www_dir}/admin/images/move-up.gif" height="12" width="12" border="0" alt="Move up" /></a></td>
	</th>
	<th>&nbsp;
	</th>
	<td width="1%">
	<input type="checkbox" name="DeleteSectionID[]" value="{section_id}" />
	</td>
</tr>
<!-- BEGIN link_item_tpl -->
<tr>
	<td width="1%">
	</td>
	<td class="{td_class}">
	&nbsp;<a href="{www_dir}{index}{link_url}" target="_blank">{link_name}</a>
	</td>
	<td class="{td_class}">
	{link_module_name}/{link_module_type}
	</td>
	<td class="{td_class}" width="1%"><a href="{www_dir}{index}{item_down_command}"><img src="{www_dir}/admin/images/move-down.gif" height="12" width="12" border="0" alt="Move down" /></a></td>
	<td class="{td_class}" width="1%"><a href="{www_dir}{index}{item_up_command}"><img src="{www_dir}/admin/images/move-up.gif" height="12" width="12" border="0" alt="Move up" /></a></td>
	<td class="{td_class}" width="1%">
	<!-- BEGIN link_edit_item_tpl -->
	<a href="{www_dir}{index}{item_edit_command}" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('ezc{link_id}-red','','{www_dir}/design/admin/images/layout/redigerminimrk.gif',1)"><img name="ezc{link_id}-red" border="0" src="{www_dir}/design/admin/images/layout/redigermini.gif" width="16" height="16" align="top" alt="Edit" /></a>
	</td>
	<!-- END link_edit_item_tpl -->
	</td>
	<td class="{td_class}" width="1%">
	<input type="checkbox" name="DeleteLinkID[]" value="{link_id}" />
	</td>
</tr>
<!-- END link_item_tpl -->
<tr>
	<td width="1%">
	</td>
	<td>&nbsp;
	</td>
</tr>
<!-- END section_item_tpl -->
</table>

<br />

<input type="hidden" name="UrlRef" value="{url}" />

<hr noshade="noshade" size="4" />

<table cellpadding="0">
<tr>
	<td>
	<input class="stdbutton" type="submit" name="NewSection" value="{intl-new_section}" />
	</td>
	<td>
	<input class="stdbutton" type="submit" name="DeleteLink" value="{intl-delete_link}" />
	</td>
</tr>
</table>

<hr noshade="noshade" size="4" />

<table cellpadding="0">
<tr>
	<td>
	<input class="okbutton" type="submit" name="SubmitInfo" value="{intl-submit}" />
	</td>
	<td>
	<input class="stdbutton" type="submit" name="Back" value="{intl-back}" />
	</td>
</tr>
</table>

</form>
