<?php
  session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email=$_POST['email'];
    $password = $_POST['pass'];
    
    include("connection.php");
    $stmt=$pdo->prepare('Select * FROM sign_in WHERE email = :email');
    try 
    {
        $stmt->execute(['email'=> $email]);

        if($stmt->rowCount()>0)
        {   
            $user = $stmt->fetch();
            if($password==$user['password'])
            {
                $stmt=$pdo->prepare('Select * FROM login WHERE email = :email');
                $stmt->execute(['email'=> $email]);
                if($stmt->rowCount()>0)
                {
                    $user = $stmt->fetch();
                    if($email==$user['email'])
                    {
                        echo "<script>alert('Login Successfull!');</script>";;
                        
                    }
                }
                else
                {
                $query = "INSERT INTO login(email,password) VALUES (?, ?)";
                $stmt = $pdo->prepare($query);
                $stmt->execute([$email,$password]);
                echo "<script>alert('Login Successfull!');</script>";;
                
                }
            }
            else 
            {
                $_SERVER['email'] = $email;
                $_SERVER['password'] = $password;
                echo"<script >alert('Incorect Password');</script>";;
                header('Location:/github/mainproject/pblproject/pblproject/index.html');

            }
        }
        else
        {
            $_SERVER['email'] = $email;
            $_SERVER['password'] = $password;
            echo "<script>alert('No account associated with his email');</script>";;
            header('Location:/github/mainproject/pblproject/pblproject/index.html');

        } 
    } 
    catch(PDOException $e)
    {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>project</title>
    <link
    href="https://cdn.jsdelivr.net/npm/remixicon@4.2.0/fonts/remixicon.css"
    rel="stylesheet"
/>
    <!-- <link rel="stylesheet" href="/publicmainpage/stylemain.css"> -->
    <style>
*{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
 
    font-family: Arial, Helvetica, sans-serifs;
}

html,body{
    width: 100%;
    height: 100%;
}

#main-page1{
    display: flex;
    width: 100%;
    height: 600px;
}

#nav{
    color: white;
    width: 100%;
    height: 150px;
    background: transparent;
     /* position: fixed; */
    display: flex;
    align-items: center;
    justify-content: space-between;
}

#nav .fixed{
    color: black;
}

#nav-part1{
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: larger;
    padding-left: 20px;
}
#nav-part2{
    color: white;
    padding-left: 15%;
    display: flex; 
     justify-content: space-between; 
       gap: 10px;
       align-items: center;
}

span{

    font-size: xx-large;
    color: orange;
}

#nav2-text{
    color: white;
     display: flex;
     align-items:last baseline;
   
}

/*#text2{

}*/

#nav-part3{   color: white;

    display: flex;
    justify-content: space-between;
    gap: 15px;
    margin-right: 20px;
}

.nav3{
    color: white;
    border: 2px solid white;
    border-radius: 50px;
    padding: 5px 10px;
    text-decoration: none;
}

#forphoto{
    height: 100%;
    width: 100%;
    background: url(../mainphoto.jpg);
    background-position: center;
    background-size: cover;
    object-fit: cover;
    background-position:center;
    background-blend-mode: darken;
    background-color: rgba(0, 0, 0, 0.6);
}

#head{
    color: white;
    display: flex;
    justify-content: center;
    align-items: end;
   text-transform: capitalize;
   height: 240px;
   font-size: 70px;

}

/* #home{
    background-blend-mode:normal;
    background-color: rgba(0, 0, 0, 0.6);
} */

#underhead{
    color: white;
    display: flex;
    justify-content: center;
    align-items: end;
    text-transform: capitalize;
}

#forboth{
    width: 100%;
    height:550px;
}


#forsearch{
    display: flex;
    margin-left: 15%;
    margin-top: 8%;
    height: 105px;
    width: 1000px;
    background-color: white;
    border: 1px solid black;
    justify-content: center;
    align-items: center;
    gap: 2%;
}

#destination{
     padding-left: 10px; 
    color: grey;
    font-size: 15px;
    /* margin-top: 2%; */
}

input{
    width:190px;
    margin-top: 6%;
    height: 30px;
    border: none;
    border-bottom: 1px solid grey;
    color: black;
    
}

input::placeholder{
    color: black;
}

#departure{
    /* padding-left: 10px; */
    color: grey;
    font-size: 15px;
    /* margin-top: 2%; */
}

#return{
    /* padding-left: 10px; */
    color: grey;
    font-size: 15px;
    /* margin-top: 2%; */
}

#nop{
    /* padding-left: 10px; */
    color: grey;
    font-size: 15px;
    /* margin-top: 2%; */
}

button{
    border: 1px solid orange;
    border-radius: 50px;
    background-color: orange;
    color: black;
    height: 50%;
    width: 15%;
  margin-right: 10px;
  font-size: 18px;
}

.ri-search-line{
    color: black;
}

.ri-user-add-fill{
    color: white;
}

.ri-user-follow-fill{
    color: lightgreen;
}

.afterlogin

a{
    color: white;
    text-decoration: none;
}

/** Aboutus **/


.about_us {
    color: black;
    height: 450px;
}

.about_heading {
    color: black;
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 60px;
}

.about_paragrapdh {
    background-color: white;
    color: black;
    height: 510px;
    width: 860px;
    position: relative;
    top: 50%;
    left: 50%;
    transform: translate(-50%,-50%);
}

/* .para2 {
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
} */


.para1 {
    font-size: 20px; 
    color: black;
    margin-top: 3%;
     text-align: justify;
}

/* .para3 {
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
} */

/** choose us **/

.choose_us {
    margin-top: 15px;
    color: white;
    height: 750px;
}

.chosse_heading {
    color: black;
    text-decoration: underline  orange;
    height: 150px;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 60px;
}

.choose_content {
    color: black;
    height: 200px; 
    display: flex;
    gap: 3px;
    
}

.content_the {
    display: flex;
    justify-content: center;
    align-items: center;
}


.the_content {
    display: flex;
    justify-content: center;
    align-items: center;
    color: black;
}

#aboutus{
    color: black;
    width:100%;
    height: 100%;
    margin-top: 15%;
}

#about_head{
color: black;
text-decoration: underline orange;
}

#whychoseus{
    color: black;
    width:100%;
    height: 100%;
    margin-top: 15%;
}

.choseuspara{
    width: 550px;
    height: 450px;
   border: 10px solid orange;
   font-size: 20px;
   overflow-y: scroll;
   text-align: justify;
}

.choseuspara1{
color: black;
margin-top: 2%;
margin-bottom: 2%;
font-size: 25px;
 }

 .choseusimage{
    width: 300px;
    height: 300px;
 }

 .sidebar{
 width:17%;
 display: none;
 height: 80%;
 background-color:  transparent;
 position: absolute;
 }

 .sidebaroptions{
    display: flex;
    flex-direction: column;
    background-color:  transparent;
    color: white;
    padding: 10px 10px;
     margin-bottom: 2%;
     margin-top: 2%;
     margin-left: 1%;
     /* margin-right: 2%; */
    border-bottom: black solid 1px;
    width: 98%;
    height: 75px;
    align-items: center;
    justify-content: center;
    font-size: 20px;
 }

 .sidebaroptions_header{
    display: flex;
    flex-direction: column;
    background: transparent;
    color: white;
    height: 90px;
    align-items: center;
    justify-content: center;
    font-size: 40px;
 }

/* body{
    background-color: rgba(0, 0, 0, 0.6);
    display: none;
 }  */
 </style>
</head>
<body>
    <div id="forboth">
    <div id="main-page1">
        <div id="forphoto">
            <div id="nav">
               <div id="nav-part1"><h4><i class="ri-menu-line"></i></h4></div>
               <div id="nav-part2"><img src="shubham_logo.jpeg" alt="" width="30px" height="30px"><h4 id="text2"><div id="nav2-text"><span>E</span>CONO-<span>T</span>OURIST</div></h4></div>
               <div id="nav-part3">
                <h4 class="nav3"><i class="ri-user-follow-fill"></i></h4>
                <h4 class="nav3"><a href="#aboutus">About us</a></h4>
                <h4 class="nav3"><a href="#whychoseus">Choose us</a></h4>
            </div>
        </div>

       


    <section id="home">
             
        <div class="sidebar" >
            <h3 class="sidebaroptions_header">Menu</h3>
            <hr>
            <a href="#" class="sidebaroptions">Registration</a>
            <a href="#" class="sidebaroptions">Plan a Trip</a>
          </div>
          
            <p id="head">Explore more, spend less</p>  
            <p id="underhead">Plan awesome tours,at very reasonable budget</p>
            <div id="forsearch">
                    <div id="destination">Destination <input type="search" name="" id="destination-input" placeholder="Where are you going?"></div>
                    <div id="departure">Departure Date <input type="date" name="" id="departure-input" placeholder=""></div>
                    <div id="return">Return Date<input type="date" name="" id="return-input" placeholder=""></div>
                    <div id="nop">No. of people <input type="number" name="" id="nop-input" placeholder="Total no. of peoples?"></div>
                    <button type="button"><i class="ri-search-line"></i>Search</button>
            </div>
        </div> 
    </div>
          
    </div>
</section>

<section id = "aboutus">
    <div class="about_us">
        <div class="about_heading">
            <h1 id="about_head"><b>About Us</b></h1>
        </div>

        <div class="about_paragrapdh">
            <br>
            <p class="para1">
    At Econotourist, we understand the magic of travel and the desire to explore new    horizons.
    We also know that budgetary constraints shouldn't hold you back from experiencing the  world.
    That's why we created a  user-friendly platform specifically designed to empower youto  plan 
    and execute unforgettable adventures, all  within your budget.    
            <br>
            <br>
    We're a team passionate about travel, but also  financially conscious. We've leveraged    our
    experience to create a comprehensive set of tools that  streamlines the budget-friendly  trip
    planning process.  Imagine creating a detailed itinerary  with cost-effective   accommodation
    options, affordable transportation solutions, and exciting activities that won't    break the
    bank.  Econotourist empowers you to do just that, putting the control firmly in your   hands.
            <br> <br>
    Here at Econotourist, we don't just find you cheap travel options; we equip you  with     the
    resources to  maximize your budget and discover hidden gems along the way.  Ourplatform  goes 
    beyond basic planning  by offering features like real-time expense trackingand Google    Maps 
    integration for seamless navigation.  We're  confident that Econotouristwill be your one-stop 
    shop for crafting the perfect budget-friendly adventure, transforming your travel dreams into 
    reality.
            </p>
        </div>
    </div>
    </section>

    <section id="whychoseus">
    <div class="choose_us">
        <div class="chosse_heading">
            <p><b>Why   Choose   Us?</b></p>
        </div>

        <p class="choseuspara1">Econotourist isn't just another travel planning platform. Here's what sets us apart and makes us the perfect  partner for your budget-conscious adventures:</p>
        <div class="choose_content"> <p class="choseuspara">


            <img src="unmatchedbudget.jpeg" alt="" class="choseusimage">
<b>Unmatched Budget Management Tools: </b><br> Set and allocate budgets across various expense categories
(accommodation, transportation, food, activities) with ease. Track your spending in real-time and receive insights to
optimize your finances throughout your trip. No more wondering if you're on track .Econotourist keeps you in
control. 
            
            <p class="choseuspara">
                <img src="costeffective.jpeg" alt="" class="choseusimage">
<b>Cost-Effective Options at Your Fingertips :</b><br>We scour vast databases to find a diverse range of
pocket-friendly accommodations that cater to your needs and preferences. From cozy
hostels to charming guesthouses, discover hidden gems that won't strain your wallet.
Travel Like a Local, Without Breaking the Bank: Explore a variety of affordable transportation
options, including local buses, trains, and ride-sharing services. We integrate with popular
services to provide seamless navigation and booking functionalities, ensuring you get the
most out of your destination without overspending.       
            <br>      </p>
            <p class="choseuspara">
                <img src="craft dream iter.jpeg" alt="" class="choseusimage">  
<b>Craft Your Dream Itinerary:</b> <br>Go beyond the tourist traps! We offer suggestions for popular
attractions and activities, but also unveil hidden gems and off-the-beaten-path experiences
that won't break the bank. Our user-friendly tools allow you to create a customized itinerary
that reflects your interests and budget.          
            <br>     </p>
            <p class="choseuspara">    
                <img src="realtime.jpeg" alt="" class="choseusimage"> 
<b>Real-Time Information and Seamless Navigation:</b><br> Stay informed with up-to-date information
on transportation schedules, accommodation availability, and local events. Our platform
integrates seamlessly with Google Maps for effortless trip navigation, ensuring you get the
most out of your exploration.           
            <br>    </p>
         
           
        </p>     
        </div>
       
    </div>
    <p class="choseuspara1"> 
        Econotourist empowers you to be the architect of your perfect budget-friendly adventure.
        We provide the tools  and resources, you bring the dreams! Let's turn them into reality
        together.</p>
</section>

<script >
    let sidebar_btn = document.querySelector("#nav-part1");
let sidebar = document.querySelector(".sidebar");
let home = document.querySelector("#home");
let nav = document.querySelector("#nav");
let nav3 = document.querySelector(".nav3");

let sidebar_counter = 0;



sidebar_btn.addEventListener("click" ,()=>{
   if(sidebar_counter == 0)
   {
      sidebar.style.display = "block";
      console.log(sidebar_counter);
      sidebar_counter = 1; 
     
      // home.style.backgroundblendmode =  "darken";
      home.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
      nav.style.backgroundColor = "rgba(0, 0, 0, 0.6)";
   }
   else if(sidebar_counter == 1)
   {
      sidebar.style.display = "none"; 
      console.log(sidebar_counter);
      sidebar_counter = 0; 
      // home.style.backgroundblendmode =  "lighten";
      home.style.backgroundColor = "rgba(0, 0, 0, 0)";
      nav.style.backgroundColor = "rgba(0, 0, 0, 0)";
      // home.style.color = "rgba(0, 0, 0, 0)";
   }
});
</script>
</body>
</html>


