var flag=0;
function callMe(r){
	if(r>=1)
		flag=1;
	if(r>=2)
		flag=2;
	if(r>=3)
		flag=3;
	if(r>=4)
		flag=4;
	if(r>=5)
		flag=5;
	$('#Rating').attr('value',r);
}
function callThis(){
	if(flag>0){
		$('#s1').addClass('active');
		$('#s2').addClass('active');
		$('#s3').addClass('active');
		$('#s4').addClass('active');
		$('#s5').addClass('active');
		if(flag<5)
			$('#s5').removeClass('active');
		if(flag<4)
			$('#s4').removeClass('active');
		if(flag<3)
			$('#s3').removeClass('active');
		if(flag<2)
			$('#s2').removeClass('active');
	}
}
function colorStar(k){
	$('#s1').addClass('active');
	$('#s2').addClass('active');
	$('#s3').addClass('active');
	$('#s4').addClass('active');
	$('#s5').addClass('active');
	if(k<5)
		$('#s5').removeClass('active');
	if(k<4)
		$('#s4').removeClass('active');
	if(k<3)
		$('#s3').removeClass('active');
	if(k<2)
		$('#s2').removeClass('active');
}
function unColorStar(){
	$('#s1').removeClass('active');
	$('#s2').removeClass('active');
	$('#s3').removeClass('active');
	$('#s4').removeClass('active');
	$('#s5').removeClass('active');
	callThis();
}