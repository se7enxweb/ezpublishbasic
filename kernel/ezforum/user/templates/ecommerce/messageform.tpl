<br />
<p class="boxtext">{intl-topic}:</p>
<input type="text" name="NewMessageTopic" class="box" size="40" value="{new_message_topic}" />
<br /><br />

	<p>{intl-author}:&nbsp;
	<!-- BEGIN author_field_tpl -->
        <!-- BEGIN author_logged_in_tpl -->
	{message_author}
        <!-- END author_logged_in_tpl -->
	<!-- BEGIN author_not_logged_in_tpl -->
	<input type="text" name="AuthorName" class="box" size="40" value="{message_author}" />
	<!-- END author_not_logged_in_tpl -->
	<!-- END author_field_tpl -->
	</p>
	<p>{intl-posted_at}:
	<span class="small">{message_posted_at}</span>
	</p>

<p class="boxtext">{intl-text}:</p>
<textarea name="NewMessageBody" class="box" rows="15" cols="40" >{new_message_body}
</textarea>

<!-- BEGIN message_body_info_tpl -->
<p>{intl-tags_info} <b>{allowed_tags}</b>. </p>
<!-- END message_body_info_tpl -->

<!-- BEGIN message_reply_info_tpl -->
<p class="boxtext">{intl-reply_info_header}:</p>
<p>{intl-reply_info_1}.</p><p>{intl-reply_info_2}, {intl-reply_info_3}. {intl-reply_info_4} </p>
<!-- END message_reply_info_tpl -->

<br /><br />
<!-- BEGIN message_notice_checkbox_tpl -->
<input type="checkbox" name="NewMessageNotice" {new_message_notice}> <span class="check">{intl-notice_requested}</span><br />
<br />
<!-- END message_notice_checkbox_tpl -->

<hr noshade="noshade" size="4" />
