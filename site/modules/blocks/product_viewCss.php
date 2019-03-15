.image_bar{
   width:300px;
   float:left;
}

.image_product{
  padding: 20px;
  padding-top: 0px;
  width: 230px;
}

.product_state{
  font-weight: bold;
  color: #87aa0e;
  font-family: Arial,Tahoma,Helvetica,"Liberation Sans",sans-serif;
}

.b-product_main-info-panel {
  position: relative;
  width: 435px;
  float:left;
  font-family: Arial,Tahoma,Helvetica,"Liberation Sans",sans-serif;
  line-height: 1.25em;
}

.b-dotted-panel {
width: 100%;
margin-bottom:10px;
margin-top:10px;
}

.b-dotted-panel__holder {
border-bottom: 1px solid #ccc;
padding: 10px 10px 20px 0px;
min-width: 210px;
}

.b-product__price-text {
  float:left;
  vertical-align: middle;
  width: 100px;
  padding-top: 5px;
  font-size: 12px;
  font-weight: bold;
  font-family: Arial,Tahoma,Helvetica,"Liberation Sans",sans-serif;
}

.b-product__price {
display: block;
font-size: 23px;
line-height: 1em;
}

.b-dotted-panel__frame {
vertical-align: middle;
word-wrap: break-word;
}

.info_product,h3{
  margin-left: 20px;
}

.input_cnt{
  width: 25px;
  margin-left: 10px;
  margin-right: 5px;
}

.sp-wrap {
max-width: 300px;
}

/* Element wrapper */
.sp-wrap {
display:none;
line-height:0;
font-size:0;
background:#eee;
position:relative;
margin:0 25px 15px 0;
float:left;
/**************
Set max-width to your thumbnail width
***************/
max-width: 300px;
}

/* Thumbnails */
.sp-thumbs {
text-align:left;
border-top:2px solid #F0353A;
display:inline-block;
}
.sp-thumbs img {
width:50px;
height:50px;
}
.sp-thumbs a:link, .sp-thumbs a:visited {
opacity:.4;
display:inline-block;
-webkit-transition: all .2s ease-out;
-moz-transition: all .2s ease-out;
-ms-transition: all .2s ease-out;
-o-transition: all .2s ease-out;
transition: all .2s ease-out;
}
.sp-thumbs a:hover{
opacity:1;
}
.sp-thumbs a:active, .sp-current {
opacity:1!important;
position: relative;
}
.sp-current:after {
content:'';
border:6px solid transparent;
border-top:6px solid #F0353A;
position: absolute;
left:50%;
top:0;
margin-left:-6px;
}

/* Unzoomed, big thumbnail */
.sp-large {
position:relative;
overflow:hidden;
top:0;
left:0;
}
.sp-large a img {
max-width:100%;
height:auto;
cursor: -webkit-zoom-in;
cursor: -moz-zoom-in;
}
.sp-large a {
display:inline-block;
}

/* Panning Zoomed Image */
.sp-zoom {
position:absolute;
left:0;
top:0;
cursor:zoom;
cursor: -webkit-zoom-out;
cursor: -moz-zoom-out;
display:none;
}

/* Button to go full size */
.sp-full-screen {
position: absolute;
z-index: 1;
display: block;
right: 0;
top: 0;
font-size: 20px;
line-height: 1em;
width: 19px;
height: 20px;
padding: 0 0 2px 1px;
background: #F0353A;
}
.sp-full-screen a:link,
.sp-full-screen a:visited {
background: none;
color: #fff;
font-size: 20px;
width: 20px;
height: 20px;
text-decoration: none;
text-align: center;
display: block;
-webkit-transform: rotate(45deg);
-moz-transform: rotate(45deg);
-ms-transform: rotate(45deg);
-o-transform: rotate(45deg);
transform: rotate(45deg);
}

/* Lightbox */
.sp-lightbox {
position: fixed;
top:0;
left:0;
height: 100%;
width:100%;
background:rgb(0,0,0);
background:rgba(0,0,0,.8);
z-index: 999;
display: none;
}
.sp-lightbox img {
position: absolute;
margin: auto;
top: 0;
bottom: 0;
left: 0;
right: 0;
max-width: 100%;
max-height: 100%;
}

/* Remove margin in mobile view */
@media screen and (max-width: 400px) {
.sp-wrap {
margin:0 0 15px 0;
}
}