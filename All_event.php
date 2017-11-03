<?php
include "lock.php";
include "config.php";
$catb="IT";
$it=0;
$cp=0;
$me=0;
$ci=0;
$pro=0;
$ec=0;
$non=0;

$sql="select * from events where Catagory='IT'";
$result=mysqli_query($con,$sql);
$it=mysqli_num_rows($result);

$sql="select * from events where Catagory='Computer'";
$result=mysqli_query($con,$sql);
$cp=mysqli_num_rows($result);

$sql="select * from events where Catagory='Mechanical'";
$result=mysqli_query($con,$sql);
$me=mysqli_num_rows($result);

$sql="select * from events where Catagory='Civil'";
$result=mysqli_query($con,$sql);
$ci=mysqli_num_rows($result);

$sql="select * from events where Catagory='Production'";
$result=mysqli_query($con,$sql);
$pro=mysqli_num_rows($result);

$sql="select * from events where Catagory='EC'";
$result=mysqli_query($con,$sql);
$ec=mysqli_num_rows($result);

$sql="select * from events where Catagory='Non-Tech'";
$result=mysqli_query($con,$sql);
$non=mysqli_num_rows($result);






?>
<!DOCTYPE html>
<html>
<head>
<title>Udaan2k18</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="css/brij.css" rel="stylesheet">
</head>
<body>
<?php include "nav.php"; ?>

<div class="container padded">
    <div class="row">
        <div class="col-sm-8 blog">
            <section id="update_event">
            <?php
			$sql="select * from events where Catagory='$catb'";
			$result=mysqli_query($con,$sql);
			if(!$result)
				die("Something went wrong.");
			while($r=mysqli_fetch_assoc($result))
			{
			?>
            
             <div id="content_of_event">
                <h1><?php echo $r['Catagory'] ?> &raquo; <?php echo strtoupper($r['Name']); ?></h1><hr>
                <p id="time_of_event"><span class="glyphicon glyphicon-time"></span> Posted on <?php echo $r['Created']; ?></p>
                <hr>
                <img id="img_of_event" src="images/blog1.png" class="img-responsive">
                <hr>
                <div id="div_of_event">
                <?php echo $r['Description']; ?>
				</div><br>
				<div id="fees_of_event">Fees : <?php echo $r['Fees']; ?></div><br>
				<div id="contacts" >
					<b>For More Information, Call to :</b><br />
					1. <b><?php echo $r['Contact1']; ?></b><br/>
					2. <b><?php echo $r['Contact2']; ?></b>
				</div><br>
				<button class="btn" onClick="adding_in_cart(<?php echo $r['ID']; ?>)">Add to cart</button><p id="adding_status"></p>
			</div>
			<?php
			}
			mysqli_close($con);
			?>
			</section>
	</div>
        <div class="col-sm-4 sidebar">
            <section>
                <h3 class="tpad">Search</h3>
                <div class="input-group input-group-lg tpad">
                    <span class="input-group-addon glyphicon glyphicon-search"></span>
                   <form name="search_form"> <input type="text" class="form-control input-lg" onKeyUp="search(this.value)" name="searchField" placeholder="Search"></form>
                </div>
                <p class="table table-condensed" id="found"></p>
                <hr>
            </section>
            <section>
               
                <h3 class="tpad">Tags</h3>
                <div class="list-group tpad">
                    <a href="#" class="list-group-item" onclick="load('IT')"><span class="badge"><?php echo $it; ?></span>Information Technology</a>
                    <a href="#" class="list-group-item" onclick="load('Computer')"><span class="badge"><?php echo $cp; ?></span>Compuer Science</a>
                    <a href="#" class="list-group-item" onclick="load('Civil')"><span class="badge"><?php echo $ci; ?></span>Civil Engineering</a>
                    <a href="#" class="list-group-item" onclick="load('Mechanical')"><span class="badge"><?php echo $me; ?></span>Mechanical Engineering</a>
                    <a href="#" class="list-group-item" onclick="load('Producation')"><span class="badge"><?php echo $pro; ?></span>Production Engineering</a>
					<a href="#" class="list-group-item" onclick="load('EC')"><span class="badge"><?php echo $ec; ?></span>Electrical/Electronics Engineering</a>
					<a href="#" class="list-group-item"  onclick="load('Non-Tech')"><span class="badge"><?php echo $non; ?></span>Non-Tech Events</a>                </div>
                <hr>
            </section>
            <section>
                <h3 class="tpad">Latest from Twitter</h3>
                <div class="media tpad">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="images/user.jpg" alt="user">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">@Vishal_Virani</h4>
                        <p class="bpad">Can't believe how good this Udaan 2k17 was,i m so exicited about Udaan 2k18!!!</p>
                    </div>
                </div>
            
            </section>
			<section>
                <h3 class="tpad">Latest from Twitter</h3>
                <div class="media tpad">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="images/user2.jpg" alt="user">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">@Parth_desai</h4>
                        <p class="bpad">I m dreaming everyday about Udaan.that is so amazing days of college life.</p>
                    </div>
                </div>
            
            </section>
        </div>
    </div>    
</div>    
<script>
function load(str)
{
		var x=new XMLHttpRequest();
		x.onreadystatechange=function()
		{
			if(this.readyState==4 && this.status==200)
				{
					document.getElementById("update_event").innerHTML=this.responseText;
				}
		};
		x.open("GET","load_event.php?q="+str,true);
		x.send();
}
function search(str)
{
		var x=new XMLHttpRequest();
		x.onreadystatechange=function()
		{
			if(this.readyState==4 && this.status==200)
				{
					document.getElementById("found").innerHTML=this.responseText;
				}
		};
		x.open("GET","search_event.php?q="+str,true);
		x.send();
}
function selected(str)
{
		var x=new XMLHttpRequest();
		x.onreadystatechange=function()
		{
			if(this.readyState==4 && this.status==200)
				{
					document.getElementById("update_event").innerHTML=this.responseText;
					document.search_form.searchField.value="";
					document.getElementById("found").innerHTML="";
				}
		};
		x.open("GET","load_event.php?s="+str,true);
		x.send();
}
function adding_in_cart(id)
{
		var x=new XMLHttpRequest();
		x.onreadystatechange=function()
		{
			if(this.readyState==4 && this.status==200)
				{
					window.location.reload();
					document.getElementById("adding_status").innerHTML=this.responseText;
				}
		};
		x.open("GET","add_to_cart.php?s="+id,true);
		x.send();
}
</script>
</body>
</html>