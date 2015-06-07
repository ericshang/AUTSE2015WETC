<form method="post" action="./search.php?act=doSearch">
<table width="400" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td>Title:</td>
    <td>&nbsp;</td>
    
    <td><input name="title" /> </td>
    <td>*</td>
    <td>&nbsp;</td>
    
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><select name = 'authorAndOr'>
		<option value='1'>And</option>
		<option value='2'>Or</option>
	</select></td>
    <td>Author:</td>
    <td><input name="author" /></td>
    <td><select name = 'yearAndOr'>
		<option value='1'>And</option>
		<option value='2'>Or</option>
	</select></td>
    <td>Year: </td>
    <td><input name="year" /></td>
  </tr>

  <tr>
    <td><select name = 'resultAndOr'>
		<option value='1'>And</option>
		<option value='2'>Or</option>
	</select></td>
    <td>Result: </td>
    <td><input name="result" /></td>
    <td><select name = 'metricAndOr'>
		<option value='1'>And</option>
		<option value='2'>Or</option>
	</select></td>
   <td>Metric: </td>
    <td><input name="Metric" /></td><td><input name="sumbit" type="submit" value="Search" /></td>
  </tr>

</table>

</form>


