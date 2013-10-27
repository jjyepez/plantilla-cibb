<HTML> 
<HEAD> 
        <TITLE>A Simple calculator</TITLE> 
 
<script language = javascript> 
var oper=""
var num =""
 
function displaynum(n) {
document.form1.t1.value = document.form1.t1.value + n
}
 
function operator(op) {         
oper = op
 num= document.form1.t1.value
document.form1.t1.value = ""
}
 //code for equals starts here
function equals() {
doesthejob( eval(num) , eval(document.form1.t1.value ), oper)
}
 //a sub-function of equals 
function doesthejob(n1,n2, op) {
if (op == "+" ) 
document.form1.t1.value = n1 + n2
else if ( op == "-" )
document.form1.t1.value = n1- n2
else if (op == "*")
document.form1.t1.value = n1 * n2
else if (op =="/")
document.form1.t1.value = n1/n2 
else if (op=="nCr" )
document.form1.t1.value = fact2(n1)/ fact2(n1 - n2) / fact2(n2)
else if (op =="nPr")
document.form1.t1.value = fact2(n1) / fact2(n1-n2)
}
 //code for equals ends here

function fact2(n) {    // fact2() for nCr & nPr
if (errorchecking(n) ==false)  
return

var answer = 1
for (i = n; i >=2; i--){
answer = answer*i
} 
return answer
}

function fact() {
n = Number(document.form1.t1.value)
if (errorchecking(n) ==false) 
return
var answer = 1
for (i = n; i >=2; i--){
answer = answer*i
} 
document.form1.t1.value = answer
}

function errorchecking(n) {
if ( n < 0) {
alert("Number shouldn't be negative" )
return false 
}
var mod = n%1
if (!mod ==0) {
alert("The number should be an integer" )
return false
}
} 

function prime(n) {
if (errorchecking(n) == false)
return
var b = true
for ( i = 2; i<= n/2; i ++ ) {
if (n % i == 0 ) {
document.form1.t1.value = "Not prime; its first divided by " + i
b = false
break
}
}
if (b)
document.form1.t1.value = "Is prime"
}

function negation() {
document.form1.t1.value = document.form1.t1.value * -1
}
 
function reset() {
document.form1.t1.value = ""
num = ""
}
</script> 
 
</HEAD> 
<BODY> 





  <div class="calculadora">
  <FORM NAME="Calc">
  <TABLE BORDER=4>
  <TR>
  <TD>
  <INPUT TYPE="text" NAME="display_calc" Size="16">
  <br>
  </TD>
  </TR>
  <TR>
  <TD>
  <INPUT TYPE="button" NAME="one"   VALUE="  1  " OnClick="Calc.Input.value += '1'">
  <INPUT TYPE="button" NAME="two"   VALUE="  2  " OnCLick="Calc.Input.value += '2'">
  <INPUT TYPE="button" NAME="three" VALUE="  3  " OnClick="Calc.Input.value += '3'">
  <INPUT TYPE="button" NAME="plus"  VALUE="  +  " OnClick="Calc.Input.value += ' + '">
  <br>
  <INPUT TYPE="button" NAME="four"  VALUE="  4  " OnClick="Calc.Input.value += '4'">
  <INPUT TYPE="button" NAME="five"  VALUE="  5  " OnCLick="Calc.Input.value += '5'">
  <INPUT TYPE="button" NAME="six"   VALUE="  6  " OnClick="Calc.Input.value += '6'">
  <INPUT TYPE="button" NAME="minus" VALUE="  -  " OnClick="Calc.Input.value += ' - '">
  <br>
  <INPUT TYPE="button" NAME="seven" VALUE="  7  " OnClick="Calc.Input.value += '7'">
  <INPUT TYPE="button" NAME="eight" VALUE="  8  " OnCLick="Calc.Input.value += '8'">
  <INPUT TYPE="button" NAME="nine"  VALUE="  9  " OnClick="Calc.Input.value += '9'">
  <INPUT TYPE="button" NAME="times" VALUE="  x  " OnClick="Calc.Input.value += ' * '">
  <br>
  <INPUT TYPE="button" NAME="clear" VALUE="  c  " OnClick="Calc.Input.value = ''">
  <INPUT TYPE="button" NAME="zero"  VALUE="  0  " OnClick="Calc.Input.value += '0'">
  <INPUT TYPE="button" NAME="DoIt"  VALUE="  =  " OnClick="Calc.Input.value = eval(Calc.Input.value)">
  <INPUT TYPE="button" NAME="div"   VALUE="  /  " OnClick="Calc.Input.value += ' / '">
  <br>
  </TD>
  </TR>
  </TABLE>
  </FORM>
</div>


<hr>



<form name = form1> 
<CENTER><input type = text name = t1  value = "" size = 50><p> 
<input type = button value = "   1   " name = b1 onclick = displaynum(1)> 
<input type = button value = "   2   " name = b2 onclick = displaynum(2)> 
<input type = button value = "   3   " name = b3 onclick = displaynum(3)> 
<input type = button value = "   +   " name = bplus onclick = operator("+") 
><br> 

<input type = button value = "   4   " name = b4 onclick = displaynum(4)> 
<input type = button value = "   5   " name = b5 onclick = displaynum(5)> 
<input type = button value = "   6   " name = b6 onclick = displaynum(6)> 
<input type = button value = "   -   " name = bminus  onclick = operator("-")
> <br> 

<input type = button value = "   7   " name = b7 onclick = displaynum(7)> 
<input type = button value = "   8   " name = b8 onclick = displaynum(8)> 
<input type = button value = "   9   " name = b9 onclick = displaynum(9)> 
<input type = button value = "   *   " name = bmultiply  
onclick = operator("*")> <br> 

<input type = button value = "   .   " name = bdot onclick = displaynum(".")> 
<input type = button value = "   0   " name = b0 onclick = displaynum(0)> 
<input type = button value = "   =   "  name= bequal onclick = equals()> 
<input type = button value = "   /   " name = bdivide onclick = operator("/")
> <br> 

<input type = button value = "  -+ " name = bnegate onclick = negation()> 
<input type = button value = "clear" name = bclear onclick = reset()> 
<input type = button value = "  !  " name = bfact onclick =fact() > 
<input type = button value = " nCr " name = bcombination 
onclick = operator("nCr")> 

<input type = button value = " nPr " name = bpermutation 
onclick = operator("nPr")><BR>
 
<input type = button value = "Prime" name = bprime onclick = prime(t1.value)
> 
</CENTER> 
 
</form> 
</BODY> 
</HTML> 
 