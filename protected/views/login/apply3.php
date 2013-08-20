<div id="login_cont" style="border:0px solid red;overflow:hidden;width:100%;">
	<div style="float:right;width:100%;border:0px solid red;margin-top: 20px;">
		<div class="index_regirest_title_agents"></div>
		
		<div style="border:1px solid #cccccc;background:#EDEDED;padding-top:10px;">
			<div style="height:620px;;border:0px solid #cccccc;width:55%;margin:0 auto;">

<br />
	Profile created and now enter your billing information		
			

<!--
Please download the PHP SDK available at https://developer.authorize.net/downloads/ for more current code.
-->
<form method="post" action="/login/storebilling">
<table width="35%" border="0">
<tr>
<td>
<b><font size="2" face="arial">Create Subscription</font><br>
<br></b>
</td>
<td></td>
</tr>
<!--
<tr>
<td>
<font size="2" face="arial">Reference Id</font>
</td>
<td>
<input type="text" name="refId" value=''> <font size="1" face="arial">MAX = 20 chars</font>
</td>
</tr>
-->
refid  <input type="text" name="refId" value='1'>

<tr>
<td>
<font size="2" face="arial">Subscription Name</font>
</td>
<td>
Subscription package  <input type="text" name="name" value='hhhh'>
</td>
</tr>
<!--
<tr>
<td>
<font size="2" face="arial">Subscription Length</font>
</td>
<td>
<input type="text" name="length" value=''> <font size="1" face="arial">1 - 12 or 7 - 365</font>
</td>
</tr>
--!>
<input type="hidden" name="length" value='12'> 

<!--
<tr>
<td>
<font size="2" face="arial">Subscription Unit</font>
</td>
<td>
<input type="text" name="unit" value=''> <font size="1" face="arial">months or days</font>
</td>
</tr>
-->
<input type="hidden" name="unit" value='months'> 

<!--
<tr>
<td>
<font size="2" face="arial">Start Date</font>
</td>
<td>
<input type="text" name="startDate" value=''> <font size="1" face="arial">YYYY-MM-DD</font>
</td>
</tr>
-->
<input type="text" name="startDate" value='<?php echo date('Y-m-d');?>'> 

<!--
<tr>
<td>
<font size="2" face="arial">Total Occurrences</font>
</td>
<td>
<input type="text" name="totalOccurrences" value=''> <font size="1" face="arial">MAX = 9999</font>
</td>
</tr>
<tr>
<td>
<font size="2" face="arial">Trial Occurrences</font>
</td>
<td>
<input type="text" name="trialOccurrences" value=''> <font size="1" face="arial">0 = None. MAX = 99</font>
</td>
</tr>
-->
<input type="hidden" name="totalOccurrences" value='12'>
<input type="hidden" name="trialOccurrences" value='1'>


<tr>
<td>
<font size="2" face="arial">Amount</font>
</td>
<td>
$5.99<input type="hidden" name="amount" value='5.99'>
</td>
</tr>
<tr>
<td>
<font size="2" face="arial">Trial Amount</font>
</td>
<td>
$5.99<input type="hidden" name="trialAmount" value='5.99'> <font size="1" face="arial">0 = None</font>
</td>
</tr>
<tr>
<td>
<font size="2" face="arial">Credit Card Number</font>
</td>
<td>
<input type="text" name="cardNumber" value='4012888818888'>
</td>
</tr>
<tr>
<td>
<font size="2" face="arial">Expiration Date</font>
</td>
<td>
<input type="text" name="expirationDate" value='2015-11'> <font size="1" face="arial">YYYY-MM</font>
</td>
</tr>
<tr>
<td>
<font size="2" face="arial">First Name</font>
</td>
<td>
<input type="text" name="firstName" value='Zhao'>
</td>
</tr>
<tr>
<td>
<font size="2" face="arial">Last Name</font>
</td>
<td>
<input type="text" name="lastName" value='Peng'>
</td>
</tr>
<tr>
<td>
<br>
<input type="submit" name="submit" value="Submit"><input type="reset" name="reset" value="Reset">
</td>
<td></td>
</tr>
</table>
</form>


</div>
</div>
</div>
</div>
