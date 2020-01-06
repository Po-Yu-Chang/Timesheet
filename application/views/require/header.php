<!-- start: Meta -->
<meta charset="utf-8">
<title>工時系統-CINPHOWN</title>
<meta name="description" content="CINPHOWN working hours main page">
<meta name="author" content="una">
<meta name="keyword" content="CINPHOWN, PM, working hours">
<!-- end: Meta -->

<!-- start: Mobile Specific -->
<meta name="viewport" content="width=device-width, initial-scale=1">
<!-- end: Mobile Specific -->

<!-- start: CSS -->

<link href="<?= '../assets/css/bootstrap.min.css'?>" rel="stylesheet">
<!-- <link href="<?= '../assets/css/bootstrap-responsive.min.css'?>" rel="stylesheet"> -->
<link href="<?= '../assets/css/style.css'?>" rel="stylesheet">
<link href="<?= '../assets/css/style-responsive.css'?>" rel="stylesheet">
    
<!-- start: Favicon -->
<link rel="shortcut icon" href="../assets/img/16.ico">
<!-- end: Favicon -->

<!-- Other CSS -->
<style>
	select {
		font-size: 16px;
		font-family: "微軟正黑體";
		font-weight:bold;
	}
	th {
		text-align: center;
		vertical-align: middle;
		font-family: "微軟正黑體";
	}
	ul.tab {
		list-style-type: none;
		margin: 0;
		padding: 0;
		overflow: hidden;
		border: 1px solid #ccc;
		background-color: #f1f1f1;
		font-size: 20px;
		font-family: "微軟正黑體";
		font-weight:bold;
	}

	/* Float the list items side by side */
	ul.tab li {
		float: left;
	}

	/* Style the links inside the list items */
	ul.tab li a {
		display: inline-block;
		color: black;
		text-align: center;
		padding: 14px 16px;
		text-decoration: none;
		transition: 0.3s;
		font-size: 17px;
	}

	/* Change background color of links on hover */
	ul.tab li a:hover { background-color: #ddd; }

	/* Create an active/current tablink class */
	ul.tab li a:focus, .active { background-color: #ccc; }

	/* Style the tab content */
	.tabcontent {
		display: none;
		padding: 6px 12px;
		border: 1px solid #ccc;
		border-top: none;
	}
	#calendar {
		max-width: 900px;
		margin: 0 auto;
	}
	.Time_Select
	{
		width: 100px;
	}
	.Search_Button
	{
		font-size: 16px;
		font-family:"微軟正黑體";
	}
	.Base
	{
		font-size: 16px;
		font-family:"微軟正黑體";
		color: steelblue;
	}
	.box-header{
		background-color: steelblue;
		color:white;
		text-align:center;
	}

</style>