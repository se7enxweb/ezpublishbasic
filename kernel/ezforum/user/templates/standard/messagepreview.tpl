<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
    <td align="left" valign="bottom">
        <h1>{intl-preview_headline}</h1>
    </td>
    <td align="right">
    <td align="right">
	 <form action="{www_dir}{index}/forum/search/" method="post">
	       <input class="searchbox" type="text" name="QueryString" size="10" />
	       <input class="stdbutton" type="submit" name="search" value="{intl-search}" />
         </form>
     </td>
</tr>
</table>

<!-- BEGIN moderated_tpl -->

<br />
<b>{intl-moderated_info_1}:</b>&nbsp
{intl-moderated_info_2}.&nbsp
{intl-moderated_info_3}.&nbsp
{intl-moderated_info_4}.&nbsp
<br />
<br />
<!-- END moderated_tpl -->

{message_path_file}

<br />
{message_body_file}

<form method="post" action="{www_dir}{index}/forum/messageedit/{action_value}/{message_id}">
{message_hidden_form_file}

    <input class="stdbutton" type="submit" name="EditButton" value="{intl-edit}" />

	<hr noshade="noshade" size="4" />
    
	<input class="okbutton" type="submit" name="PostButton" value="{intl-post}" />
    &nbsp;
	<input class="okbutton" type="submit" name="CancelButton" value="{intl-cancel}" />
</form>
