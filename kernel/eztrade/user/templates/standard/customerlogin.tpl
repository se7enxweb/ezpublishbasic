<h1>{intl-head_line}</h1>

<hr noshade="noshade" size="4" />

<h2>{intl-customer_login}</h2>

<p>{intl-reg_text}</p>

<form method="post" action="{www_dir}{index}/user/login/login/">
<p class="boxtext">{intl-username}:</p>
<input type="text" size="20" name="Username"/>

<p class="boxtext">{intl-password}:</p>
<input type="password" size="20" name="Password"/><br />
<br />

<hr noshade="noshade" size="4" />

<input class="okbutton" type="submit" value="{intl-login}" />
<input type="hidden" name="RedirectURL" value="{redirect_url}" />
</form>
<br />

<h2>{intl-new_customer}</h2>

<p>{intl-new_text}</p>

<form method="post" action="{www_dir}{index}/user/userwithaddress/new/?RedirectURL=/trade/customerlogin/">

<input class="okbutton" class="stdbutton" type="submit" value="{intl-newuser}" />
<br />
<hr noshade="noshade" size="4" />
</form>

