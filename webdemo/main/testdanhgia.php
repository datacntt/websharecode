<!doctype html5>
<html>
<head>
	<link href="rateit/src/rateit.css" rel="stylesheet" type="text/css">
	<script src="rateit/src/jquery.rateit.js" type="text/javascript"></script>
	<style>
	div.bigstars div.rateit-range
{
    background: url(star-white32.png);
    height: 32px;
}
div.bigstars div.rateit-hover
{
    background: url(star-gold32.png);
}
div.bigstars div.rateit-selected
{
    background: url(star-red32.png);
}
div.bigstars div.rateit-reset
{
    background: url(star-black32.png);
    width: 32px;
    height: 32px;
}
div.bigstars div.rateit-reset:hover
{
    background: url(star-white32.png);
}
	</style>
</head>
<body>
	<div class="bigstars">
<div class="rateit" data-rateit-value="3" data-rateit-starwidth="32" data-rateit-starheight="32" data-rateit-min="0" data-rateit-max="10"></div>
</div>

</body>
</html>