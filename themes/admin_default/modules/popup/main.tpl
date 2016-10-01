<!-- BEGIN: main -->
<form action="{ACTION}" method="post">
	<table class="tab1">
		<tbody>
			<tr>
				<td width="150">{LANG.active}</td>
				<td><input type="checkbox" name="active" value="1" {ACTIVE} /></td>
			</tr>
		</tbody>

		<tbody>
			<tr>
				<td>{LANG.timer_open}</td>
				<td><input type="text" name="timer_open" value="{DATA.timer_open}" /> {LANG.second}</td>
			</tr>
		</tbody>

		<tbody>
			<tr>
				<td>{LANG.timer_close}</td>
				<td><input type="text" name="timer_close" value="{DATA.timer_close}" /> {LANG.second}</td>
			</tr>
		</tbody>

		<tbody>
			<tr>
				<td>{LANG.popup_content}</td>
				<td>{POPUP_CONTENT}</td>
			</tr>
		</tbody>

		<tbody>
			<tr>
				<td><input type="submit" value="{LANG.save}" name="save" /></td>
				<td></td>
			</tr>
		</tbody>
	</table>
</form>
<!-- END: main -->
