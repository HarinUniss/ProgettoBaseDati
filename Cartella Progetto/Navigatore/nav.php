<?php ?>
<!-- Fare in modo che una volta fatto il loghin la sessione resti aperta nelle altre pagine del sito -->

<!DOCTYPE html>
<html>



<head>
    <meta charset="UTF-8">
    <title>Navigazione Verticale PHP</title>
    <link rel="stylesheet" href="style/main.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<nav>
    <div class="sidebar ">  <!--Retro della barra di navigazione-->

        <div class="logo-details"> <!--Sezione del logo e del titolo-->
            <!-- non aprire questo SVG!!!!!  -->


            <i class='bx bxs-dog'></i> <!-- classe per il logo presa da Boxicons.com -->
            <span class="logo_name">Cucciolotti</span> <!--Nome Sito-->
        </div>

        <ul class="nav-links">
            <li>
                <a href="#">
                    <i class='bx bx-grid-alt' ></i>
                    <span class="link_name">Categoria</span>
                </a>
                <ul class="sub-menu blank">
                    <li><a class="link_name" href="#">Categoria</a></li>
                </ul>
            </li>

            <li>
                <div class="iocn-link"><!-- classe che uso per creare un sottomenu -->
                    <a href="#">
                        <i class='bx bxl-html5' ></i> <!-- classe per il logo presa da Boxicons.com -->
                        <span class="link_name">Sezione</span>
                    </a>
                    <i class='bx bx-chevron-down arrow' ></i>
                </div>
                <ul class="sub-menu">
                    <li> <a class="link_name" href="#">Sezione </a> </li>
                    <li> <a href="#"> capitolo 1 </a> </li>
                    <li> <a href="#"> capitolo 2 </a> </li>
                    <li> <a href="#"> capitolo 3 </a> </li>
                    <li> <a href="#"> capitolo 4 </a> </li>
                    <li> <a href="#"> capitolo 5 </a> </li>
                    <li> <a href="#"> capitolo 7 </a> </li>
                </ul>
            </li>



            <li>
                <div class="profile-details">
                    <div class="profile-content">
                        <img src="image/profile.png" alt="profile">
                    </div>

                    <div class="name-job">
                        <div class="profile_name">Harin Uzra</div>
                        <div class="job">Amministratore</div>
                    </div>
                    <i class='bx bx-log-out' ></i>
                </div>
            </li>


        </ul>




    </div>
</nav>

<script>
    let arrow = document.querySelectorAll( ".arrow" );
    console.log(arrow);
    for (var i = 0 ; i < arrow.length ; i++){
        arrow[i].addEventListener("click", (e)=>{
            let arrowParent = e.target.parentElement.parentElement;
            console.log(arrowParent);
            arrowParent.classList.toggle("showMenu");
        })
    }
</script>





</html>

