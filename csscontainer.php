<style type="text/css">
#container{
    width:1400px;
    margin:0 auto;
}
#headbox{
    width:1400px;
    height:60px;
	background-color:#ACD6FF;
    margin:0 auto;
}
#sidebar_left{
    width:200px;
    height:1240px;
	background-color:#CAFFFF;
    float:left;
}
#sidebar_right{
    width:200px;
    height:1240px;
	background-color:#CAFFFF;
    float:left;
}
#sidebody{
    width:1000px;
    height:1240px;
	background-color:#FFC1E0;
    float:left;
}
#clear{
    clear:both;
}
#footer{
    width:1400px;
    height:60px;
	background-color:#ACD6FF;
}
#p{
	width:140px;
    height:60px;
	border: 1px solid powderblue;
	background-color:#BBFFBB;
	//position: absolute;
	//top: 50%;
	//left: 50%;
	margin: 0 auto;
	//padding: 10px;
}
</style>
<style type="text/css">
#phonePage{
	background-color:#FFC1E0;
    width:980px;
	height:1100px;
    margin-top:5px;
    margin:0 auto;
}
#leftPhoto{
	width:460px;
	height:740px;
	background-color:#FF7575;
    border:1px #666;
    margin-left:5px;
    margin-top:5px;
    margin-bottom:5px;
    float:left;
}
#rightName{
	width:480px;
    height:100px;
	background-color:#FF7575;
    //border:1px #666 dashed;
	margin-right:5px;
    margin-top:5px;
    margin-bottom:5px;
    float:right;
	//position: relative;
	//top: 20px;
}
#rightColor{
	width:480px;
    height:300px;
    //border:1px #666 dashed;
	margin-right:5px;
    margin-top:5px;
    margin-bottom:5px;
    float:right;
}
#rightStorage{
	width:480px;
    height:100px;
	background-color:#FF7575;
    //border:1px #666 dashed;
	margin-right:5px;
    margin-top:5px;
    margin-bottom:5px;
    float:right;
}
#rightPrice{
	width:480px;
    height:100px;
    //border:1px #666 dashed;
	margin-right:5px;
    margin-top:5px;
    margin-bottom:5px;
    float:right;
}
#rightBuy{
	width:480px;
    height:100px;
	background-color:#FF7575;
    //border:1px #666 dashed;
	margin-right:5px;
    margin-top:5px;
    margin-bottom:5px;
    float:right;
}
#buttomDiscribe{
	width:970px;
    height:340px;
    border:1px #222 dashed;
    margin-left:5px;
    margin-top:5px;
    margin-bottom:5px;
	float:left;
}
</style>
<style type="text/css">
/* Please ❤ this if you like it! */
@import url('https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&subset=devanagari,latin-ext');


:root {
	--white: #ffffff;
	--light: #f0eff3;
	--black: #000000;
	--dark-blue: #1f2029;
	--dark-light: #353746;
	--red: #da2c4d;
	--yellow: #f8ab37;
	--grey: #ecedf3;
}

/* #Primary
================================================== */

body{
	width: 100%;
	background: var(--dark-blue);
	overflow-x: hidden;
    font-family: 'Poppins', sans-serif;
	font-size: 17px;
	line-height: 30px;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
p{
    font-family: 'Poppins', sans-serif;
	font-size: 17px;
	line-height: 10px;
	color: var(--white);
	letter-spacing: 1px;
	font-weight: 450;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
::selection {
	color: var(--white);
	background-color: var(--black);
}
::-moz-selection {
	color: var(--white);
	background-color: var(--black);
}
mark{
	color: var(--white);
	background-color: var(--black);
}
.section {
    position: relative;
	width: 100%;
	display: block;
	text-align: center;
	margin: 0 auto;
}
.over-hide {
    overflow: hidden;
}
.z-bigger {
    z-index: 100 !important;
}


.background-color{
	position: fixed;
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	background-color: var(--dark-blue);
	z-index: 1;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.checkbox:checked ~ .background-color{
	background-color: var(--white);
}


[type="checkbox"]:checked,
[type="checkbox"]:not(:checked),
[type="radio"]:checked,
[type="radio"]:not(:checked){
	position: absolute;
	left: -9999px;
	width: 0;
	height: 0;
	visibility: hidden;
}
.checkbox:checked + label,
.checkbox:not(:checked) + label{
	position: relative;
	width: 70px;
	display: inline-block;
	padding: 0;
	margin: 0 auto;
	text-align: center;
	margin: 17px 0;
	margin-top: 100px;
	height: 6px;
	border-radius: 4px;
	background-image: linear-gradient(298deg, var(--red), var(--yellow));
	z-index: 100 !important;
}
.checkbox:checked + label:before,
.checkbox:not(:checked) + label:before {
	position: absolute;
	font-family: 'unicons';
	cursor: pointer;
	top: -17px;
	z-index: 2;
	font-size: 20px;
	line-height: 40px;
	text-align: center;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
}
.checkbox:not(:checked) + label:before {
	content: '\eac1';
	left: 0;
	color: var(--grey);
	background-color: var(--dark-light);
	box-shadow: 0 4px 4px rgba(0,0,0,0.15), 0 0 0 1px rgba(26,53,71,0.07);
}
.checkbox:checked + label:before {
	content: '\eb8f';
	left: 30px;
	color: var(--yellow);
	background-color: var(--dark-blue);
	box-shadow: 0 4px 4px rgba(26,53,71,0.25), 0 0 0 1px rgba(26,53,71,0.07);
}

.checkbox:checked ~ .section .container .row .col-12 p{
	color: var(--dark-blue);
}

.checkbox-budget:checked + label,
.checkbox-budget:not(:checked) + label{
	position: relative;
	display: inline-block;
	padding: 0;
	padding-top: 5px;
	padding-bottom: 5px;
	width: 140px;
	font-size: 20px;
	line-height: 52px;
	font-weight: 700;
	letter-spacing: 1px;
	margin: 0 auto;
	margin-left: 5px;
	margin-right: 5px;
	margin-bottom: 10px;
	text-align: center;
	border-radius: 4px;
	overflow: hidden;
	cursor: pointer;
	text-transform: uppercase;
	-webkit-transition: all 300ms linear;
	transition: all 300ms linear; 
	-webkit-text-stroke: 1px var(--white);
    text-stroke: 1px var(--white);
    -webkit-text-fill-color: transparent;
    text-fill-color: transparent;
    color: transparent;
}
.checkbox-budget:not(:checked) + label{
	background-color: #D3A4FF;
	box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.1);
}
.checkbox-budget:checked + label{
	background-color: #3C3C3C;
	box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-budget:not(:checked) + label:hover{
	box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
}
.checkbox-budget:checked + label::before,
.checkbox-budget:not(:checked) + label::before{
	position: absolute;
	content: '';
	top: 0;
	left: 0;
	width: 100%;
	height: 100%;
	border-radius: 4px;
	background-image: linear-gradient(138deg, var(--red), var(--yellow));
	z-index: -1;
}
.checkbox-budget:checked + label span,
.checkbox-budget:not(:checked) + label span{
	position: relative;
	display: block;
}
.checkbox-budget:checked + label span::before,
.checkbox-budget:not(:checked) + label span::before{
	position: absolute;
	content: attr(data-hover);
	top: 0;
	left: 0;
	width: 100%;
	overflow: hidden;
	-webkit-text-stroke: transparent;
    text-stroke: transparent;
    -webkit-text-fill-color: var(--white);
    text-fill-color: var(--white);
    color: var(--white);
	-webkit-transition: max-height 0.3s;
	-moz-transition: max-height 0.3s;
	transition: max-height 0.3s;
}
.checkbox-budget:not(:checked) + label span::before{
	max-height: 0;
}
.checkbox-budget:checked + label span::before{
	max-height: 100%;
}

.checkbox:checked ~ .section .container .row .col-xl-10 .checkbox-budget:not(:checked) + label{
	background-color: var(--light);
	-webkit-text-stroke: 1px var(--dark-blue);
    text-stroke: 1px var(--dark-blue);
	box-shadow: 0 1x 4px 0 rgba(0, 0, 0, 0.05);
}

.link-to-page {
	position: fixed;
    top: 30px;
    right: 30px;
    z-index: 20000;
    cursor: pointer;
    width: 30px;
}
.link-to-page img{
	width: 100%;
	height: auto;
	display: block;
}
</style>