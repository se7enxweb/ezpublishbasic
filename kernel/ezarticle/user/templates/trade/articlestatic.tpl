<!-- BEGIN article_url_item_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td align="center">
	<h3>{intl-found}: http://{article_url}</h3>
	</td>
</tr>
</table>
<!-- END article_url_item_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td>
	<h1>{article_name}</h1>
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

<img src="{www_dir}/design/admin/images/path-arrow.gif" height="10" width="12" border="0" alt="">
<a class="path" href="{www_dir}{index}/article/archive/0/">{intl-top_level}</a>

<!-- BEGIN path_item_tpl -->
<img src="{www_dir}/design/admin/images/path-slash.gif" height="10" width="16" border="0" alt="">
<a class="path" href="{www_dir}{index}/article/archive/{category_id}/">{category_name}</a>
<!-- END path_item_tpl -->

<hr noshade="noshade" size="4" />
<br />
<!-- BEGIN article_header_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td>
	<p class="byline">{intl-article_author}: <a class="byline" href="{www_dir}{index}/article/author/view/{author_id}">{author_text}</a></p>
	</td>
	<td align="right">
	<p class="byline">{intl-article_date}: {article_created}</p>
	</td>
</tr>
</table>
<!-- END article_header_tpl -->

<!-- BEGIN article_topic_tpl -->
<a class="path" href="{www_dir}{index}/article/topiclist/{topic_id}">{topic_name}</a>
<!-- END article_topic_tpl -->

<!-- BEGIN article_intro_tpl -->
<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td>
	{article_intro}
	</td>
</tr>
</table>
<br />
<!-- END article_intro_tpl -->

<table width="100%" cellspacing="0" cellpadding="0" border="0">
<tr>
	<td>
	{article_body}
	</td>
</tr>
</table>

<!-- BEGIN image_list_tpl -->
<table class="list" width="100%" cellspacing="0" cellpadding="4" border="0">
<!-- BEGIN image_tpl -->
<tr>
	<td width="1%" class="{td_class}">
	<img src="{www_dir}{image_url}" width="{image_width}" height="{image_height}" border="2" />
	{image_caption}
	</td>
</tr>
<!-- END image_tpl -->

</table>
<!-- END image_list_tpl -->


<!-- BEGIN attribute_list_tpl -->
<!-- BEGIN type_item_tpl -->
<h2>{type_name}</h2>
<!-- BEGIN attribute_item_tpl -->
<p class="boxtext">{attribute_name}:</p>
{attribute_value}
<!-- END attribute_item_tpl -->
<!-- END type_item_tpl -->
<!-- END attribute_list_tpl -->


<!-- BEGIN attached_file_list_tpl -->
<p class="boxtext">{intl-attached_files}:</p>
<!-- BEGIN attached_file_tpl -->
<div class="p"><a href="{www_dir}{index}/filemanager/download/{file_id}/{original_file_name}/">{file_name}</a></div>
<!-- END attached_file_tpl -->

<!-- END attached_file_list_tpl -->

<br clear="all" />

<div align="center">
<!-- BEGIN prev_page_link_tpl -->
<a class="path" href="{www_dir}{index}/article/articleview/{article_id}/{prev_page_number}/{category_id}/">&lt;&lt; {intl-prev_page}</a>
<!-- END prev_page_link_tpl -->

<!-- BEGIN page_link_tpl -->
| <a class="path" href="{www_dir}{index}/article/articleview/{article_id}/{page_number}/{category_id}/">{page_number}</a>	
<!-- END page_link_tpl -->

<!-- BEGIN current_page_link_tpl -->
| <span class="p"> &lt;&nbsp;{page_number}&nbsp;&gt; </span>
<!-- END current_page_link_tpl -->

<!-- BEGIN next_page_link_tpl -->
| <a class="path" href="{www_dir}{index}/article/articleview/{article_id}/{next_page_number}/{category_id}/">{intl-next_page} &gt;&gt;</a>
<!-- END next_page_link_tpl -->

<br /><br />

<!-- BEGIN numbered_page_link_tpl -->
| <a class="path" href="{www_dir}{index}/article/articleview/{article_id}/0/{category_id}/">{intl-numbered_page}</a> |
<!-- END numbered_page_link_tpl -->

<!-- BEGIN print_page_link_tpl -->
| <a class="path" href="{www_dir}{index}/article/articleprint/{article_id}/-1/{category_id}/">{intl-print_page}</a> |
<!-- END print_page_link_tpl -->
</div>